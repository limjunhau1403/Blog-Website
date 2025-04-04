<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    <a href="{{ route('posts.create') }}">Create Post</a>

    <div id="posts">
        @foreach ($posts as $post)
            <div>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
                <p>Posted by: {{ $post->user->name }}</p>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>