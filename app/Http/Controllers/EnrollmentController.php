<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $course = Course::where('id', $courseId)->where('is_active', 1)->firstOrFail();

        $user = $request->user();

        if ($user->is_admin) {
            return redirect()->route('courses')
                ->with('error', 'Admins cannot enroll as students. Use a Google account for enrollment.');
        }

        $exists = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($exists) {
            return redirect()->route('course.details', ['id' => $course->id])
                ->with('info', 'You are already enrolled in this training.');
        }

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'You have successfully enrolled in '.$course->course_title.'.');
    }

    public function myEnrollments(Request $request)
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('my-enrollments', compact('enrollments'));
    }
}
