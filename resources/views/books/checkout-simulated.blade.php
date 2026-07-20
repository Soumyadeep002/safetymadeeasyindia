@extends('layout.main')
@section('main-container')

<div class="rts-section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-4 shadow">
                    <h3>Test Purchase Mode</h3>
                    <p>Payments run in <strong>simulated</strong> mode for testing. No real charge will be made.</p>
                    <p><strong>{{ $book->title }}</strong></p>
                    @include('partials.books.price-breakdown', ['book' => $book])
                    <form action="{{ route('books.payment.simulated', $book) }}" method="POST">
                        @csrf
                        <button type="submit" class="rts-btn btn-primary w-100">Complete Test Purchase</button>
                    </form>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-link mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
