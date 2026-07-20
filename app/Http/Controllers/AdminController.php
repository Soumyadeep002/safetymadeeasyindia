<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

use Exception;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\Message;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Course;
use App\Models\Book;
use App\Models\BookPurchase;

class AdminController extends Controller
{

    public function loginView()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }

    public function registerView()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect('admin/dashboard');
        }

        return view('admin.register');
    }

    public function adminLogin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => ['required',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()]
        ]);

        if (Auth::attempt($request->only(['email', 'password']), $request->remember)) {
            $user = User::where('email', $request['email'])->first();

            if (! $user->is_admin) {
                Auth::logout();
                return redirect()->back()->withErrors(['message' => 'This account is not authorized for admin access.']);
            }

            return redirect('admin/dashboard');
        }
        else {
            return redirect()->back()->withErrors(['message' => 'Invalid credentials.']);
        }
    }

    public function adminsRegister(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required','confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()
        ],
            'password_confirmation' => 'required'
        ]);

        if (User::where('email', $request['email'])->first()) {
            return redirect()->back()->withErrors(['message' => 'User exist with same email id']);
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'is_admin' => true,
        ]);

        return redirect('/admin/login');
    }

    public function adminsLogout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect("/admin/login");
    }

    public function dashboard(){
        $courseCount = Course::count();
        $blogCount = Blog::count();
        $enrolled = Enrollment::count();
        $messages = Message::count();
        $bookCount = Book::count();
        $bookSales = BookPurchase::where('status', 'paid')->count();
        return view('admin.dashboard', compact('courseCount', 'blogCount', 'enrolled', 'messages', 'bookCount', 'bookSales'));
    }


    public function blogCatView(){
        $cats = BlogCategory::all();
        return view('admin.blogCategories', compact('cats'));
    }

    public function addBlogCat(Request $request){
        $cat = new BlogCategory;
        $cat->id = rand(100000, 999999);
        $cat->category_title = $request['title'];
        $cat->save();
        return redirect('admin/blog-categories');
    }


    public function blogView(){
        $blogs = Blog::all();
        return view('admin.blog', compact('blogs'));
    }

    public function blogForm($id){
        $categories = BlogCategory::all();
        if ($id == 0) {
            $post_url = "/admin/alter-blogs/0";
            return view('admin.blogForm', compact("post_url", 'categories'));
        } else {
            $blog = Blog::where('id', $id)->first();
            $post_url = "/admin/alter-blogs/".$id;
            return view('admin.blogForm', compact("post_url", 'categories', 'blog'));
        }
    }

    public function postBlog(Request $request, $id){
        if ($id == 0) {

            $validator = Validator::make($request->all(), [
                'image1' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=306,height=260',
                'image2' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
                'image3' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
                'image4' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
                'image5' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $blog = new Blog;
            $id = rand(10000000, 99999999);
            $blog->id = $id;
            $blog->blog_title = $request['title'];
            $blog->author = $request['author'];
            $blog->category_id = $request['category'];
            $blog->date = "2025-02-05 16:49:32";
            $blog->blog_para_1 = $request['content'];

            if ($request->hasFile('image1')) {
                $file1 = $request->file('image1');
                $fileName1 = 'blog_image1_'.$id.'.'.$file1->getClientOriginalExtension(); // Unique name
                $filePath1 = $file1->storeAs('uploads/blog_images', $fileName1, 'public'); // Save in storage/app/public/uploads
                $blog->image1 = $filePath1;
            }
            if ($request->hasFile('image2')) {
                $file2 = $request->file('image2');
                $fileName2 = 'blog_image2_'.$id.'.'.$file2->getClientOriginalExtension(); // Unique name
                $filePath2 = $file2->storeAs('uploads/blog_images', $fileName2, 'public'); // Save in storage/app/public/uploads
                $blog->image2 = $filePath2;
            }
            if ($request->hasFile('image3')) {
                $file3 = $request->file('image3');
                $fileName3 = 'blog_image3_'.$id.'.'.$file3->getClientOriginalExtension(); // Unique name
                $filePath3 = $file3->storeAs('uploads/blog_images', $fileName3, 'public'); // Save in storage/app/public/uploads
                $blog->image3 = $filePath3;
            }
            if ($request->hasFile('image4')) {
                $file4 = $request->file('image4');
                $fileName4 = 'blog_image4_'.$id.'.'.$file4->getClientOriginalExtension(); // Unique name
                $filePath4 = $file4->storeAs('uploads/blog_images', $fileName4, 'public'); // Save in storage/app/public/uploads
                $blog->image4 = $filePath4;
            }
            if ($request->hasFile('image5')) {
                $file5 = $request->file('image5');
                $fileName5 = 'blog_image5_'.$id.'.'.$file5->getClientOriginalExtension(); // Unique name
                $filePath5 = $file5->storeAs('uploads/blog_images', $fileName5, 'public'); // Save in storage/app/public/uploads
                $blog->image5 = $filePath5;
            }

            $blog->save();

            return redirect()->back()->with('success', 'Blog uploaded successfully');
        } else {
            $blog = Blog::where('id', $id)->first();


            if ($blog) {

                $validator = Validator::make($request->all(), [
                    'image1' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=306,height=260',
                    'image2' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
                    'image3' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
                    'image4' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
                    'image5' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=1600,height=960',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $blog->blog_title = $request['title'];
                $blog->author = $request['author'];
                $blog->category_id = $request['category'];
                $blog->date = "2025-02-05 16:49:32";
                $blog->blog_para_1 = $request['content'];

                if ($request->hasFile('image1')) {
                    $file1 = $request->file('image1');
                    $fileName1 = 'blog_image1_'.$blog->id.'.'.$file1->getClientOriginalExtension(); // Unique name
                    $filePath1 = $file1->storeAs('uploads/blog_images', $fileName1, 'public'); // Save in storage/app/public/uploads
                    $blog->image1 = $filePath1;
                }
                if ($request->hasFile('image2')) {
                    $file2 = $request->file('image2');
                    $fileName2 = 'blog_image2_'.$blog->id.'.'.$file2->getClientOriginalExtension(); // Unique name
                    $filePath2 = $file2->storeAs('uploads/blog_images', $fileName2, 'public'); // Save in storage/app/public/uploads
                    $blog->image2 = $filePath2;
                }
                if ($request->hasFile('image3')) {
                    $file3 = $request->file('image3');
                    $fileName3 = 'blog_image3_'.$blog->id.'.'.$file3->getClientOriginalExtension(); // Unique name
                    $filePath3 = $file3->storeAs('uploads/blog_images', $fileName3, 'public'); // Save in storage/app/public/uploads
                    $blog->image3 = $filePath3;
                }
                if ($request->hasFile('image4')) {
                    $file4 = $request->file('image4');
                    $fileName4 = 'blog_image4_'.$blog->id.'.'.$file4->getClientOriginalExtension(); // Unique name
                    $filePath4 = $file4->storeAs('uploads/blog_images', $fileName4, 'public'); // Save in storage/app/public/uploads
                    $blog->image4 = $filePath4;
                }
                if ($request->hasFile('image5')) {
                    $file5 = $request->file('image5');
                    $fileName5 = 'blog_image5_'.$blog->id.'.'.$file5->getClientOriginalExtension(); // Unique name
                    $filePath5 = $file5->storeAs('uploads/blog_images', $fileName5, 'public'); // Save in storage/app/public/uploads
                    $blog->image5 = $filePath5;
                }

                $blog->save();

                return redirect('admin/blogs')->with('success', 'Blog updated successfully');

            } else {
                return redirect('admin/blogs');
            }
        }
    }

    public function updateBlogStatus($id){
        $blog = Blog::where('id', $id)->first();
        if ($blog->status == 'published') {
            $blog->status = 'archived';
            $blog->save();
        } else {
            $blog->status = 'published';
            $blog->save();
        }
        return redirect('admin/blogs');

    }

    public function userList()
    {
        $users = User::where('is_admin', false)
            ->withCount([
                'enrollments',
                'bookPurchases as paid_books_count' => function ($query) {
                    $query->where('status', 'paid');
                },
            ])
            ->orderByDesc('created_at')
            ->get();

        $totalUsers = $users->count();
        $googleUsers = $users->whereNotNull('google_id')->count();

        return view('admin.users', compact('users', 'totalUsers', 'googleUsers'));
    }

    public function enrollmentList(Request $request)
    {
        $courseFilter = $request->query('course_id');

        $enrollmentsQuery = Enrollment::with(['user', 'course'])->latest();

        if ($courseFilter) {
            $enrollmentsQuery->where('course_id', $courseFilter);
        }

        $enrollments = $enrollmentsQuery->get();
        $courses = Course::orderBy('course_title')->get(['id', 'course_title', 'course_type', 'subject']);

        $totalEnrollments = Enrollment::count();
        $coursesWithEnrollments = Enrollment::distinct('course_id')->count('course_id');

        return view('admin.enrollments', compact(
            'enrollments',
            'courses',
            'courseFilter',
            'totalEnrollments',
            'coursesWithEnrollments'
        ));
    }

    public function enrollmentReceipt(Enrollment $enrollment)
    {
        $enrollment->load(['course', 'user']);

        return view('user.enrollment-receipt', compact('enrollment'));
    }

    public function messageList(){
        $msgs = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('msgs'));
    }

    public function getMessages(Request $request){
        try {
            $request->validate([
                'name' => 'string|required',
                'email' => 'required|email',
                'message' => 'required'
            ]);
            if (!Message::where('email', $request['email'])->where('message', $request['message'])->first()) {
                $msg = new Message;
                $msg->id= rand(10000000, 99999999);
                $msg->name = $request['name'];
                $msg->email = $request['email'];
                $msg->message = $request['message'];

                $msg->save();

                return response()->json([
                    'success' => 201,
                    'message' => ' Your message successfully recieved. We will contact you shortly !',
                ], 201);

            } else {
                return response()->json([
                    'success' => 400,
                    'message' => 'Your message already recieved. We will contact you shortly !',
                ], 400);
            }
        } catch (\Exception $e) {
               // Handle general errors
               return response()->json([
                'error' => 'An unexpected error occurred.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
