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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;

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

// Home page (shows all posts)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/', [HomeController::class, 'index'])->name('home');

// For the about page
Route::get('/about', function () {
    return view('about', ['url' => 'about us']);
})->name('about');

// For the contact page
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Single Posts in showPosts.blade.php
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('view_post'); 

// View Posts History
Route::get('/history', function () {
    return view('history', ['url' => 'posts history']);
})->name('history')->middleware('auth');

// Post creation routes
Route::get('/createPost', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::post('/posts/preview', [PostController::class, 'preview'])->name('posts.preview')->middleware('auth');


// Edit/Update/Delete routes
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

//Authentication routes
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.submit')->middleware('auth');

// Reset password routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');  //Get the form to request a password reset link
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');    //Send the password reset link to the user's email
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');  //Get the form to reset the password
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');                 //Reset the password

// Profile routes
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit/{id}', [UserController::class, 'showEditProfile'])->name('profile.edit')->middleware('auth');
Route::post('/profile/update/{id}', [UserController::class, 'update'])->name('profile.update')->middleware('auth');
Route::delete('/profile/delete/{id}', [UserController::class, 'destroy'])->name('profile.delete')->middleware('auth','admin');

// Admin 
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth','admin');

//Comment
Route::middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::resource('comments', CommentController::class);
    Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
});