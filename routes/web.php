<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookPaymentController;
use App\Http\Controllers\RazorpayWebhookController;
use App\Http\Controllers\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [IndexController::class, 'indexPage'])->name('home');
Route::get('/about-us', [IndexController::class, 'aboutPage'])->name('about');
Route::get('/trainings', [IndexController::class, 'coursePage'])->name('courses');
Route::get('/blogs', [IndexController::class, 'blogsPage'])->name('blogs');
Route::get('/contact-us', [IndexController::class, 'contactPage'])->name('contact');
Route::get('/blog/{slug}', [IndexController::class, 'blogDetailsView']);
Route::get('/course-{id}', [IndexController::class, 'courseDetailsView'])->name('course.details');

// Books (public listing & demo)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/books/{book}/purchase', [BookController::class, 'purchase'])->name('books.purchase');
Route::get('/books/{book}/read-demo', [BookController::class, 'readDemo'])->name('books.read.demo');
Route::get('/books/{book}/stream/demo', [BookController::class, 'streamDemo'])->name('books.stream.demo');

// Razorpay webhook (no CSRF)
Route::post('/razorpay/webhook', [RazorpayWebhookController::class, 'handle'])->name('razorpay.webhook');

// Google OAuth (public students)
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');
Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['student'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/dashboard/invoice/{purchase}', [UserDashboardController::class, 'invoice'])->name('user.invoice');
    Route::get('/dashboard/enrollment/{enrollment}', [UserDashboardController::class, 'enrollmentReceipt'])->name('user.enrollment.receipt');

    Route::post('/courses/{id}/enroll', [EnrollmentController::class, 'store'])->name('courses.enroll');
    Route::get('/my-enrollments', fn () => redirect(route('user.dashboard').'#tab-enrollments'))->name('my.enrollments');
    Route::get('/my-books', fn () => redirect(route('user.dashboard').'#tab-books'))->name('books.my');

    // Books — purchase & full read
    Route::get('/books/{book}/checkout', [BookPaymentController::class, 'checkout'])->name('books.checkout');
    Route::post('/books/{book}/payment/verify', [BookPaymentController::class, 'verify'])->name('books.payment.verify');
    Route::post('/books/{book}/payment/simulated', [BookPaymentController::class, 'completeSimulated'])->name('books.payment.simulated');
    Route::get('/books/{book}/read', [BookController::class, 'readFull'])->name('books.read.full');
    Route::get('/books/{book}/stream/full', [BookController::class, 'streamFull'])->name('books.stream.full');
});

// Admin authentication
Route::get('/admin/login', [AdminController::class, 'loginView'])->name('login');
Route::post('/admin/signin', [AdminController::class, 'adminLogin']);
Route::get('/admin/register', [AdminController::class, 'registerView'])->name('register');
Route::post('/admin/signup', [AdminController::class, 'adminsRegister']);

Route::get('/admin/logout', [AdminController::class, 'adminsLogout'])->name('logout');

Route::group(['prefix' => '/admin', 'middleware' => ['IsAdmin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/blog-categories', [AdminController::class, 'blogCatView'])->name('adminblogsCategory');
    Route::post('/add-blog-categories', [AdminController::class, 'addBlogCat']);
    Route::get('/blogs', [AdminController::class, 'blogView'])->name('adminblogs');
    Route::get('/alter-blogs/{id}', [AdminController::class, 'blogForm']);
    Route::post('/alter-blogs/{id}', [AdminController::class, 'postBlog']);
    Route::get('/update-status/{id}', [AdminController::class, 'updateBlogStatus']);
    Route::get('/users', [AdminController::class, 'userList'])->name('admin.users');
    Route::get('/enrollments', [AdminController::class, 'enrollmentList'])->name('enrollments');
    Route::get('/enrollments/{enrollment}/receipt', [AdminController::class, 'enrollmentReceipt'])->name('admin.enrollments.receipt');
    Route::get('/messages', [AdminController::class, 'messageList'])->name('messages');

    Route::get('/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses', [AdminCourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('admin.courses.update');
    Route::post('/courses/{course}/toggle', [AdminCourseController::class, 'toggleStatus'])->name('admin.courses.toggle');
    Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('admin.courses.destroy');

    Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books.index');
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('admin.books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('admin.books.store');
    Route::get('/books/{book}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit');
    Route::put('/books/{book}', [AdminBookController::class, 'update'])->name('admin.books.update');
    Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/book-purchases', [AdminBookController::class, 'purchases'])->name('admin.books.purchases');
    Route::get('/book-purchases/{purchase}/invoice', [AdminBookController::class, 'purchaseInvoice'])->name('admin.books.invoice');
});

Route::get('/myfile/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');
