@extends('layouts.auth')

@section('content')
    <!-- Header Section -->
    <div class="header-section">
        <h1>{{ __('Login') }}</h1>
        <a href="{{ route('register') }}" class="need-account">{{ __('Need an account') }}?</a>
    </div>

    <!-- Form Section -->
    <form id="loginForm" class="form-section" method="POST" action="{{ route('login.submit') }}">
        @csrf

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

        <div class="form-options">
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                <label for="remember">{{ __('Remember me') }}</label>
            </div>
            <a href="{{ route('password.request') }}" class="forgot-password">{{ __('Forgot Password') }}?</a>
        </div>

        <button type="submit" class="login-button">Login</button>
    </form>
@endsection
