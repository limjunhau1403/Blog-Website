@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ __('Edit Profile') }}</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control"
                    required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
