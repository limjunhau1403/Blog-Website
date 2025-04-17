@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #ddd; border-radius: 8px; background-color: #fafafa; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <h2 style="text-align: center; font-weight: bold; margin-bottom: 25px;">Edit Your Comment</h2>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label for="comment" style="display: block; font-weight: bold; margin-bottom: 8px;">Comment</label>
            <textarea id="comment" name="comment" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; min-height: 100px;">{{ old('comment', $comment->comment) }}</textarea>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('posts.show', $comment->post_id) }}" style="text-decoration: none; color: #666;">⬅ Back to Post</a>

            <button type="submit" style="background-color: #111; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer;">
                Update Comment
            </button>
        </div>
    </form>
</div>
@endsection
