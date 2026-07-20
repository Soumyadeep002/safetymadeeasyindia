@extends('admin.layout.main')
@section('main-container')

<style>
    .enrollment-filter-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 16px;
        padding: 20px 24px;
        background: #fafbfc;
        border-bottom: 1px solid #eef0f2;
    }
    .enrollment-filter-bar label { font-weight: 600; font-size: 0.9rem; margin-bottom: 6px; display: block; }
    .enrollment-filter-bar select { min-width: 280px; }
    .enrollment-student-avatar {
        width: 40px; height: 40px; border-radius: 50%; object-fit: cover;
        border: 2px solid #578f1e; flex-shrink: 0;
    }
    .enrollment-student-avatar--placeholder {
        display: inline-flex; align-items: center; justify-content: center;
        background: #578f1e; color: #fff; font-weight: 700; font-size: 0.85rem;
    }
    .enrollment-list-table thead th {
        background: #f8f9fa; font-size: 0.85rem; text-transform: uppercase;
        letter-spacing: .04em; color: #6c757d; white-space: nowrap;
    }
    .enrollment-list-table tbody td { vertical-align: middle; font-size: 0.95rem; }
    .training-name-cell strong { display: block; font-size: 1rem; }
    .training-name-cell small { color: #6c757d; }
</style>

<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Training Enrollments</li>
    </ol>
    <ul class="app-actions">
        <li><a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary btn-sm">Manage Trainings</a></li>
    </ul>
</div>

<div class="row gutters mb-3">
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Total Enrollments</h6>
            <h3 class="mb-0">{{ $totalEnrollments }}</h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Showing</h6>
            <h3 class="mb-0">{{ $enrollments->count() }}</h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Trainings with Enrollments</h6>
            <h3 class="mb-0">{{ $coursesWithEnrollments }}</h3>
        </div></div>
    </div>
</div>

<div class="table-container">
    <div class="t-header">All Enrollments</div>

    <form method="GET" action="{{ route('enrollments') }}" class="enrollment-filter-bar">
        <div>
            <label for="course_id">Filter by Training</label>
            <select name="course_id" id="course_id" class="form-control" onchange="this.form.submit()">
                <option value="">All Trainings</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ (string) $courseFilter === (string) $course->id ? 'selected' : '' }}>
                        {{ $course->course_title }}
                        @if($course->subject) ({{ $course->subject }}) @endif
                    </option>
                @endforeach
            </select>
        </div>
        @if($courseFilter)
            <a href="{{ route('enrollments') }}" class="btn btn-outline-secondary">Clear Filter</a>
        @endif
    </form>

    <div class="table-responsive">
        <table id="copy-print-csv" class="table custom-table enrollment-list-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Training</th>
                    <th>Student</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Enrolled On</th>
                    <th>Receipt</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $index => $enrollment)
                    @php
                        $student = $enrollment->user;
                        $course = $enrollment->course;
                        $initials = $student
                            ? collect(explode(' ', $student->name))->filter()->map(fn ($w) => strtoupper(substr($w, 0, 1)))->take(2)->implode('')
                            : '?';
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="training-name-cell">
                            @if($course)
                                <strong>{{ $course->course_title }}</strong>
                                <small>
                                    {{ ucfirst(str_replace('-', ' ', $course->course_type)) }}
                                    @if($course->subject) &middot; {{ $course->subject }} @endif
                                </small>
                            @else
                                <span class="text-muted">Training removed</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center" style="gap:12px;">
                                @if($student?->avatar)
                                    <img src="{{ $student->avatar }}" alt="" class="enrollment-student-avatar" referrerpolicy="no-referrer">
                                @else
                                    <span class="enrollment-student-avatar enrollment-student-avatar--placeholder">{{ $initials }}</span>
                                @endif
                                <div>
                                    <strong>{{ $student?->name ?? 'Unknown user' }}</strong>
                                    @if($student)
                                        <br><small class="text-muted">ID #{{ $student->id }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($student?->email)
                                <a href="mailto:{{ $student->email }}">{{ $student->email }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if($student?->google_id)
                                <span class="badge badge-info">Google</span>
                            @elseif($student)
                                <span class="badge badge-secondary">Email</span>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            {{ $enrollment->created_at->format('d M Y') }}
                            <br><small class="text-muted">{{ $enrollment->created_at->format('h:i A') }}</small>
                        </td>
                        <td>
                            @if($student)
                                <a href="{{ route('admin.enrollments.receipt', $enrollment) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    Receipt
                                </a>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            @if($courseFilter)
                                No enrollments found for this training.
                            @else
                                No enrollments yet.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
