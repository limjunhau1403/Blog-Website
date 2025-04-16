<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function like(Comment $comment)
    {
        $like = $comment->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete(); // Unlike
        } else {
            $comment->likes()->create([
                'user_id' => auth()->id()
            ]);
        }

        return back();
    }

    // Store a new comment
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
        ]);

        Comment::create([
            'user_id' => Auth::id(), // Ensure the user is logged in
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    // Show a specific comment (optional, depends on your app)
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    // Edit a comment (only the owner can edit)
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

    // Update an existing comment
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment updated successfully!');
    }

    // Delete a comment
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
