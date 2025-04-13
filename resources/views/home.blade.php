<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #posts {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .post {
            margin-bottom: 2rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    @include('components.header')

    <div id="posts">
        @foreach ($posts as $post)
            <div class="post">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
                <p>Posted by: {{ $post->user->name }}</p>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <!-- <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>-->
            </div>
        @endforeach
    </div>
</body>

</html>
