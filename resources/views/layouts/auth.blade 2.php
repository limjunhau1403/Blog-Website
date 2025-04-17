<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ isset($url) ? ucwords($url) : '' }} | HighBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:700,600,400" rel="stylesheet">
    <link href="{{ asset('css/pages/auth.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="login-card">
            <!-- Alert Box -->
            <x-alertbox />

            <!-- Logo Section -->
            <div class="logo-section">
                <x-logo :data="['width' => 50, 'height' => 50, 'fontSize' => '24px', 'viewBox' => '0 0 50 50']" />
            </div>

            <!-- Content Section -->
            @yield('content')

        </div>
    </div>
</body>

</html>
