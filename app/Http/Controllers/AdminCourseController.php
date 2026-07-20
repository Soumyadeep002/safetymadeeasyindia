<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminCourseController extends Controller
{
    public const COURSE_TYPES = [
        'fire-safety' => 'Fire Safety',
        'health' => 'Health & Safety',
        'audit' => 'Audit',
        'industry' => 'Industry Specific',
    ];

    public function index()
    {
        $courses = Course::withCount('enrollments')
            ->orderByDesc('created_at')
            ->get();

        $listedCount = $courses->where('is_active', 1)->count();
        $unlistedCount = $courses->where('is_active', 0)->count();

        return view('admin.courses.index', compact('courses', 'listedCount', 'unlistedCount'));
    }

    public function create()
    {
        return view('admin.courses.form', [
            'course' => null,
            'courseTypes' => self::COURSE_TYPES,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedCourseData($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['image'] = $this->storeCourseImage($request, null);

        Course::create($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Training created successfully.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.form', [
            'course' => $course,
            'courseTypes' => self::COURSE_TYPES,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $data = $this->validatedCourseData($request);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $this->deleteCourseImage($course->image);
            $data['image'] = $this->storeCourseImage($request, $course);
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Training updated successfully.');
    }

    public function toggleStatus(Course $course)
    {
        $course->update(['is_active' => ! $course->is_active]);

        $message = $course->is_active
            ? 'Training is now listed on the website.'
            : 'Training has been unlisted from the website.';

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Course $course)
    {
        if ($course->enrollments()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete a training with student enrollments. Unlist it instead.');
        }

        $this->deleteCourseImage($course->image);
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Training deleted successfully.');
    }

    private function validatedCourseData(Request $request): array
    {
        $request->validate([
            'course_title' => 'required|string|max:255',
            'tutor' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'course_type' => 'required|in:'.implode(',', array_keys(self::COURSE_TYPES)),
            'level' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'students' => 'nullable|string|max:50',
            'course_para_1' => 'required|string',
            'course_para_2' => 'nullable|string',
            'course_para_3' => 'nullable|string',
            'course_para_4' => 'nullable|string',
            'question_1' => 'nullable|string',
            'ans_1' => 'nullable|string',
            'question_2' => 'nullable|string',
            'ans_2' => 'nullable|string',
            'question_3' => 'nullable|string',
            'ans_3' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        return $request->only([
            'course_title',
            'tutor',
            'subject',
            'course_type',
            'level',
            'duration',
            'students',
            'course_para_1',
            'course_para_2',
            'course_para_3',
            'course_para_4',
            'question_1',
            'ans_1',
            'question_2',
            'ans_2',
            'question_3',
            'ans_3',
        ]);
    }

    private function storeCourseImage(Request $request, ?Course $course): string
    {
        if (! $request->hasFile('image')) {
            return $course?->image ?? 'course.webp';
        }

        $dir = public_path('assets/images/course');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = 'course_'.time().'_'.Str::random(6).'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($dir, $filename);

        return $filename;
    }

    private function deleteCourseImage(?string $filename): void
    {
        if (! $filename || $filename === 'course.webp') {
            return;
        }

        $path = public_path('assets/images/course/'.$filename);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
