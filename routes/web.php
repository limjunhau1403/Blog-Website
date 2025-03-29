<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

// Home page (protected by auth middleware)
Route::get('/home', function () {
    $posts = Post::with('user')->latest()->get();
    return view('home', ['posts' => $posts]);
})->middleware('auth'); // Uses session-based auth

// Post creation form (Blade)
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');

// Edit/Delete routes (Blade + form submissions)
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->middleware('auth');
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('auth');
