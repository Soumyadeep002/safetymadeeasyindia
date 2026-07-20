<?php

namespace App\Support;

class BookPricing
{
    /**
     * @return array{
     *     base_price: float,
     *     gst_percent: float,
     *     gst_amount: float,
     *     gateway_charge_percent: float,
     *     gateway_charge_amount: float,
     *     final_price: float
     * }
     */
    public static function calculate(float $basePrice, float $gstPercent, float $gatewayPercent): array
    {
        $gstAmount = round($basePrice * $gstPercent / 100, 2);
        $subtotal = round($basePrice + $gstAmount, 2);
        $gatewayAmount = round($subtotal * $gatewayPercent / 100, 2);
        $finalPrice = round($subtotal + $gatewayAmount, 2);

        return [
            'base_price' => $basePrice,
            'gst_percent' => $gstPercent,
            'gst_amount' => $gstAmount,
            'gateway_charge_percent' => $gatewayPercent,
            'gateway_charge_amount' => $gatewayAmount,
            'final_price' => $finalPrice,
        ];
    }
}
