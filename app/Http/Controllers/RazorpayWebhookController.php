<?php

namespace App\Http\Controllers;

use App\Models\BookPurchase;
use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RazorpayWebhookController extends Controller
{
    public function __construct(private RazorpayService $razorpay) {}

    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature', '');
        // $webhookSecret = config('services.razorpay.webhook_secret');
        $webhookSecret = "cH8taN@Hs4L2UDH";

        try {
            $this->razorpay->verifyWebhookSignature($payload, $signature, $webhookSecret);
        } catch (\Exception $e) {
            Log::warning('Razorpay webhook signature verification failed', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $event = $request->input('event');
        $payment = $request->input('payload.payment.entity');

        if ($event === 'payment.captured' && $payment) {
            $this->markPurchasePaidFromWebhook(
                $payment['order_id'] ?? null,
                $payment['id'] ?? null
            );
        }

        return response()->json(['status' => 'ok']);
    }

    private function markPurchasePaidFromWebhook(?string $orderId, ?string $paymentId): void
    {
        if (! $orderId || ! $paymentId) {
            return;
        }

        $purchase = BookPurchase::where('razorpay_order_id', $orderId)
            ->where('status', 'pending')
            ->first();

        if ($purchase) {
            $purchase->markPaid($paymentId, $orderId);
        }
    }
}
