<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($url) ? ucwords($url) : 'Home' }} | HighBlog</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/components/header.css') }}" rel="stylesheet">
    @stack('styles') <!-- For page-specific CSS -->
</head>

<body>
    <main>
        @include('components.header')
        @yield('content')
    </main>
</body>

</html>
