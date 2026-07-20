@extends('admin.layout.main')
@section('main-container')

<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Trainings</li>
    </ol>
    <ul class="app-actions" style="gap: 12px;">
        <li><a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-sm">Add Training</a></li>
    </ul>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row gutters mb-3">
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Total Trainings</h6>
            <h3 class="mb-0">{{ $courses->count() }}</h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Listed (visible)</h6>
            <h3 class="mb-0 text-success">{{ $listedCount }}</h3>
        </div></div>
    </div>
    <div class="col-md-4">
        <div class="card"><div class="card-body">
            <h6 class="text-muted">Unlisted (hidden)</h6>
            <h3 class="mb-0 text-secondary">{{ $unlistedCount }}</h3>
        </div></div>
    </div>
</div>

<div class="table-container">
    <div class="t-header">All Training Plans</div>
    <div class="table-responsive">
        <table id="copy-print-csv" class="table custom-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Subject</th>
                    <th>Tutor</th>
                    <th>Enrolled</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td>
                            <img src="{{ $course->imageUrl() }}" alt="" width="56" height="42" style="object-fit:cover;border-radius:4px;">
                        </td>
                        <td><strong>{{ $course->course_title }}</strong></td>
                        <td>
                            <span class="badge badge-info">{{ ucfirst(str_replace('-', ' ', $course->course_type)) }}</span>
                        </td>
                        <td>{{ $course->subject }}</td>
                        <td>{{ $course->tutor }}</td>
                        <td>{{ $course->enrollments_count }}</td>
                        <td>
                            @if($course->is_active)
                                <span class="badge badge-success">Listed</span>
                            @else
                                <span class="badge badge-secondary">Unlisted</span>
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <a href="{{ route('course.details', ['id' => $course->id]) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.courses.toggle', $course) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $course->is_active ? 'btn-secondary' : 'btn-success' }}">
                                    {{ $course->is_active ? 'Unlist' : 'List' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this training permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No trainings yet. <a href="{{ route('admin.courses.create') }}">Add your first training</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
