@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/checkout.css') }}">
@endpush

@section('main-container')

<div class="rts-section-gap checkout-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="checkout-card">
                    <div class="checkout-card__header">
                        <h2><i class="fa-solid fa-lock me-2"></i> Secure Checkout</h2>
                        <p>Complete your purchase via Razorpay</p>
                    </div>
                    <div class="checkout-card__body">
                        <div class="checkout-summary">
                            <div class="checkout-summary__row">
                                <span>Book</span>
                                <strong>{{ $book->title }}</strong>
                            </div>
                            @include('partials.books.price-breakdown', ['book' => $book, 'compact' => true])
                        </div>

                        <div class="checkout-secure">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>256-bit SSL encrypted · Powered by Razorpay</span>
                        </div>

                        <div id="checkout-loading" class="checkout-loading">
                            <div class="spinner"></div>
                            <p>Opening payment window…</p>
                        </div>

                        <button type="button" id="rzp-button" class="checkout-btn-pay d-none">
                            <i class="fa-solid fa-credit-card"></i>
                            Pay ₹{{ number_format($book->price, 2) }}
                        </button>

                        <a href="{{ route('books.show', $book) }}" class="checkout-cancel">Cancel and go back</a>

                        <p class="checkout-powered">
                            Secured by <strong>Razorpay</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
(function () {
    var loadingEl = document.getElementById('checkout-loading');
    var payBtn = document.getElementById('rzp-button');

    function showPayButton() {
        loadingEl.classList.add('d-none');
        payBtn.classList.remove('d-none');
    }

    var options = {
        key: @json($razorpayKey),
        amount: @json($amount),
        currency: 'INR',
        name: @json(config('app.name')),
        description: @json($book->title),
        order_id: @json($orderId),
        handler: function (response) {
            loadingEl.classList.remove('d-none');
            payBtn.classList.add('d-none');
            loadingEl.querySelector('p').textContent = 'Verifying payment…';

            var form = document.createElement('form');
            form.method = 'POST';
            form.action = @json(route('books.payment.verify', $book));

            var csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = @json(csrf_token());
            form.appendChild(csrf);

            ['razorpay_payment_id', 'razorpay_order_id', 'razorpay_signature'].forEach(function (name) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = response[name];
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        },
        prefill: {
            name: @json($user->name),
            email: @json($user->email),
        },
        theme: {
            color: '#578f1e'
        },
        modal: {
            ondismiss: function () {
                showPayButton();
            }
        }
    };

    var rzp = new Razorpay(options);

    rzp.on('payment.failed', function (response) {
        showPayButton();
        alert(response.error.description || 'Payment failed. Please try again.');
    });

    function openCheckout() {
        try {
            rzp.open();
        } catch (e) {
            showPayButton();
        }
    }

    payBtn.addEventListener('click', openCheckout);

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(openCheckout, 400);
        });
    } else {
        setTimeout(openCheckout, 400);
    }
})();
</script>

@endsection
