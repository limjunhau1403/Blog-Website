<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($url) ? ucwords($url) : 'Home' }} | HighBlog</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/components/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/footer.css') }}" rel="stylesheet">
    @stack('styles') <!-- For page-specific CSS -->

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: auto;
        }

        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        @include('components.header')

        <!-- Alert Box -->
        <x-alertbox />

        <main class="main-content">
            @yield('content')
        </main>

        @include('components.footer')
    </div>
</body>

</html>
