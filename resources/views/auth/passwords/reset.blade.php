@extends('layouts.auth')

@section('content')
    <!-- Header Section -->
    <div class="header-section">
        <h1>{{ __('Reset Password') }}</h1>
        <a href="{{ route('login') }}" class="need-account">{{ __('Back to Login') }}</a>
    </div>

    <!-- Form Section -->
    <form class="form-section" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                placeholder="Enter your email" required autofocus />

            @error('email')
                <span class="text-danger" style="color: #FFD11A">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('New Password') }}</label>
            <input id="password" type="password" name="password" placeholder="Enter your new password" required />

            @error('password')
                <span class="text-danger" style="color: #FFD11A">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm your password"
                required />
        </div>

        <button type="submit" class="login-button">{{ __('Reset Password') }}</button>
    </form>
@endsection
