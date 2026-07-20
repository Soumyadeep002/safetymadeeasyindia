<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Blog;
use App\Models\Course;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class FooterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $title = env('APP_NAME');

        $courses = collect();
        if (Schema::hasTable('courses')) {
            $courses = Course::where('is_active', 1)->orderBy('course_title')->get();
        }

        View::share('courses', $courses);
        View::share('title', $title);
    }
}
