@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/contact.css') }}">

@section('content')

    <div class="container contact-container">
        <p class="contact-title">{{ __('Contact Us') }}</p>
        <p class="contact-subtitle">
            {{ __('If you have any questions, feel free to reach out to us by filling out the form below.') }}
        </p>

        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Name:') }}</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email:') }}</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="message">{{ __('Message:') }}</label>
                <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Send Message') }}</button>
        </form>
    </div>
@endsection
