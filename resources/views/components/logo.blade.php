<link href="{{ asset('css/components/logo.css') }}" rel="stylesheet">
<a class="logo-container" href="{{ route('home') }}">
    <div class="logo">
        <svg width="{{ $width }}" height="{{ $height }}" viewBox="{{ $viewBox }}" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M33.3335 50V41.6667C37.9446 41.6667 41.6668 37.9445 41.6668 33.3334H50.0002C50.0002 42.5556 42.5279 50 33.3335 50Z"
                fill="#FFD11A" />
            <path
                d="M33.3334 50V41.6667C28.7223 41.6667 25.0001 37.9445 25.0001 33.3334H16.6667C16.6667 42.5556 24.139 50 33.3334 50Z"
                fill="#FFD11A" />
            <path
                d="M0 33.3333H8.33333C8.33333 37.9444 12.0556 41.6666 16.6667 41.6666V49.9999C7.47222 49.9999 0 42.5555 0 33.3333Z"
                fill="#FFD11A" />
            <path
                d="M0 33.3333H8.33333C8.33333 28.7222 12.0556 25 16.6667 25V16.6666C7.47222 16.6666 0 24.1388 0 33.3333Z"
                fill="#FFD11A" />
            <path
                d="M16.6667 0V8.33333C12.0556 8.33333 8.33333 12.0556 8.33333 16.6667H0C0 7.47222 7.47222 0 16.6667 0Z"
                fill="#FFD11A" />
            <path
                d="M16.6667 0V8.33333C21.2779 8.33333 25.0001 12.0556 25.0001 16.6667H33.3334C33.3334 7.47222 25.8612 0 16.6667 0Z"
                fill="#FFD11A" />
            <path
                d="M49.9999 16.6667H41.6666C41.6666 12.0556 37.9444 8.33333 33.3333 8.33333V0C42.5277 0 49.9999 7.47222 49.9999 16.6667Z"
                fill="#FFD11A" />
            <path
                d="M49.9999 16.6666H41.6666C41.6666 21.2777 37.9444 25 33.3333 25V33.3333C42.5277 33.3333 49.9999 25.8888 49.9999 16.6666Z"
                fill="#FFD11A" />
        </svg>
    </div>
    <span class="logo-text" style="font-size: {{ $fontSize }}">HighBlog</span>
</a>
