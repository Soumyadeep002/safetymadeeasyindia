@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/books.css') }}">
@endpush

@section('main-container')

<div class="rts-section-gap book-page-content">
    <div class="container">
        <p class="book-breadcrumb text-muted mb-4">
            Home / Books / <span class="text-dark">{{ $book->title }}</span>
        </p>

        <div class="book-detail-card">
            <div class="row g-0">
                <div class="col-lg-5">
                    <div class="book-cover-wrap">
                        <img src="{{ $book->coverUrl() }}" alt="{{ $book->title }}">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="book-info-panel">
                        <h1 class="book-title">{{ $book->title }}</h1>
                        @if($book->author)
                            <p class="book-author">By {{ $book->author }}</p>
                        @endif

                        <div class="book-meta-row">
                            <span class="book-meta-badge price">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                {{ number_format($book->price, 2) }}
                            </span>
                            <span class="book-meta-badge">
                                <i class="fa-regular fa-file-lines"></i>
                                {{ $book->total_pages }} {{ Str::plural('page', $book->total_pages) }}
                            </span>
                            @if($isPurchased)
                                <span class="book-meta-badge" style="background:#d1e7dd;color:#0f5132;">
                                    <i class="fa-solid fa-circle-check"></i> Owned
                                </span>
                            @endif
                        </div>

                        @if($book->description)
                            <div class="book-description">{!! nl2br(e($book->description)) !!}</div>
                        @endif

                        @if($book->price > 0)
                            <div class="book-price-panel mt-4">
                                <h6 class="book-price-panel__title">Price breakdown</h6>
                                @include('partials.books.price-breakdown', ['book' => $book])
                            </div>
                        @endif

                        <div class="book-actions">
                            @if($isPurchased)
                                <a href="{{ route('books.read.full', $book) }}" class="rts-btn btn-primary" target="_blank">
                                    <i class="fa-solid fa-book-open"></i> Read Full Book
                                </a>
                            @else
                                @if($book->price > 0)
                                    <a href="{{ route('books.purchase', $book) }}" class="rts-btn btn-primary">
                                        <i class="fa-solid fa-cart-shopping"></i> Purchase
                                    </a>
                                @else
                                    <a href="{{ route('books.purchase', $book) }}" class="rts-btn btn-primary">
                                        <i class="fa-solid fa-gift"></i> Get Free Access
                                    </a>
                                @endif
                            @endif

                            <a href="{{ route('books.read.demo', $book) }}" class="rts-btn btn-border" target="_blank">
                                <i class="fa-regular fa-eye"></i> View
                            </a>
                        </div>

                        @guest
                            <div class="auth-prompt-card mt-4" style="text-align:left;">
                                <p class="auth-prompt-card__text mb-3" style="margin-bottom:12px !important;">
                                    <i class="fa-solid fa-shield-halved" style="color:#578f1e;"></i>
                                    Sign in with Google to purchase — checkout continues automatically after login.
                                </p>
                                @include('partials.auth.google-btn', [
                                    'intended' => route('books.purchase', $book),
                                    'label' => 'Sign in with Google',
                                    'block' => true,
                                ])
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
