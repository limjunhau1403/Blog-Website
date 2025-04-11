@extends('layouts.app')
<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
</head>
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">
@endsection
<body>
    @include('components.header')
    
    <div class="about-hero">
        <h1>About Our Blog</h1>
        <p>This is a simple blog platform where users can share their thoughts and ideas.</p>
    </div>
</body>
</html>