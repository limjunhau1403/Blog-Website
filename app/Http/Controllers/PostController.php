<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('home', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('showPost', compact('post'));
    }

    public function create()
    {
        return view('createPost'); 
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('editPost', ['post' => $post]); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|max:2048', 
        ]);
    
        // Get file and ensure proper handling
        $file = $request->file('image');
        $extension = strtolower($file->getClientOriginalExtension());
        
        // Normalize jpg to jpeg
        if ($extension === 'jpg') {
            $extension = 'jpeg';
        }
    
        $imagePath = $file->storeAs(
            'post_images',
            'post_'.time().'.'.$extension,
            'public'
        );
    
        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);
    
        return redirect('/')->with('success', 'Post created successfully!');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
    
        // Authorization check - ensure user owns the post
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    
        try {
            // Handle image upload if new image is provided
            if ($request->hasFile('image')) {
                // Get file and normalize extension
                $file = $request->file('image');
                $extension = strtolower($file->getClientOriginalExtension());
                
                // Normalize jpg to jpeg for consistency
                if ($extension === 'jpg') {
                    $extension = 'jpeg';
                }
    
                // Delete old image if exists
                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }
    
                // Store new image with normalized extension
                $validated['image'] = $file->storeAs(
                    'post_images',
                    'post_'.time().'.'.$extension,
                    'public'
                );
            } else {
                // Keep existing image if no new one uploaded
                $validated['image'] = $post->image;
            }
    
            $post->update($validated);
    
            return redirect('/profile')->with('success', 'Post updated successfully!');
    
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Post update failed: " . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Failed to update post. Please try again.');
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
    
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
    
        $post->delete();
    
        return redirect('/profile')->with('success', 'Post deleted successfully');
    }
}