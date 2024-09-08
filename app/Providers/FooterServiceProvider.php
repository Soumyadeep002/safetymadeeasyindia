<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Blog;
use App\Models\Course;

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
        $title = env("APP_NAME") ;
        $courses = Course::all(); // Fetch all site settings from the database

        // Share the data with all views
        View::share('courses', $courses);
        View::share('title', $title);
    }
}
