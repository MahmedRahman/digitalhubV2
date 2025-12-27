<?php

use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    $content = \App\Helpers\ContentHelper::getHomepageContent();
    $editor_mode = request()->get('editor_mode', false);
    return view('home', ['content' => $content, 'editor_mode' => $editor_mode]);
})->name('home');

// Courses
Route::get('/courses', function () {
    $courses = \App\Helpers\ContentHelper::getCourses();
    // Ensure courses is always an array
    if (!is_array($courses)) {
        $courses = [];
    }
    // Filter only active courses
    $courses = array_filter($courses, function($course) {
        return isset($course['status']) && $course['status'] === 'active';
    });
    return view('courses.index', ['courses' => $courses]);
})->name('courses.index');

Route::get('/courses/{id}', function ($id) {
    $course = \App\Helpers\ContentHelper::getCourse($id);
    
    if (!$course) {
        abort(404, 'الدورة غير موجودة');
    }
    
    return view('courses.show', ['course' => $course]);
})->name('courses.show');

// Blog
Route::get('/blog', function () {
    $posts = \App\Helpers\ContentHelper::getBlogPosts();
    // Ensure posts is always an array
    if (!is_array($posts)) {
        $posts = [];
    }
    // Filter only published posts
    $posts = array_filter($posts, function($post) {
        return isset($post['status']) && $post['status'] === 'published';
    });
    return view('blog.index', ['posts' => $posts]);
})->name('blog.index');

Route::get('/blog/{id}', function ($id) {
    $post = \App\Helpers\ContentHelper::getBlogPost($id);
    
    if (!$post || ($post['status'] ?? '') !== 'published') {
        abort(404, 'المقال غير موجود');
    }
    
    return view('blog.show', ['post' => $post]);
})->name('blog.show');

// About
Route::get('/about', function () {
    $content = \App\Helpers\ContentHelper::getAboutContent();
    $editor_mode = request()->get('editor_mode', false);
    return view('about', ['content' => $content, 'editor_mode' => $editor_mode]);
})->name('about');

// Contact
Route::get('/contact', function () {
    $content = \App\Helpers\ContentHelper::getContactContent();
    $editor_mode = request()->get('editor_mode', false);
    return view('contact', ['content' => $content, 'editor_mode' => $editor_mode]);
})->name('contact');

// Legal
Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('legal.privacy');

Route::get('/terms', function () {
    return view('legal.terms');
})->name('legal.terms');

// Auth routes (placeholder - will be implemented later)
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

// Dashboard Routes
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');
    
    // Courses Management
    Route::resource('courses', App\Http\Controllers\CourseController::class);
    
    // Blog Management
    Route::resource('blog', App\Http\Controllers\BlogController::class);
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    
    // Homepage Content Editor
    Route::get('/homepage', [App\Http\Controllers\HomepageContentController::class, 'index'])->name('homepage.index');
    Route::post('/homepage/update', [App\Http\Controllers\HomepageContentController::class, 'update'])->name('homepage.update');
    
    // About Page Content Editor
    Route::get('/about', [App\Http\Controllers\AboutContentController::class, 'index'])->name('about.index');
    Route::post('/about/update', [App\Http\Controllers\AboutContentController::class, 'update'])->name('about.update');
    
    // Contact Page Content Editor
    Route::get('/contact', [App\Http\Controllers\ContactContentController::class, 'index'])->name('contact.index');
    Route::post('/contact/update', [App\Http\Controllers\ContactContentController::class, 'update'])->name('contact.update');
});

