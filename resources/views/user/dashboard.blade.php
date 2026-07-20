@extends('layout.main')

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/books.css') }}">
@endpush

@section('main-container')

@php
    $initials = collect(explode(' ', $user->name))->filter()->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('');
@endphp

<div class="rts-section-gap book-page-content user-dashboard">
    <div class="container">

        {{-- Hero --}}
        <div class="user-dashboard__hero">
            <div class="user-dashboard__hero-inner">
                <div class="user-dashboard__profile">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="" class="user-dashboard__avatar">
                    @else
                        <span class="user-dashboard__avatar user-dashboard__avatar--placeholder">{{ strtoupper($initials) }}</span>
                    @endif
                    <div>
                        <p class="user-dashboard__welcome">Welcome back</p>
                        <h1 class="user-dashboard__name">{{ $user->name }}</h1>
                        <p class="user-dashboard__email">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="user-dashboard__hero-actions">
                    <a href="{{ route('courses') }}" class="btn-hero-outline">
                        <i class="fa-solid fa-graduation-cap"></i> Trainings
                    </a>
                    <a href="{{ route('books.index') }}" class="btn-hero-outline">
                        <i class="fa-solid fa-book"></i> Books
                    </a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="user-dashboard__stats">
            <div class="user-dashboard__stat-card">
                <div class="user-dashboard__stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <div>
                    <div class="user-dashboard__stat-value">{{ $enrollments->count() }}</div>
                    <p class="user-dashboard__stat-label">Training enrollments</p>
                </div>
            </div>
            <div class="user-dashboard__stat-card">
                <div class="user-dashboard__stat-icon"><i class="fa-solid fa-book-open"></i></div>
                <div>
                    <div class="user-dashboard__stat-value">{{ $bookPurchases->count() }}</div>
                    <p class="user-dashboard__stat-label">Books owned</p>
                </div>
            </div>
            <div class="user-dashboard__stat-card">
                <div class="user-dashboard__stat-icon"><i class="fa-solid fa-file-invoice"></i></div>
                <div>
                    <div class="user-dashboard__stat-value">{{ $bookPurchases->count() }}</div>
                    <p class="user-dashboard__stat-label">Invoices available</p>
                </div>
            </div>
        </div>

        {{-- Tabs --}}
        <ul class="nav user-dashboard__tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#tab-enrollments" role="tab">
                    <i class="fa-solid fa-graduation-cap"></i> My Trainings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-books" role="tab">
                    <i class="fa-solid fa-book"></i> My Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-invoices" role="tab">
                    <i class="fa-solid fa-receipt"></i> Invoices
                </a>
            </li>
        </ul>

        <div class="tab-content">
            {{-- Enrollments --}}
            <div class="tab-pane fade show active" id="tab-enrollments" role="tabpanel">
                <div class="user-dashboard__card">
                    @if($enrollments->isEmpty())
                        <div class="user-dashboard__empty">
                            <div class="user-dashboard__empty-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            <h4>No trainings yet</h4>
                            <p>Explore our safety training programs and enroll to track your progress here.</p>
                            <a href="{{ route('courses') }}" class="rts-btn btn-primary">Browse Trainings</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table user-dashboard__table mb-0">
                                <thead>
                                    <tr>
                                        <th>Training</th>
                                        <th>Subject</th>
                                        <th>Enrolled on</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollments as $enrollment)
                                        <tr>
                                            <td><strong>{{ $enrollment->course->course_title ?? 'N/A' }}</strong></td>
                                            <td><span class="user-dashboard__badge">{{ $enrollment->course->subject ?? '—' }}</span></td>
                                            <td>{{ $enrollment->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if($enrollment->course)
                                                    <a href="{{ url('course-'.$enrollment->course_id) }}" class="rts-btn btn-border btn-sm">View</a>
                                                    <a href="{{ route('user.enrollment.receipt', $enrollment) }}" class="rts-btn btn-border btn-sm" target="_blank">Receipt</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Books --}}
            <div class="tab-pane fade" id="tab-books" role="tabpanel">
                <div class="user-dashboard__card">
                    @if($bookPurchases->isEmpty())
                        <div class="user-dashboard__empty">
                            <div class="user-dashboard__empty-icon"><i class="fa-solid fa-book"></i></div>
                            <h4>No books purchased</h4>
                            <p>Purchase safety books to read them anytime from your dashboard.</p>
                            <a href="{{ route('books.index') }}" class="rts-btn btn-primary">Browse Books</a>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($bookPurchases as $purchase)
                                @if($purchase->book)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="user-dashboard__book-card">
                                            <div class="book-thumb">
                                                <img src="{{ $purchase->book->coverUrl() }}" alt="{{ $purchase->book->title }}">
                                            </div>
                                            <div class="book-card-body p-3">
                                                <h5 class="title mb-1">{{ $purchase->book->title }}</h5>
                                                <p class="small text-muted mb-3">
                                                    <i class="fa-regular fa-calendar"></i>
                                                    Purchased {{ $purchase->purchased_at?->format('d M Y') }}
                                                </p>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('books.read.full', $purchase->book) }}" class="rts-btn btn-primary btn-sm" target="_blank">
                                                        <i class="fa-solid fa-book-open"></i> Read
                                                    </a>
                                                    <a href="{{ route('user.invoice', $purchase) }}" class="rts-btn btn-border btn-sm" target="_blank">
                                                        <i class="fa-solid fa-file-invoice"></i> Invoice
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Invoices --}}
            <div class="tab-pane fade" id="tab-invoices" role="tabpanel">
                <div class="user-dashboard__card">
                    @if($bookPurchases->isEmpty())
                        <div class="user-dashboard__empty">
                            <div class="user-dashboard__empty-icon"><i class="fa-solid fa-receipt"></i></div>
                            <h4>No invoices yet</h4>
                            <p>Invoices are generated automatically when you purchase a book.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table user-dashboard__table mb-0">
                                <thead>
                                    <tr>
                                        <th>Invoice #</th>
                                        <th>Item</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Payment ID</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookPurchases as $purchase)
                                        <tr>
                                            <td><strong>{{ $purchase->invoice_number ?? '—' }}</strong></td>
                                            <td>{{ $purchase->book->title ?? 'Book' }}</td>
                                            <td><strong>₹{{ number_format($purchase->amount, 2) }}</strong></td>
                                            <td>{{ $purchase->purchased_at?->format('d M Y') }}</td>
                                            <td><small class="text-muted">{{ Str::limit($purchase->razorpay_payment_id, 18) }}</small></td>
                                            <td>
                                                <a href="{{ route('user.invoice', $purchase) }}" class="rts-btn btn-border btn-sm" target="_blank">
                                                    <i class="fa-solid fa-print"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if (window.location.hash) {
        const tab = document.querySelector('[href="' + window.location.hash + '"]');
        if (tab && typeof bootstrap !== 'undefined') {
            new bootstrap.Tab(tab).show();
        }
    }
</script>

@endsection
