@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/history.css') }}">

@section('content')
    <div class="container contact-container">
        <h1 class="mb-4">Viewing History</h1>

        @if (session('viewed_posts'))
            <ul class="list-group">
                @foreach (session('viewed_posts') as $post)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $post['title'] }}</strong><br>
                            <small>Visited at:{{ $post['visited_at'] }}</small>
                        </div>
                        <a href="{{ route('posts.show', $post['id']) }}" class="view-again-button">View Again</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No history available.</p>
        @endif
    </div>
@endsection
