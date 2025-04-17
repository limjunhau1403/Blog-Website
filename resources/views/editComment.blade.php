@extends('layouts.app')

@section('content')
    <h2>Edit Comment</h2>

    <form action="{{ route('comments.update', $comment) }}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="comment" rows="5" style="width: 100%;">{{ $comment->comment }}</textarea>
        <br><br>
        <button type="submit" style="background-color: black; color: white; padding: 10px 20px; border: none;">
            Update Comment
        </button>
    </form>
@endsection
