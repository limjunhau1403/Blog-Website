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
Route::get('/', function () {
    $posts = Post::with('user')->latest()->get();
    return view('home', compact('posts'));
})->name('home');

// For the about page
Route::get('/about', function () {
    return view('about', ['url' => 'about us']);
})->name('about');

// For the contact page
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Single Posts in showPosts.blade.php
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); 

// Post creation routes
Route::get('/createPost', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts/preview', [PostController::class, 'preview'])->name('posts.preview');


// Edit/Update/Delete routes
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

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
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');  //Get the form to request a password reset link
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');    //Send the password reset link to the user's email
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');  //Get the form to reset the password
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');                 //Reset the password

// Profile routes
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [UserController::class, 'showEditProfile'])->name('profile.edit')->middleware('auth');
Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update')->middleware('auth');

// Admin 
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth','admin');