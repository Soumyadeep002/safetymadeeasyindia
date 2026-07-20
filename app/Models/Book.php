<?php

namespace App\Models;

use App\Support\BookPricing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'author',
        'cover_image',
        'pdf_path',
        'demo_pdf_path',
        'demo_uses_full_pdf',
        'total_pages',
        'base_price',
        'gst_percent',
        'gateway_charge_percent',
        'price',
        'is_active',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'gst_percent' => 'decimal:2',
        'gateway_charge_percent' => 'decimal:2',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'demo_uses_full_pdf' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Book $book) {
            if (empty($book->slug)) {
                $book->slug = Str::slug($book->title).'-'.Str::random(6);
            }
        });
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(BookPurchase::class);
    }

    public function paidPurchases(): HasMany
    {
        return $this->purchases()->where('status', 'paid');
    }

    public function isPurchasedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->purchases()
            ->where('user_id', $user->id)
            ->where('status', 'paid')
            ->exists();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** @return array<string, float> */
    public function priceBreakdown(): array
    {
        return BookPricing::calculate(
            (float) $this->base_price,
            (float) $this->gst_percent,
            (float) $this->gateway_charge_percent
        );
    }

    public function syncFinalPrice(): void
    {
        $this->price = $this->priceBreakdown()['final_price'];
    }

    public function coverUrl(): string
    {
        if (! $this->cover_image || ! Storage::disk('public')->exists($this->cover_image)) {
            return asset('assets/images/course/course.webp');
        }

        if (is_link(public_path('storage')) || is_dir(public_path('storage'))) {
            return Storage::disk('public')->url($this->cover_image);
        }

        return url('myfile/'.$this->cover_image);
    }
}
