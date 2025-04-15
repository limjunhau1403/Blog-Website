@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@section('content')
    <div class="hero-container">
        <div class="hero-content">
            <h1>Welcome to Our Blog</h1>
            <p>Discover the latest posts and articles.</p>
            <p>High Blog includes all segments such as <strong>news, travelling, gaming, tutorials, community discussions, and many more!</strong></p>
            @if (Auth::check())
                <a href="{{ route('posts.create') }}" class="hero-btn">Create Blog</a>
            @else
                <a href="{{ route('login') }}" class="hero-btn">Create Blog</a>
            @endif
        </div>
        <div class="hero-image-container">
            <div class="image-stack">
                <div class="image-wrapper image-4">
                    <img src="{{ asset('images/hero/hero4.jpeg') }}" alt="Hero Image 4">
                </div>

                <div class="image-wrapper image-2">
                    <img src="{{ asset('images/hero/hero2.jpg') }}" alt="Hero Image 2">
                </div>

                <div class="image-wrapper image-3">
                    <img src="{{ asset('images/hero/hero3.jpg') }}" alt="Hero Image 3">
                </div>

                <div class="image-wrapper image-1">
                    <img src="{{ asset('images/hero/hero1.jpg') }}" alt="Hero Image 1">
                </div>
            </div>
        </div>
    </div>

    <div class="home-container">
        <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h1 style="margin: 0;">All Posts</h1>
            <form action="{{ route('posts.index') }}" method="GET" style="display: flex; gap: 8px; align-items: center;">
                <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}" style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc;">
                <button type="submit" style="padding: 6px 12px; border: none; background-color: #007bff; color: white; border-radius: 6px;">Search</button>
            </form>
        </div>

        <div class="posts-container">
            @forelse ($posts as $post)
                <div class="post-card">
                    <div class="post-image-container">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="post-image">
                        @else
                            <div class="image-placeholder">No Image</div>
                        @endif
                    </div>
                    <div class="post-content">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <div class="post-author">Posted by: {{ $post->user->name }}</div>
                        <p class="post-text">{{ Str::limit($post->content, 200) }}</p>
                        @if (Auth::check())
                            <a href="{{ route('posts.show', $post->id) }}" class="read-more-btn">Read full article...</a>
                        @else
                            <a href="{{ route('login') }}" class="read-more-btn">Read full article...</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="no-posts">
                    <p>No posts found. Please try again with a different search term!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection