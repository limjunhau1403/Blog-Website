<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return response()->json($posts);
    }

    // PostController.php
    public function create()
    {
        return view('createPost'); // Ensure you have a Blade file at resources/views/posts/create.blade.php
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]); // Ensure resources/views/posts/edit.blade.php exists
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required',
        ]);

        $post = new Post([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'user_id' => Auth::id(),
        ]);

        $post->save();

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
        ]);

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}