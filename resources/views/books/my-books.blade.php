@extends('layout.main')
@section('main-container')

<div class="rts-section-gap">
    <div class="container">
        <h2 class="title mb-4">My Books</h2>

        @if($purchases->isEmpty())
            <div class="alert alert-info">
                You have not purchased any books yet.
                <a href="{{ route('books.index') }}">Browse books</a>
            </div>
        @else
            <div class="row g-4">
                @foreach($purchases as $purchase)
                    @if($purchase->book)
                        <div class="col-md-4">
                            <div class="single-course-style-three">
                                <img src="{{ $purchase->book->coverUrl() }}" alt="" style="width:100%;height:200px;object-fit:cover;">
                                <div class="body-area p-3">
                                    <h5>{{ $purchase->book->title }}</h5>
                                    <p class="small text-muted">Purchased {{ $purchase->purchased_at?->format('d M Y') }}</p>
                                    <a href="{{ route('books.read.full', $purchase->book) }}" class="rts-btn btn-primary btn-sm" target="_blank">Read Now</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
