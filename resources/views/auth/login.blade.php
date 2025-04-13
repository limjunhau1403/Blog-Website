@extends('layouts.auth')

@section('content')
    <!-- Header Section -->
    <div class="header-section">
        <h1>{{ __('Login') }}</h1>
        <a href="{{ route('register') }}" class="need-account">{{ __('Need an account') }}?</a>
    </div>

    @if (session('invalid-credentials'))
        <div id="alert-box"
            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background-color: #f44336; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            {{ session('invalid-credentials') }}
        </div>
        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('alert-box');
                if (alertBox) {
                    alertBox.style.display = 'none';
                }
            }, 2000);
        </script>
    @endif

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
