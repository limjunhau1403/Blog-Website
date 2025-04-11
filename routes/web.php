<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Controllers\PostController;

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

// For the about page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Home page (shows all posts)
Route::get('/home', function () {
    $posts = App\Models\Post::with('user')->latest()->get();
    return view('home', ['posts' => $posts]);
});//->middleware('auth');

// Post creation routes
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.createPost');//->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');//->middleware('auth');

// Edit/Update/Delete routes
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');//->middleware('auth');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');//->middleware('auth');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');//->middleware('auth');
