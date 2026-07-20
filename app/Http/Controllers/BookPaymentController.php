<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookPurchase;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookPaymentController extends Controller
{
    public function __construct(private RazorpayService $razorpay) {}

    public function checkout(Request $request, Book $book)
    {
        if (! $book->is_active) {
            abort(404);
        }

        $user = $request->user();

        if ($book->isPurchasedBy($user)) {
            return redirect()->route('books.read.full', $book)
                ->with('info', 'You already own this book.');
        }

        if ($book->price <= 0) {
            $this->grantFreeBook($user, $book);

            return redirect()->route('books.read.full', $book)
                ->with('success', 'Book added to your library.');
        }

        if ($this->useSimulatedPayment()) {
            return $this->simulatedCheckout($user, $book);
        }

        if (! $this->razorpay->isConfigured()) {
            return redirect()->route('books.show', $book)
                ->with('error', 'Payment gateway is not configured. Please add RAZORPAY_KEY and RAZORPAY_SECRET to .env.');
        }

        return $this->razorpayCheckout($user, $book);
    }

    public function verify(Request $request, Book $book)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $user = $request->user();
        $purchase = BookPurchase::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('razorpay_order_id', $request->razorpay_order_id)
            ->where('status', 'pending')
            ->firstOrFail();

        if ($this->useSimulatedPayment()) {
            $purchase->markPaid('sim_'.uniqid(), $request->razorpay_order_id);

            return redirect()->route('books.read.full', $book)
                ->with('success', 'Payment successful. View your invoice in My Dashboard.');
        }

        try {
            $this->razorpay->verifyPaymentSignature(
                $request->razorpay_order_id,
                $request->razorpay_payment_id,
                $request->razorpay_signature
            );

            $purchase->markPaid($request->razorpay_payment_id, $request->razorpay_order_id);

            return redirect()->route('books.read.full', $book)
                ->with('success', 'Payment successful. View your invoice in My Dashboard.');
        } catch (\Exception $e) {
            Log::error('Razorpay verification failed', ['error' => $e->getMessage()]);
            $purchase->update(['status' => 'failed']);

            return redirect()->route('books.show', $book)
                ->with('error', 'Payment verification failed. Please contact support.');
        }
    }

    private function razorpayCheckout($user, Book $book)
    {
        $amountPaise = (int) round($book->price * 100);

        $purchase = BookPurchase::createPendingFromBook($user->id, $book);

        try {
            $order = $this->razorpay->createOrder(
                $amountPaise,
                'book_'.$book->id.'_u'.$user->id.'_'.time(),
                [
                    'book_id' => (string) $book->id,
                    'user_id' => (string) $user->id,
                    'purchase_id' => (string) $purchase->id,
                ]
            );

            $purchase->update(['razorpay_order_id' => $order['id']]);

            return view('books.checkout', [
                'book' => $book,
                'purchase' => $purchase,
                // 'razorpayKey' => config('services.razorpay.key'),
                'razorpayKey' =>  "rzp_live_SvS1LCNQE1pJj6",
                'orderId' => $order['id'],
                'amount' => $order['amount'],
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            $purchase->update(['status' => 'failed']);
            Log::error('Razorpay order creation failed', [
                'error' => $e->getMessage(),
                'book_id' => $book->id,
                'user_id' => $user->id,
            ]);

            $message = str_contains(strtolower($e->getMessage()), 'authentication')
                ? 'Razorpay authentication failed. Please verify RAZORPAY_KEY and RAZORPAY_SECRET in your .env file match your Razorpay Dashboard (Test/Live mode).'
                : 'Unable to start payment. Please try again later.';

            return redirect()->route('books.show', $book)->with('error', $message);
        }
    }

    private function simulatedCheckout($user, Book $book)
    {
        $purchase = BookPurchase::createPendingFromBook($user->id, $book);
        $purchase->update(['razorpay_order_id' => 'sim_order_'.uniqid()]);

        return view('books.checkout-simulated', compact('book', 'purchase'));
    }

    public function completeSimulated(Request $request, Book $book)
    {
        $user = $request->user();
        $purchase = BookPurchase::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'pending')
            ->latest()
            ->firstOrFail();

        $purchase->markPaid('sim_payment_'.uniqid(), $purchase->razorpay_order_id);

        return redirect()->route('books.read.full', $book)
            ->with('success', 'Purchase completed (test mode).');
    }

    private function grantFreeBook($user, Book $book): void
    {
        $purchase = BookPurchase::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if ($purchase) {
            $purchase->markPaid('free_access', $purchase->razorpay_order_id);

            return;
        }

        BookPurchase::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'amount' => 0,
            'base_price' => 0,
            'gst_percent' => 0,
            'gst_amount' => 0,
            'gateway_charge_percent' => 0,
            'gateway_charge_amount' => 0,
            'currency' => 'INR',
            'razorpay_order_id' => 'free_'.uniqid(),
            'razorpay_payment_id' => 'free_access',
            'status' => 'paid',
            'purchased_at' => now(),
        ]);
    }

    private function useSimulatedPayment(): bool
    {
        if (config('services.razorpay.payment_mode') === 'simulated') {
            return true;
        }

        return ! $this->razorpay->isConfigured();
    }
}
