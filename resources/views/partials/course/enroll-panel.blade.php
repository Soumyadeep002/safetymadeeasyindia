{{-- Full enroll panel for course detail sidebar --}}
@php
    $isEnrolled = $isEnrolled ?? false;
@endphp

<div class="enroll-action mt-4 mb-4">
    @auth
        @if(auth()->user()->isStudent())
            @if($isEnrolled)
                <div class="course-enrolled-panel">
                    <div class="course-enrolled-panel__icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h4>You are enrolled</h4>
                    <p>You have access to this training. Track it from your dashboard.</p>
                    <a href="{{ route('user.dashboard') }}#tab-enrollments" class="rts-btn btn-primary w-100">
                        <i class="fa-solid fa-gauge-high me-1"></i> Go to Dashboard
                    </a>
                </div>
            @else
                <div class="course-enroll-panel">
                    <h4 class="course-enroll-panel__title">Ready to join?</h4>
                    <p class="course-enroll-panel__text">Enroll for free and access this training from your dashboard.</p>
                    <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="rts-btn btn-primary w-100 course-enroll-panel__btn">
                            <i class="fa-solid fa-user-plus me-1"></i> Enroll in this Training
                        </button>
                    </form>
                </div>
            @endif
        @else
            <div class="auth-prompt-card">
                <p class="auth-prompt-card__text mb-3">Admin accounts cannot enroll. Sign in with Google as a student.</p>
                <a href="{{ route('auth.google') }}" class="rts-btn btn-primary w-100">Sign in with Google</a>
            </div>
        @endif
    @else
        <div class="auth-prompt-card">
            <div class="auth-prompt-card__icon"><i class="fa-solid fa-user-lock"></i></div>
            <h3 class="auth-prompt-card__title">Sign in to enroll</h3>
            <p class="auth-prompt-card__text">Use your Google account to enroll. Your training will appear in your dashboard.</p>
            @include('partials.auth.google-btn', [
                'intended' => url('/course-'.$course->id),
                'label' => 'Continue with Google',
                'block' => true,
                'large' => true,
            ])
        </div>
    @endauth
</div>
