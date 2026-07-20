@extends('layout.main')
@section('main-container')

<div class="rts-section-gap">
    <div class="container">
        <div class="title-area-left-style mb-4">
            <h2 class="title">My Enrollments</h2>
            <p class="disc">Trainings you have enrolled in after signing in with Google.</p>
        </div>

        @if($enrollments->isEmpty())
            <div class="alert alert-info">
                You have not enrolled in any training yet.
                <a href="{{ route('courses') }}">Browse trainings</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Training</th>
                            <th>Subject</th>
                            <th>Enrolled On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->course->course_title ?? 'N/A' }}</td>
                                <td>{{ $enrollment->course->subject ?? 'N/A' }}</td>
                                <td>{{ $enrollment->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($enrollment->course)
                                        <a href="{{ url('course-'.$enrollment->course_id) }}" class="rts-btn btn-border btn-sm">View Training</a>
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

@endsection
