<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Your logic for displaying posts
        $query = Post::with('user')->latest();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $posts = $query->get();
        return view('home', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('showPost', compact('post'));
    }

    public function create(Request $request)
    {
        $tempImagePath = public_path('storage/temp_images');
    
        if (!session()->pull('just_previewed')) {
            if (File::exists($tempImagePath)) {
                File::cleanDirectory($tempImagePath);
            }
    
            session()->forget('preview_post');
        }
    
        return view('createPost');
    }
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('editPost', ['post' => $post]); 
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'required|image|max:2048', 
            ]);
    
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
    
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

            if (session()->has('preview_post.image')) {
                Storage::disk('public')->delete(session('preview_post.image'));
                session()->forget('preview_post');
            }
    
            return redirect('/')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            
            if (session()->has('preview_post.image')) {
                Storage::disk('public')->delete(session('preview_post.image'));
                session()->forget('preview_post');
            }

            return redirect()->back()->with('error', 'Something went wrong while creating the post. Please try again.');
        }
    }
    

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Authorization check using Gate
        if (!Gate::allows('canModifyPost', $post)) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = strtolower($file->getClientOriginalExtension());

                if ($extension === 'jpg') {
                    $extension = 'jpeg';
                }

                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }

                $validated['image'] = $file->storeAs(
                    'post_images',
                    'post_' . time() . '.' . $extension,
                    'public'
                );
            } else {
                $validated['image'] = $post->image;
            }

            $post->update($validated);

            return redirect('/profile')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            \Log::error("Post update failed: " . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update post. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
    
            if (!Gate::allows('canDeletePost', $post)) {
                abort(403, 'Unauthorized');
            }
    
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
    
            $post->delete();
    
            return redirect('/profile')->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the post. Please try again.');
        }
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
    
            if ($extension === 'jpg') {
                $extension = 'jpeg';
            }
    
            $imagePath = $file->storeAs(
                'temp_images',
                'preview_' . time() . '.' . $extension,
                'public'
            );
        }
    
        // Save preview post + flag to prevent deletion
        session([
            'preview_post' => [
                'title' => $validated['title'],
                'content' => $validated['content'],
                'image' => $imagePath
            ],
            'just_previewed' => true
        ]);
    
        return redirect()->route('posts.create');
    }    
}