@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/profile.css') }}">

@section('content')

    <div class="container profile-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="profile-title">{{ __('Profile') }}</h1>
            <div class="profile-edit-link">
                <a href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
            </div>

        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">{{ __('User Information') }}</h3>
                <p><strong class="user-information">{{ __('Name:') }}</strong> {{ auth()->user()->name }}</p>
                <p><strong class="user-information">{{ __('Email:') }}</strong> {{ auth()->user()->email }}</p>
                <p><strong class="user-information">{{ __('Type:') }}</strong>
                    {{ auth()->user()->is_admin ? __('Admin') : __('User') }}
                </p>
            </div>
        </div>

        <h2 class="section-title">{{ __('My Blogs') }}</h2>
        @if ($posts->isEmpty())
            <p>{{ __('No blogs posted yet.') }}</p>
        @else
            @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="post-content">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                            </div>
                            <div class="post-actions">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary mr-2">
                                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                        <i class="fas fa-trash"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-link">{{ __('Read More') }}</a>
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Logout Button --}}
        <div class="card logout-card">
            <a href="{{ route('logout.submit') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
@endsection
