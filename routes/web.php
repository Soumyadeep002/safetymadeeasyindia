<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'indexPage'])->name('home');
Route::get('/about-us', [IndexController::class, 'aboutPage'])->name('about');
Route::get('/trainings', [IndexController::class, 'coursePage'])->name('courses');
Route::get('/blogs', [IndexController::class, 'blogsPage'])->name('blogs');
Route::get('/contact-us', [IndexController::class, 'contactPage'])->name('contact');
Route::get('/blog-{id}', [IndexController::class, 'blogDetailsView']);
Route::get('/course-{id}', [IndexController::class, 'courseDetailsView']);

