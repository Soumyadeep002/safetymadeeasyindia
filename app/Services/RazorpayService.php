<?php

namespace App\Services;

use Razorpay\Api\Api;

class RazorpayService
{
    /** Paste your Razorpay Dashboard → Webhooks → Webhook Secret here */
    private const WEBHOOK_SECRET = '';

    public function isConfigured(): bool
    {
        $key =  "rzp_live_SvS1LCNQE1pJj6";
        $secret = "8e56gW8Olp10TNigNljeBWNJ";
        // $key = trim((string) config('services.razorpay.key'));
        // $secret = trim((string) config('services.razorpay.secret'));

        return $key !== '' && $secret !== '';
    }

    public function api(): Api
    {
        return new Api(
            // trim((string) config('services.razorpay.key')),
            // trim((string) config('services.razorpay.secret'))
            "rzp_live_SvS1LCNQE1pJj6", "8e56gW8Olp10TNigNljeBWNJ"
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function createOrder(int $amountPaise, string $receipt, array $notes = []): array
    {
        $payload = [
            'receipt' => $receipt,
            'amount' => max(100, $amountPaise),
            'currency' => 'INR',
        ];

        if ($notes !== []) {
            $payload['notes'] = $notes;
        }

        $order = $this->api()->order->create($payload);

        return $order->toArray();
    }

    public function verifyPaymentSignature(string $orderId, string $paymentId, string $signature): void
    {
        $this->api()->utility->verifyPaymentSignature([
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $signature,
        ]);
    }

    public function verifyWebhookSignature(string $payload, string $signature): void
    {
        $secret = self::WEBHOOK_SECRET !== ''
            ? self::WEBHOOK_SECRET
            : trim((string) config('services.razorpay.webhook_secret'));

        if ($secret === '') {
            throw new \RuntimeException('Razorpay webhook secret is not configured.');
        }

        $this->api()->utility->verifyWebhookSignature($payload, $signature, $secret);
    }
}
