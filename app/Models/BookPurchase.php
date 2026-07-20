<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'amount',
        'base_price',
        'gst_percent',
        'gst_amount',
        'gateway_charge_percent',
        'gateway_charge_amount',
        'currency',
        'razorpay_order_id',
        'razorpay_payment_id',
        'invoice_number',
        'status',
        'purchased_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'base_price' => 'decimal:2',
        'gst_percent' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'gateway_charge_percent' => 'decimal:2',
        'gateway_charge_amount' => 'decimal:2',
        'purchased_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public static function generateInvoiceNumber(int $id): string
    {
        return 'INV-'.date('Y').'-'.str_pad((string) $id, 6, '0', STR_PAD_LEFT);
    }

    /** @return array<string, float> */
    public function pricingBreakdown(): array
    {
        if ($this->base_price !== null) {
            return [
                'base_price' => (float) $this->base_price,
                'gst_percent' => (float) ($this->gst_percent ?? 0),
                'gst_amount' => (float) ($this->gst_amount ?? 0),
                'gateway_charge_percent' => (float) ($this->gateway_charge_percent ?? 0),
                'gateway_charge_amount' => (float) ($this->gateway_charge_amount ?? 0),
                'final_price' => (float) $this->amount,
            ];
        }

        return [
            'base_price' => (float) $this->amount,
            'gst_percent' => 0,
            'gst_amount' => 0,
            'gateway_charge_percent' => 0,
            'gateway_charge_amount' => 0,
            'final_price' => (float) $this->amount,
        ];
    }

    public static function createPendingFromBook(int $userId, Book $book): self
    {
        $breakdown = $book->priceBreakdown();

        return self::create([
            'user_id' => $userId,
            'book_id' => $book->id,
            'amount' => $breakdown['final_price'],
            'base_price' => $breakdown['base_price'],
            'gst_percent' => $breakdown['gst_percent'],
            'gst_amount' => $breakdown['gst_amount'],
            'gateway_charge_percent' => $breakdown['gateway_charge_percent'],
            'gateway_charge_amount' => $breakdown['gateway_charge_amount'],
            'currency' => 'INR',
            'status' => 'pending',
        ]);
    }

    public function markPaid(string $paymentId, ?string $orderId = null): void
    {
        $data = [
            'status' => 'paid',
            'razorpay_payment_id' => $paymentId,
            'razorpay_order_id' => $orderId ?? $this->razorpay_order_id,
            'purchased_at' => now(),
        ];

        if (! $this->invoice_number) {
            $data['invoice_number'] = self::generateInvoiceNumber($this->id);
        }

        $this->update($data);
    }
}
