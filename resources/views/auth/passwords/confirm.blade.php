@extends('layouts.auth')

@section('content')
    <!-- Header Section -->
    <div class="header-section">
        <h1>{{ __('Confirm Password') }}</h1>
        <p class="form-description">{{ __('Please confirm your password before continuing.') }}</p>
    </div>

    <!-- Alert Box -->
    <x-alertbox />

    <!-- Form Section -->
    <form class="form-section" method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" placeholder="Enter your password" required />
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="reset-password-button">{{ __('Confirm Password') }}</button>

        @if (Route::has('password.request'))
            <a class="already-have-account" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </form>
@endsection
