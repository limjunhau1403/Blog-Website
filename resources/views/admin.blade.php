<link rel="stylesheet" href="{{ asset('css/pages/admin.css') }}">
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    {{-- FILTER POSTS --}}
    <form method="GET" action="{{ route('admin.index') }}" class="mb-4">
        <h4>Filter Posts</h4>
        <div>
            <label>User:</label>
            <select name="user_id" class="form-control">
                <option value="">All</option>
                @foreach ($users as $userOption)
                    <option value="{{ $userOption->id }}" {{ request('user_id') == $userOption->id ? 'selected' : '' }}>
                        {{ $userOption->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Title contains:</label>
            <input type="text" name="title" value="{{ request('title') }}" class="form-control">
        </div>

        <div>
            <label>Only posts with comments?</label>
            <select name="has_comments" class="form-control">
                <option value="">Any</option>
                <option value="yes" {{ request('has_comments') == 'yes' ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Filter Posts</button>
    </form>

    {{-- POSTS TABLE --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Comments</th>
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
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this post?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No posts found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- POSTS PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->appends(request()->except('posts_page'))->links('pagination::bootstrap-4') }}
    </div>

    <hr class="my-5">

    {{-- FILTER USERS --}}
    <h2>User Management</h2>
    <form method="GET" action="{{ route('admin.index') }}" class="mb-4">
        <h4>Filter Users</h4>
        <div>
            <label>Name contains:</label>
            <input type="text" name="user_name" value="{{ request('user_name') }}" class="form-control">
        </div>

        <div>
            <label>Email contains:</label>
            <input type="text" name="user_email" value="{{ request('user_email') }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Filter Users</button>
    </form>

    {{-- USERS TABLE --}}
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                    <td>
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('profile.delete', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No users found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- USERS PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $users->appends(request()->except('users_page'))->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection