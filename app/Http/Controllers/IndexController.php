<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Enrollment;

class IndexController extends Controller
{
    private function enrolledCourseIds(): array
    {
        if (! Auth::check() || ! Auth::user()->isStudent()) {
            return [];
        }

        return Enrollment::where('user_id', Auth::id())
            ->pluck('course_id')
            ->all();
    }

    public function indexPage(){
        $blogs = Blog::latest('created_at')->where('status', 'published')->take(3)->get();
        $courses = Course::where('is_active', 1)->latest()->take(6)->get();
        $enrolledCourseIds = $this->enrolledCourseIds();

        return view('index', compact('blogs', 'courses', 'enrolledCourseIds'));
    }

    public function aboutPage(){
        return view('about');
    }

    public function coursePage(){
        $courses1 = Course::where('course_type', 'fire-safety')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $courses2 = Course::where('course_type', 'health')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $courses3 = Course::where('course_type', 'audit')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $courses4 = Course::where('course_type', 'industry')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $enrolledCourseIds = $this->enrolledCourseIds();

        return view('course', compact('courses1', 'courses2', 'courses3', 'courses4', 'enrolledCourseIds'));
    }
    public function blogsPage(){
        $blogs = Blog::with('category')->orderBy('created_at', 'desc')->where('status', 'published')->get();
        return view('blogs', compact('blogs'));
        // return response()->json($blogs, 200);
    }
    public function contactPage(){
        return view('contact');
    }

    public function blogDetailsView($slug){
        $blog = Blog::where('status', 'published')->where('slug', $slug)->first();

        if (! $blog) {
            abort(404);
        }

        return view('blogDetails', compact('blog'));
    }

    public function courseDetailsView($id)
    {
        $course = Course::where('id', $id)->first();

        if (! $course || $course->is_active != 1) {
            return view('errors.404');
        }

        $courses = Course::where('is_active', 1)->orderBy('course_title')->get();
        $isEnrolled = false;

        if (Auth::check() && Auth::user()->isStudent()) {
            $isEnrolled = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->exists();
        }

        return view('courseDetails', compact('course', 'courses', 'isEnrolled'));
    }
}
