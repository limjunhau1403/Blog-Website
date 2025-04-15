@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    <form method="GET" action="{{ route('admin.index') }}" class="mb-4">
        <div>
            <label>User:</label>
            <select name="user_id">
                <option value="">All</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Title contains:</label>
            <input type="text" name="title" value="{{ request('title') }}">
        </div>

        <div>
            <label>Only posts with comments?</label>
            <select name="has_comments">
                <option value="">Any</option>
                <option value="yes" {{ request('has_comments') == 'yes' ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Comments Count</th>
                <th>Posted On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->comments->count() }}</td>
                    <td>{{ $post->created_at->toFormattedDateString() }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection