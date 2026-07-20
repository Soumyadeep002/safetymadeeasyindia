{{-- Compact enroll button for course cards --}}
@php
    $enrolledIds = $enrolledIds ?? [];
    $isEnrolled = in_array($course->id, $enrolledIds);
@endphp

<div class="course-enroll-cta">
    @auth
        @if(auth()->user()->isStudent())
            @if($isEnrolled)
                <span class="course-enrolled-badge">
                    <i class="fa-solid fa-circle-check"></i> Enrolled
                </span>
                <a href="{{ route('user.dashboard') }}#tab-enrollments" class="rts-btn btn-border w-100 mt-2">
                    View in Dashboard
                </a>
            @else
                <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="rts-btn btn-primary w-100">
                        <i class="fa-solid fa-user-plus me-1"></i> Enroll Now
                    </button>
                </form>
            @endif
        @else
            <a href="{{ route('course.details', ['id' => $course->id]) }}" class="rts-btn btn-border w-100">
                View Details
            </a>
        @endif
    @else
        <a href="{{ route('auth.google', ['intended' => url('/course-'.$course->id)]) }}" class="rts-btn btn-primary w-100">
            <i class="fa-brands fa-google me-1"></i> Sign in to Enroll
        </a>
    @endauth
</div>
