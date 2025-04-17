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
        $query = Post::with(['user', 'comments.user']);

        // Filters
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('title') && $request->title != '') {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('has_comments') && $request->has_comments === 'yes') {
            $query->has('comments');
        }

        $posts = $query->latest()->paginate(5, ['*'], 'posts_page');
        $users = User::paginate(5, ['*'], 'users_page');

        return view('admin', compact('posts', 'users'));
    }
}
