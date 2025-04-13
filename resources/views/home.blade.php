@extends('layouts.app')

@section('content')
    @if (session('login-success'))
        <div id="alert-box"
            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #4CAF50; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            {{ session('login-success') }}
        </div>
        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('alert-box');
                if (alertBox) {
                    alertBox.style.display = 'none';
                }
            }, 2000);
        </script>
    @endif

    <div id="posts">
        {{-- @foreach ($posts as $post) --}}
        <div class="post">
            {{-- <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
                <p>Posted by: {{ $post->user->name }}</p>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <!-- <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button> --}}
            {{-- </form> --}}
        </div>
        {{-- @endforeach --}}
    </div>
@endsection
