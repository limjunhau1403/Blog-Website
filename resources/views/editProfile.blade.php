@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/editProfile.css') }}">

@section('content')
    <div class="container profile-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="profile-title">{{ __('Edit Profile') }}</h1>
        </div>

        <div class="card mb-4 profile-edit-form">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">{{ __('Name:') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="form-control" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">{{ __('Email:') }}</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="form-control" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
