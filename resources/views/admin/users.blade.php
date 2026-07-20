@extends('admin.layout.main')
@section('main-container')

<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Registered Users</li>
    </ol>
</div>

<div class="row gutters mb-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">Total Users</h6>
                <h3 class="mb-0">{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">Google Sign-in</h6>
                <h3 class="mb-0">{{ $googleUsers }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">Email / Password</h6>
                <h3 class="mb-0">{{ $totalUsers - $googleUsers }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row gutters">
    <div class="col-sm-12">
        <div class="table-container">
            <div class="t-header">All Registered Students</div>
            <div class="table-responsive">
                <table id="copy-print-csv" class="table custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Login Type</th>
                            <th>Enrollments</th>
                            <th>Books</th>
                            <th>Registered</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            @php
                                $initials = collect(explode(' ', $user->name))
                                    ->filter()
                                    ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
                                    ->take(2)
                                    ->implode('');
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                             width="48" height="48"
                                             class="rounded-circle"
                                             style="object-fit:cover;border:2px solid #578f1e;"
                                             referrerpolicy="no-referrer">
                                    @else
                                        <span class="rounded-circle d-inline-flex align-items-center justify-content-center text-white font-weight-bold"
                                              style="width:48px;height:48px;background:#578f1e;font-size:1rem;">
                                            {{ $initials ?: 'U' }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                    @if($user->google_id)
                                        <br><small class="text-muted">ID: {{ Str::limit($user->google_id, 18) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </td>
                                <td>
                                    @if($user->google_id)
                                        <span class="badge badge-info">Google</span>
                                    @else
                                        <span class="badge badge-secondary">Email</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $user->enrollments_count }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">{{ $user->paid_books_count }}</span>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}<br>
                                    <small class="text-muted">{{ $user->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge badge-success">Verified</span>
                                    @else
                                        <span class="badge badge-warning">Unverified</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No registered users yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
