@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 32px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 style="color: #232536; font-weight: bold;">{{ __('Profile') }}</h1>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary"
                style="background-color: #FFD11A; color: #232536; font-weight: bold; text-decoration: none;"
                onmouseover="this.style.backgroundColor='#232536'; this.style.color='#FFFFFF';"
                onmouseout="this.style.backgroundColor='#FFD11A'; this.style.color='#232536';">
                {{ __('Edit') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title" style="color: #232536; font-weight: bold;">{{ __('User Information') }}</h5>
                <p><strong style="color: #232536; font-weight: bold;">{{ __('Name:') }}</strong>
                    {{ auth()->user()->name }}</p>
                <p><strong style="color: #232536; font-weight: bold;">{{ __('Email:') }}</strong>
                    {{ auth()->user()->email }}</p>
                <p><strong style="color: #232536; font-weight: bold;">{{ __('Type:') }}</strong>
                    {{ auth()->user()->is_admin ? __('Admin User') : __('Common User') }}
                </p>
            </div>
        </div>

        <h2 style="color: #232536; font-weight: bold;">{{ __('My Blogs') }}</h2>
        @if ($posts->isEmpty())
            <p>{{ __('No blogs posted yet.') }}</p>
        @else
            @foreach ($posts as $blog)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #232536; font-weight: bold;">{{ $blog->title }}</h5>
                        <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-link">Read More</a>
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Logout Button --}}
        <div class="card mb-4"
            style="margin: auto; text-align: center; height: 50px; width: 80%; background-color: #FFD11A; position:absolute; bottom: 10px;"
            onmouseover="this.style.backgroundColor='#232536'; this.querySelector('a').style.color='#FFFFFF';"
            onmouseout="this.style.backgroundColor='#FFD11A'; this.querySelector('a').style.color='#232536';">
            <a href="{{ route('logout.submit') }}"
                style="color: #232536; text-decoration: none; font-size: 24px; font-weight: bold;"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout.submit') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
@endsection
