<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use Smalot\PdfParser\Parser;

class BookPdfService
{
    public function storeUploadedPdf(UploadedFile $file, int $bookId): array
    {
        $disk = Storage::disk('books');
        $disk->makeDirectory((string) $bookId);

        $pdfPath = $bookId.'/book.pdf';
        $disk->putFileAs((string) $bookId, $file, 'book.pdf');

        $fullPath = $disk->path($pdfPath);

        if (! $this->isValidPdfFile($fullPath)) {
            $disk->delete($pdfPath);
            throw new \InvalidArgumentException('The uploaded file is not a valid PDF document.');
        }

        $demoPath = $bookId.'/demo.pdf';
        $demoFullPath = $disk->path($demoPath);
        $demoUsesFullPdf = false;

        try {
            $this->createDemoPdf($fullPath, $demoFullPath);
        } catch (\Throwable $e) {
            Log::info('Demo PDF extraction skipped; using browser preview.', [
                'book_id' => $bookId,
                'message' => $e->getMessage(),
            ]);
            if ($disk->exists($demoPath)) {
                $disk->delete($demoPath);
            }
            $demoPath = $pdfPath;
            $demoUsesFullPdf = true;
        }

        return [
            'pdf_path' => $pdfPath,
            'demo_pdf_path' => $demoPath,
            'total_pages' => $this->countPagesSafe($fullPath),
            'demo_uses_full_pdf' => $demoUsesFullPdf,
        ];
    }

    public function isValidPdfFile(string $path): bool
    {
        if (! is_readable($path) || filesize($path) < 5) {
            return false;
        }

        $handle = fopen($path, 'rb');
        if (! $handle) {
            return false;
        }

        $header = fread($handle, 5);
        fclose($handle);

        return str_starts_with($header, '%PDF');
    }

    public function createDemoPdf(string $sourcePath, string $demoPath): void
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($sourcePath);

        if ($pageCount < 1) {
            throw new \RuntimeException('PDF has no pages.');
        }

        $pdf->AddPage();
        $template = $pdf->importPage(1);
        $pdf->useTemplate($template);
        $pdf->Output($demoPath, 'F');
    }

    public function countPagesSafe(string $path): int
    {
        try {
            $pdf = new Fpdi();
            $count = $pdf->setSourceFile($path);
            if ($count > 0) {
                return $count;
            }
        } catch (\Throwable $e) {
            // continue to fallbacks
        }

        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($path);
            $pages = $pdf->getPages();
            if (count($pages) > 0) {
                return count($pages);
            }
        } catch (\Throwable $e) {
            // continue
        }

        try {
            $content = file_get_contents($path);
            if ($content && preg_match_all('/\/Type\s*\/Page[^s]/', $content, $matches)) {
                $count = count($matches[0]);
                if ($count > 0) {
                    return $count;
                }
            }
        } catch (\Throwable $e) {
            // continue
        }

        return 1;
    }
}
