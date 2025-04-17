<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // POSTS FILTERING
        $postQuery = Post::with(['user', 'comments.user']);
    
        if ($request->filled('user_id')) {
            $postQuery->where('user_id', $request->user_id);
        }
    
        if ($request->filled('title')) {
            $postQuery->where('title', 'like', '%' . $request->title . '%');
        }
    
        if ($request->has('has_comments') && $request->has_comments === 'yes') {
            $postQuery->has('comments');
        }
    
        $posts = $postQuery->latest()->paginate(5, ['*'], 'posts_page');
    
        // USERS FILTERING
        $userQuery = User::query();
    
        if ($request->filled('user_name')) {
            $userQuery->where('name', 'like', '%' . $request->user_name . '%');
        }
    
        if ($request->filled('user_email')) {
            $userQuery->where('email', 'like', '%' . $request->user_email . '%');
        }
    
        $users = $userQuery->paginate(5, ['*'], 'users_page');
    
        return view('admin', compact('posts', 'users'));
    }
}
