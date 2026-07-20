@php
    if (! isset($breakdown)) {
        $breakdown = isset($purchase)
            ? $purchase->pricingBreakdown()
            : $book->priceBreakdown();
    }
    $compact = $compact ?? false;
@endphp

<div class="price-breakdown {{ $compact ? 'price-breakdown--compact' : '' }}">
    <div class="price-breakdown__row">
        <span>Base price</span>
        <span>₹{{ number_format($breakdown['base_price'], 2) }}</span>
    </div>
    @if($breakdown['gst_percent'] > 0)
        <div class="price-breakdown__row">
            <span>GST ({{ rtrim(rtrim(number_format($breakdown['gst_percent'], 2), '0'), '.') }}%)</span>
            <span>₹{{ number_format($breakdown['gst_amount'], 2) }}</span>
        </div>
    @endif
    @if($breakdown['gateway_charge_percent'] > 0)
        <div class="price-breakdown__row">
            <span>Payment gateway ({{ rtrim(rtrim(number_format($breakdown['gateway_charge_percent'], 2), '0'), '.') }}%)</span>
            <span>₹{{ number_format($breakdown['gateway_charge_amount'], 2) }}</span>
        </div>
    @endif
    <div class="price-breakdown__row price-breakdown__total">
        <span>Total payable</span>
        <span>₹{{ number_format($breakdown['final_price'], 2) }}</span>
    </div>
</div>
