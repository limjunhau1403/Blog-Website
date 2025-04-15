@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/pages/showPost.css') }}">

@section('content')
<div class="single-post-container">
    <div class="single-post-card">
        <div class="single-post-image">
            @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="Post image">
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
            <a href="{{ url('/') }}" class="back-btn">← Back to all posts</a>
        </div>
    </div>
</div>
@endsection