<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('is_active', true)
            ->orderByDesc('created_at')
            ->get();

        $user = Auth::user();
        $purchasedIds = [];

        if ($user && $user->isStudent()) {
            $purchasedIds = $user->bookPurchases()
                ->where('status', 'paid')
                ->pluck('book_id')
                ->toArray();
        }

        return view('books.index', compact('books', 'purchasedIds'));
    }

    public function show(Book $book)
    {
        if (! $book->is_active) {
            abort(404);
        }

        $user = Auth::user();
        $isPurchased = $book->isPurchasedBy($user && $user->isStudent() ? $user : null);

        return view('books.show', compact('book', 'isPurchased'));
    }

    public function purchase(Book $book)
    {
        if (! $book->is_active) {
            abort(404);
        }

        $user = Auth::user();

        if ($user && $user->isStudent() && $book->isPurchasedBy($user)) {
            return redirect()->route('books.read.full', $book)
                ->with('info', 'You already own this book.');
        }

        if ($user && $user->is_admin) {
            return redirect()->route('books.show', $book)
                ->with('error', 'You are logged in as admin. Sign out from admin, then purchase with Google login.');
        }

        if (! $user || ! $user->isStudent()) {
            session(['url.intended' => route('books.checkout', $book)]);

            return redirect()->route('auth.google')
                ->with('info', 'Please sign in with Google to continue your purchase.');
        }

        return redirect()->route('books.checkout', $book);
    }

    public function readDemo(Book $book)
    {
        if (! $book->is_active) {
            abort(404);
        }

        return view('books.read', [
            'book' => $book,
            'mode' => 'demo',
            'streamUrl' => route('books.stream.demo', $book),
            'watermark' => 'DEMO PREVIEW',
            'purchaseUrl' => route('books.purchase', $book),
        ]);
    }

    public function readFull(Book $book)
    {
        if (! $book->is_active) {
            abort(404);
        }

        $user = Auth::user();
        if (! $user || ! $user->isStudent() || ! $book->isPurchasedBy($user)) {
            return redirect()->route('books.show', $book)
                ->with('error', 'Purchase this book to read the full content.');
        }

        return view('books.read', [
            'book' => $book,
            'mode' => 'full',
            'streamUrl' => route('books.stream.full', $book),
            'watermark' => $user->email,
            'purchaseUrl' => route('books.purchase', $book),
        ]);
    }

    public function streamDemo(Book $book): StreamedResponse
    {
        if (! $book->is_active) {
            abort(404);
        }

        return $this->streamPdf($book->demo_pdf_path, 'demo-'.$book->slug.'.pdf');
    }

    public function streamFull(Request $request, Book $book): StreamedResponse
    {
        if (! $book->is_active) {
            abort(404);
        }

        $user = $request->user();
        if (! $user || ! $user->isStudent() || ! $book->isPurchasedBy($user)) {
            abort(403, 'Purchase required to view this book.');
        }

        return $this->streamPdf($book->pdf_path, 'book-'.$book->slug.'.pdf');
    }

    public function myBooks(Request $request)
    {
        $purchases = $request->user()
            ->bookPurchases()
            ->with('book')
            ->where('status', 'paid')
            ->orderByDesc('purchased_at')
            ->get();

        return view('books.my-books', compact('purchases'));
    }

    private function streamPdf(string $path, string $filename): StreamedResponse
    {
        $disk = Storage::disk('books');

        if (! $disk->exists($path)) {
            abort(404, 'Book file not found.');
        }

        return response()->stream(function () use ($disk, $path) {
            $stream = $disk->readStream($path);
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN',
        ]);
    }
}
