@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/profile.css') }}">

@section('content')
    <x-alertbox />

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
            @foreach ($posts as $blog)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-link">{{ __('Read More') }}</a>
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
