<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $purchase->invoice_number }}</title>
    <link rel="stylesheet" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
    <style>
        body { font-family: Arial, sans-serif; color: #222; padding: 24px; max-width: 800px; margin: 0 auto; }
        .invoice-header { border-bottom: 2px solid #578f1e; padding-bottom: 16px; margin-bottom: 24px; }
        .invoice-header h1 { font-size: 1.5rem; margin: 0; color: #578f1e; }
        .meta { margin-bottom: 24px; }
        .meta p { margin: 4px 0; }
        table.items { width: 100%; border-collapse: collapse; margin: 24px 0; }
        table.items th, table.items td { border: 1px solid #ddd; padding: 10px 12px; text-align: left; }
        table.items th { background: #f5f5f5; }
        table.items td.amount { text-align: right; white-space: nowrap; }
        .total-row { font-weight: bold; font-size: 1.1rem; }
        .sub-row td { background: #fafafa; font-size: 0.95rem; color: #555; }
        .paid-badge { display: inline-block; background: #d1e7dd; color: #0f5132; padding: 4px 12px; border-radius: 4px; font-size: 0.85rem; }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    @php($breakdown = $purchase->pricingBreakdown())

    <div class="no-print mb-3">
        <button onclick="window.print()" class="btn btn-success btn-sm">Print / Save PDF</button>
        <a href="{{ route('user.dashboard') }}#tab-invoices" class="btn btn-outline-secondary btn-sm">Back to Dashboard</a>
    </div>

    <div class="invoice-header d-flex justify-content-between align-items-start flex-wrap gap-3">
        <div>
            <h1>{{ config('app.name') }}</h1>
            <p class="mb-0 text-muted">{{ env('APP_WEB', 'www.safetymadeeasyindia.com') }}</p>
            <p class="mb-0 small">GST: 19AFHFS5051B1Z3</p>
        </div>
        <div class="text-end">
            <h2 class="h4 mb-1">TAX INVOICE</h2>
            <p class="mb-0"><strong>{{ $purchase->invoice_number }}</strong></p>
            <span class="paid-badge">PAID</span>
        </div>
    </div>

    <div class="row meta">
        <div class="col-md-6">
            <h6 class="text-muted">Bill To</h6>
            <p><strong>{{ $purchase->user->name }}</strong></p>
            <p>{{ $purchase->user->email }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <h6 class="text-muted">Invoice Details</h6>
            <p>Date: {{ $purchase->purchased_at?->format('d M Y, h:i A') }}</p>
            <p>Payment ID: {{ $purchase->razorpay_payment_id }}</p>
            @if($purchase->razorpay_order_id)
                <p>Order ID: {{ $purchase->razorpay_order_id }}</p>
            @endif
        </div>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Description</th>
                <th>Qty</th>
                <th class="amount">Amount (INR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $purchase->book->title ?? 'Digital Book' }}</strong>
                    @if($purchase->book?->author)
                        <br><small class="text-muted">Author: {{ $purchase->book->author }}</small>
                    @endif
                    <br><small>Digital book — online access</small>
                </td>
                <td>1</td>
                <td class="amount">₹{{ number_format($breakdown['base_price'], 2) }}</td>
            </tr>
            @if($breakdown['gst_amount'] > 0)
                <tr class="sub-row">
                    <td colspan="2">GST @ {{ rtrim(rtrim(number_format($breakdown['gst_percent'], 2), '0'), '.') }}%</td>
                    <td class="amount">₹{{ number_format($breakdown['gst_amount'], 2) }}</td>
                </tr>
            @endif
            @if($breakdown['gateway_charge_amount'] > 0)
                <tr class="sub-row">
                    <td colspan="2">Payment gateway charges @ {{ rtrim(rtrim(number_format($breakdown['gateway_charge_percent'], 2), '0'), '.') }}%</td>
                    <td class="amount">₹{{ number_format($breakdown['gateway_charge_amount'], 2) }}</td>
                </tr>
            @endif
            <tr class="total-row">
                <td colspan="2" class="text-end">Total payable</td>
                <td class="amount">₹{{ number_format($breakdown['final_price'], 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p class="small text-muted">This is a computer-generated invoice. Thank you for your purchase.</p>
</body>
</html>
