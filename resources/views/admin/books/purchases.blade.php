@extends('admin.layout.main')
@section('main-container')

<style>
    .sales-filter-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 16px;
        padding: 20px 24px;
        background: #fafbfc;
        border-bottom: 1px solid #eef0f2;
    }
    .sales-filter-bar label { font-weight: 600; font-size: 0.9rem; margin-bottom: 6px; display: block; }
    .sales-filter-bar select { min-width: 280px; }
    .sales-student-avatar {
        width: 40px; height: 40px; border-radius: 50%; object-fit: cover;
        border: 2px solid #578f1e; flex-shrink: 0;
    }
    .sales-student-avatar--placeholder {
        display: inline-flex; align-items: center; justify-content: center;
        background: #578f1e; color: #fff; font-weight: 700; font-size: 0.85rem;
    }
    .sales-list-table thead th {
        background: #f8f9fa; font-size: 0.85rem; text-transform: uppercase;
        letter-spacing: .04em; color: #6c757d; white-space: nowrap;
    }
    .sales-list-table tbody td { vertical-align: middle; font-size: 0.95rem; }
    .book-name-cell strong { display: block; font-size: 1rem; }
    .book-name-cell small { color: #6c757d; }
</style>

<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Book Sales</li>
    </ol>
    <ul class="app-actions">
        <li><a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary btn-sm">All Books</a></li>
    </ul>
</div>

<div class="row gutters mb-3">
    <div class="col-md-3">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Total Sales</h6>
            <h3 class="mb-0">{{ $totalSales }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Showing</h6>
            <h3 class="mb-0">{{ $purchases->count() }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Total Revenue</h6>
            <h3 class="mb-0">₹{{ number_format($totalRevenue, 2) }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Books Sold</h6>
            <h3 class="mb-0">{{ $booksWithSales }}</h3>
        </div></div>
    </div>
</div>

<div class="table-container">
    <div class="t-header">All Book Sales</div>

    <form method="GET" action="{{ route('admin.books.purchases') }}" class="sales-filter-bar">
        <div>
            <label for="book_id">Filter by Book</label>
            <select name="book_id" id="book_id" class="form-control" onchange="this.form.submit()">
                <option value="">All Books</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ (string) $bookFilter === (string) $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                        @if($book->author) — {{ $book->author }} @endif
                    </option>
                @endforeach
            </select>
        </div>
        @if($bookFilter)
            <a href="{{ route('admin.books.purchases') }}" class="btn btn-outline-secondary">Clear Filter</a>
        @endif
    </form>

    <div class="table-responsive">
        <table id="copy-print-csv" class="table custom-table sales-list-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book</th>
                    <th>Buyer</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Invoice #</th>
                    <th>Purchased On</th>
                    <th>Invoice</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $index => $purchase)
                    @php
                        $buyer = $purchase->user;
                        $book = $purchase->book;
                        $initials = $buyer
                            ? collect(explode(' ', $buyer->name))->filter()->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('')
                            : '?';
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="book-name-cell">
                            @if($book)
                                <strong>{{ $book->title }}</strong>
                                @if($book->author)
                                    <small>{{ $book->author }}</small>
                                @endif
                            @else
                                <span class="text-muted">Book removed</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center" style="gap:12px;">
                                @if($buyer?->avatar)
                                    <img src="{{ $buyer->avatar }}" alt="" class="sales-student-avatar" referrerpolicy="no-referrer">
                                @else
                                    <span class="sales-student-avatar sales-student-avatar--placeholder">{{ $initials }}</span>
                                @endif
                                <div>
                                    <strong>{{ $buyer?->name ?? 'Unknown' }}</strong>
                                    @if($buyer)
                                        <br><small class="text-muted">ID #{{ $buyer->id }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($buyer?->email)
                                <a href="mailto:{{ $buyer->email }}">{{ $buyer->email }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td><strong>₹{{ number_format($purchase->amount, 2) }}</strong></td>
                        <td>{{ $purchase->invoice_number ?? '—' }}</td>
                        <td>
                            {{ $purchase->purchased_at?->format('d M Y') ?? '—' }}
                            @if($purchase->purchased_at)
                                <br><small class="text-muted">{{ $purchase->purchased_at->format('h:i A') }}</small>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.books.invoice', $purchase) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            @if($bookFilter)
                                No sales found for this book.
                            @else
                                No book sales yet.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
