@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/pages/showPost.css') }}">

@section('content')
    <div class="single-post-container">
        <div class="single-post-card">
            <a href="{{ url('/') }}" class="back-btn">← Back to all posts</a>
            <div class="single-post-image">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image">
                @else
                    <div class="image-placeholder">No Image</div>
                @endif
            </div>
            <div class="single-post-content">
                <h1 class="single-post-title">{{ $post->title }}</h1>
                <div class="single-post-meta">
                    <span class="author">Posted by: {{ $post->user->name }}</span>
                    <span class="date">Date: {{ $post->created_at->format('j F, Y') }}</span>
                </div>
                <div class="single-post-text">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <!--- Comment --->
                
                <h3 style="font-weight: bold; margin-bottom: 20px;">Comments</h3>
                <div style="margin-bottom: 40px;">
                    @foreach($post->comments as $comment)
                        <div style="border-bottom: 1px solid #ddd; padding: 15px 0;">
                            <div style="font-weight: bold; font-size: 14px;">{{ $comment->user->name }}</div>
                            <div style="font-size: 12px; color: #777;">{{ $comment->created_at->format('d M, Y') }}</div>
                            <p style="margin-top: 8px; font-size: 14px; color: #444;">{{ $comment->comment }}</p>

                            <form action="{{ route('comments.like', $comment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; cursor: pointer; font-size: 14px;">
                                    ❤️ {{ $comment->likes->count() }}
                                </button>
                            </form>

                            @can('update', $comment)
                                <a href="{{ route('comments.edit', $comment) }}" style="margin-left: 10px;">Edit</a>
                            @endcan

                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">
                                        Delete
                                    </button>
                                </form>
                            @endcan

                        </div>
                    @endforeach
                </div>

                <hr style="margin: 40px 0;">

                <h4 style="font-weight: bold; margin-bottom: 10px;">Add comment</h4>

                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="comment" placeholder="Write your comment..." required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; resize: vertical; min-height: 80px;"></textarea>
                    <br><br>
                    <button type="submit"
                        style="background-color: black; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                        Post Comment
                    </button>
                </form>

                <!-- <h3>Comments</h3>
                @foreach($post->comments as $comment)
                <div>
                    <strong>{{ $comment->user->name }}:</strong> 
                    <p>{{ $comment->comment }}</p>  
                </div>
                @endforeach

                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="comment" placeholder="Write your comment..." required></textarea>
                    <button type="submit">Submit Comment</button>
                </form> -->

            </div>
        </div>
    </div>
@endsection
