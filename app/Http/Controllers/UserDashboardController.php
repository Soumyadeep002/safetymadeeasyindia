<?php

namespace App\Http\Controllers;

use App\Models\BookPurchase;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $enrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $bookPurchases = BookPurchase::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->orderByDesc('purchased_at')
            ->get();

        return view('user.dashboard', compact('user', 'enrollments', 'bookPurchases'));
    }

    public function invoice(Request $request, BookPurchase $purchase)
    {
        if ($purchase->user_id !== $request->user()->id || $purchase->status !== 'paid') {
            abort(403);
        }

        if (! $purchase->invoice_number) {
            $purchase->update([
                'invoice_number' => BookPurchase::generateInvoiceNumber($purchase->id),
            ]);
        }

        $purchase->load(['book', 'user']);

        return view('user.invoice', compact('purchase'));
    }

    public function enrollmentReceipt(Request $request, Enrollment $enrollment)
    {
        if ($enrollment->user_id !== $request->user()->id) {
            abort(403);
        }

        $enrollment->load(['course', 'user']);

        return view('user.enrollment-receipt', compact('enrollment'));
    }
}
