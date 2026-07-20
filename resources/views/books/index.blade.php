@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/books.css') }}">
@endpush

@section('main-container')

<div class="rts-section-gap book-page-content">
    <div class="container">
        <div class="title-area-left-style mb-5">
            <div class="pre-title">
                <img src="{{ url('assets/images/banner/bulb.png') }}" alt="">
                <span>Digital Library</span>
            </div>
            <h2 class="title">Safety Books</h2>
            <p class="disc mb-0">Read page 1 free without login. Sign in with Google and purchase to read the full book in your browser.</p>
        </div>

        <div class="row g-4">
            @forelse($books as $book)
                <div class="col-lg-4 col-md-6">
                    <article class="book-grid-card">
                        <a href="{{ route('books.show', $book) }}" class="book-thumb">
                            <img loading="lazy" src="{{ $book->coverUrl() }}" alt="{{ $book->title }}">
                        </a>
                        <div class="book-card-body">
                            <a href="{{ route('books.show', $book) }}">
                                <h5 class="title">{{ $book->title }}</h5>
                            </a>
                            @if($book->author)
                                <p class="mb-2 text-muted"><small>By {{ $book->author }}</small></p>
                            @endif
                            <p class="mb-2">
                                <strong class="text-success">₹{{ number_format($book->price, 2) }}</strong>
                                <span class="text-muted"> · {{ $book->total_pages }} pages</span>
                            </p>
                            @if(in_array($book->id, $purchasedIds))
                                <span class="badge bg-success mb-2">Purchased</span>
                            @endif
                            <div class="book-card-actions d-flex flex-wrap gap-2">
                                <a href="{{ route('books.show', $book) }}" class="rts-btn btn-border btn-sm">Details</a>
                                @if(!in_array($book->id, $purchasedIds))
                                    <a href="{{ route('books.purchase', $book) }}" class="rts-btn btn-primary btn-sm">Purchase</a>
                                @else
                                    <a href="{{ route('books.read.full', $book) }}" class="rts-btn btn-primary btn-sm" target="_blank">Read</a>
                                @endif
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">No books available yet.</div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
