<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// For the about page
Route::get('/about', function () {
    return view('about', ['url' => 'about us']);
})->name('about');

// For the contact page
Route::get('/contact', function () {
    return view('contact', ['url' => 'contact us']);
})->name('contact');

// Home page (shows all posts)
// Route::get('/home', function () {
//     $posts = App\Models\Post::with('user')->latest()->get();
//     return view('home', ['posts' => $posts]);
// });//->middleware('auth');

// Post creation routes
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.createPost');//->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');//->middleware('auth');

// Edit/Update/Delete routes
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');//->middleware('auth');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');//->middleware('auth');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');//->middleware('auth');

//Authentication routes
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
// Route::get('/register/verify/{token}', [RegisterController::class, 'verify'])->name('register.verify');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.submit')->middleware('auth');

// Reset password routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Profile routes
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit')->middleware('auth');

// Admin 
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');