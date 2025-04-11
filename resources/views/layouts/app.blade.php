<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | BlogSite</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">
    @stack('styles') <!-- For page-specific CSS -->
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>