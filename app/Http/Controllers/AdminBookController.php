<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookPurchase;
use App\Services\BookPdfService;
use App\Support\BookPricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBookController extends Controller
{
    public function __construct(private BookPdfService $pdfService)
    {
    }

    public function index()
    {
        $books = Book::withCount(['paidPurchases as sales_count'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.form', ['book' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'gst_percent' => 'required|numeric|min:0|max:100',
            'gateway_charge_percent' => 'required|numeric|min:0|max:100',
            'pdf' => 'required|file|max:51200|mimes:pdf,application/pdf',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $pricing = $this->pricingFromRequest($request);

        $book = Book::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title).'-'.Str::random(6),
            'description' => $request->description,
            'author' => $request->author,
            'base_price' => $pricing['base_price'],
            'gst_percent' => $pricing['gst_percent'],
            'gateway_charge_percent' => $pricing['gateway_charge_percent'],
            'price' => $pricing['final_price'],
            'pdf_path' => 'pending',
            'demo_pdf_path' => 'pending',
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('book_covers', 'public');
            $book->update(['cover_image' => $coverPath]);
        }

        try {
            $paths = $this->pdfService->storeUploadedPdf($request->file('pdf'), $book->id);
            $book->update($paths);
        } catch (\InvalidArgumentException $e) {
            Storage::disk('books')->deleteDirectory((string) $book->id);
            $book->delete();

            return redirect()->back()
                ->withInput()
                ->withErrors(['pdf' => $e->getMessage()]);
        } catch (\Throwable $e) {
            Storage::disk('books')->deleteDirectory((string) $book->id);
            $book->delete();

            return redirect()->back()
                ->withInput()
                ->withErrors(['pdf' => 'Failed to save the PDF file. Please try again.']);
        }

        $message = 'Book uploaded successfully.';
        if (! empty($paths['demo_uses_full_pdf'])) {
            $message .= ' Demo preview uses page 1 in the browser (this PDF format could not be split server-side).';
        }

        return redirect()->route('admin.books.index')->with('success', $message);
    }

    public function edit(Book $book)
    {
        return view('admin.books.form', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'gst_percent' => 'required|numeric|min:0|max:100',
            'gateway_charge_percent' => 'required|numeric|min:0|max:100',
            'pdf' => 'nullable|file|max:51200|mimes:pdf,application/pdf',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_active' => 'nullable|boolean',
        ]);

        $pricing = $this->pricingFromRequest($request);

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'base_price' => $pricing['base_price'],
            'gst_percent' => $pricing['gst_percent'],
            'gateway_charge_percent' => $pricing['gateway_charge_percent'],
            'price' => $pricing['final_price'],
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->hasFile('cover')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->update([
                'cover_image' => $request->file('cover')->store('book_covers', 'public'),
            ]);
        }

        if ($request->hasFile('pdf')) {
            try {
                Storage::disk('books')->deleteDirectory((string) $book->id);
                $paths = $this->pdfService->storeUploadedPdf($request->file('pdf'), $book->id);
                $book->update($paths);
            } catch (\InvalidArgumentException $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['pdf' => $e->getMessage()]);
            } catch (\Throwable $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['pdf' => 'Failed to save the PDF file. Please try again.']);
            }
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        Storage::disk('books')->deleteDirectory((string) $book->id);
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully.');
    }

    public function purchases(Request $request)
    {
        $bookFilter = $request->query('book_id');

        $purchasesQuery = BookPurchase::with(['user', 'book'])
            ->where('status', 'paid')
            ->orderByDesc('purchased_at');

        if ($bookFilter) {
            $purchasesQuery->where('book_id', $bookFilter);
        }

        $purchases = $purchasesQuery->get();
        $books = Book::orderBy('title')->get(['id', 'title', 'author', 'price']);

        $totalSales = BookPurchase::where('status', 'paid')->count();
        $totalRevenue = BookPurchase::where('status', 'paid')->sum('amount');
        $booksWithSales = BookPurchase::where('status', 'paid')->distinct()->count('book_id');

        return view('admin.books.purchases', compact(
            'purchases',
            'books',
            'bookFilter',
            'totalSales',
            'totalRevenue',
            'booksWithSales'
        ));
    }

    public function purchaseInvoice(BookPurchase $purchase)
    {
        if ($purchase->status !== 'paid') {
            abort(404);
        }

        if (! $purchase->invoice_number) {
            $purchase->update([
                'invoice_number' => BookPurchase::generateInvoiceNumber($purchase->id),
            ]);
        }

        $purchase->load(['book', 'user']);

        return view('user.invoice', compact('purchase'));
    }

    /** @return array<string, float> */
    private function pricingFromRequest(Request $request): array
    {
        return BookPricing::calculate(
            (float) $request->input('base_price', 0),
            (float) $request->input('gst_percent', 0),
            (float) $request->input('gateway_charge_percent', 0)
        );
    }
}
