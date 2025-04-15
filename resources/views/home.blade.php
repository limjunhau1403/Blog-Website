@extends('layouts.app')

@section('content')
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
