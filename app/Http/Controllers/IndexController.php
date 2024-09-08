<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Course;

class IndexController extends Controller
{
    public function indexPage(){
        $blogs = Blog::latest('created_at')->take(3)->get();
        $courses = Course::all();
        return view('index', compact('blogs', 'courses'));
    }

    public function aboutPage(){
        return view('about');
    }

    public function coursePage(){
        $courses1 = Course::where('course_type', 'fire-safety')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $courses2 = Course::where('course_type', 'health')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $courses3 = Course::where('course_type', 'audit')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $courses4 = Course::where('course_type', 'industry')->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        return view('course', compact('courses1', 'courses2', 'courses3', 'courses4'));
    }
    public function blogsPage(){
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('blogs', compact('blogs'));
    }
    public function contactPage(){
        return view('contact');
    }

    public function blogDetailsView($id){
        $blog = Blog::where('id', $id)->first();
        return view('blogDetails', compact('blog'));
    }

    public function courseDetailsView($id){
        $course = Course::where('id', $id)->first();
        $courses = Course::all();
        if ($course->is_active != 1) {
            return view('errors.404');
        } else {
            return view('courseDetails', compact('course', 'courses'));
        }


    }
}
