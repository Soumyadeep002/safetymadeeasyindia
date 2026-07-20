@extends('admin.layout.main')
@section('main-container')

<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Trainings</a></li>
        <li class="breadcrumb-item">{{ $course ? 'Edit' : 'Add' }} Training</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ $course ? route('admin.courses.update', $course) : route('admin.courses.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($course) @method('PUT') @endif

            <div class="row gutters">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Training Title *</label>
                        <input type="text" name="course_title" class="form-control form-control-lg"
                               value="{{ old('course_title', $course->course_title ?? '') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category *</label>
                        <select name="course_type" class="form-control form-control-lg" required>
                            <option value="">Select category</option>
                            @foreach($courseTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('course_type', $course->course_type ?? '') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control"
                               value="{{ old('subject', $course->subject ?? 'Safety Training') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Instructor / Tutor</label>
                        <input type="text" name="tutor" class="form-control"
                               value="{{ old('tutor', $course->tutor ?? 'Safetymadeeasy, India') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Level</label>
                        <input type="text" name="level" class="form-control"
                               value="{{ old('level', $course->level ?? 'Beginner') }}">
                    </div>
                </div>
            </div>

            <div class="row gutters">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Duration</label>
                        <input type="text" name="duration" class="form-control"
                               value="{{ old('duration', $course->duration ?? '6 hours') }}" placeholder="e.g. 8 hours">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Students (display text)</label>
                        <input type="text" name="students" class="form-control"
                               value="{{ old('students', $course->students ?? '100') }}" placeholder="e.g. 250">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Thumbnail Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @if($course?->image)
                            <img src="{{ $course->imageUrl() }}" class="mt-2 rounded" width="120" alt="">
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>About this training *</label>
                <textarea name="course_para_1" class="form-control summernote" rows="6" required>{{ old('course_para_1', $course->course_para_1 ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Additional content (optional)</label>
                <textarea name="course_para_2" class="form-control summernote" rows="4">{{ old('course_para_2', $course->course_para_2 ?? '') }}</textarea>
            </div>

            <div class="row gutters">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Extra paragraph 3</label>
                        <textarea name="course_para_3" class="form-control" rows="3">{{ old('course_para_3', $course->course_para_3 ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Extra paragraph 4</label>
                        <textarea name="course_para_4" class="form-control" rows="3">{{ old('course_para_4', $course->course_para_4 ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <hr>
            <h5 class="mb-3">FAQ (optional)</h5>
            <div class="row gutters">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Question 1</label>
                        <input type="text" name="question_1" class="form-control"
                               value="{{ old('question_1', $course->question_1 ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Answer 1</label>
                        <textarea name="ans_1" class="form-control" rows="2">{{ old('ans_1', $course->ans_1 ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Question 2</label>
                        <input type="text" name="question_2" class="form-control"
                               value="{{ old('question_2', $course->question_2 ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Answer 2</label>
                        <textarea name="ans_2" class="form-control" rows="2">{{ old('ans_2', $course->ans_2 ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Question 3</label>
                        <input type="text" name="question_3" class="form-control"
                               value="{{ old('question_3', $course->question_3 ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>Answer 3</label>
                        <textarea name="ans_3" class="form-control" rows="2">{{ old('ans_3', $course->ans_3 ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group form-check mt-3">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                    {{ old('is_active', $course->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    <strong>List on website</strong> (uncheck to save as unlisted / draft)
                </label>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">{{ $course ? 'Update Training' : 'Create Training' }}</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
