@extends('admin.layout.main')
@section('main-container')

<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Books</li>
    </ol>
    <ul class="app-actions" style="gap: 12px;">
        <li><a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm">Add Book</a></li>
        <li><a href="{{ route('admin.books.purchases') }}" class="btn btn-outline-secondary btn-sm">Sales</a></li>
    </ul>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-container">
    <div class="t-header">All Books</div>
    <div class="table-responsive">
        <table class="table custom-table">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price (INR)</th>
                    <th>Pages</th>
                    <th>Sales</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td><img src="{{ $book->coverUrl() }}" alt="" width="50" height="65" style="object-fit:cover;"></td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author ?? '—' }}</td>
                        <td>₹{{ number_format($book->price, 2) }}</td>
                        <td>{{ $book->total_pages }}</td>
                        <td>{{ $book->sales_count }}</td>
                        <td>
                            @if($book->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('books.show', $book) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">No books uploaded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
