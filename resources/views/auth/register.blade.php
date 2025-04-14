@extends('layouts.auth')

@section('content')
    <!-- Header Section -->
    <div class="header-section">
        <h1>{{ __('Register') }}</h1>
        <a href="{{ route('login') }}" class="already-have-account">{{ __('Already have an account') }}?</a>
    </div>

    <!-- Form Section -->
    <form id="registrationForm" class="form-section" method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('Full Name') }}</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                placeholder="Enter your full name" required />
            @error('name')
                <span class="text-danger" style="color: #FFD11A">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email"
                required />
            @error('email')
                <span class="text-danger" style="color: #FFD11A">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" name="password" type="password" value="{{ old('password') }}"
                placeholder="Enter your password" required />
            @error('password')
                <span class="text-danger" style="color: #FFD11A">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" name="password_confirmation" type="password"
                value="{{ old('password_confirmation') }}" placeholder="Enter your confirm password" required />
            @error('password')
                <span class="text-danger" style="color: #FFD11A">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="create-account-button">Create Account</button>
    </form>
@endsection
