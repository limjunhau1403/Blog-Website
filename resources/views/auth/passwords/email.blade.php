@extends('layouts.auth')

@section('content')
    <!-- Header Section -->
    <div class="header-section">
        <h1>{{ __('Reset Password') }}</h1>
        <a href="{{ route('login') }}" class="need-account">{{ __('Back to Login') }}</a>
    </div>

    <!-- Alert Box -->
    <x-alertbox />

    <!-- Form Section -->
    <form class="form-section" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                required autofocus />

            @error('email')
                <span class="text-danger" style="color: #FFD11A">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="login-button">{{ __('Send Password Reset Link') }}</button>
    </form>
@endsection
