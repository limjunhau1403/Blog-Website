<header class="header">
    <div class="logo-container">
        <x-logo :data="['width' => 50, 'height' => 50, 'fontSize' => '24px', 'viewBox' => '0 0 50 50']" />
    </div>
    <nav class="nav">
        {{-- Home --}}
        <a href="/">{{ __('Home') }}</a>

        {{-- About --}}
        <a href="/about">{{ __('About') }}</a>

        {{-- Add Blog --}}
        @if (Auth::check())
            <a href="{{ route('posts.createPost') }}">{{ __('Add Blog') }}</a>
        @endif

        {{-- Contact Us --}}
        <a href="{{ route('contact') }}">{{ __('Contact') }}</a>

        {{-- Admin Dashboard --}}
        @can('isAdmin')
            <a href="{{ route('admin.index') }}">{{ __('Admin') }}</a>
        @endcan

        {{-- Profile Icon --}}
        <a href="{{ Auth::check() ? route('profile.show') : route('login') }}">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 10.5C12 8.9087 12.6321 7.38258 13.7574 6.25736C14.8826 5.13214 16.4087 4.5 18 4.5C19.5913 4.5 21.1174 5.13214 22.2426 6.25736C23.3679 7.38258 24 8.9087 24 10.5C24 12.0913 23.3679 13.6174 22.2426 14.7426C21.1174 15.8679 19.5913 16.5 18 16.5C16.4087 16.5 14.8826 15.8679 13.7574 14.7426C12.6321 13.6174 12 12.0913 12 10.5ZM12 19.5C10.0109 19.5 8.10322 20.2902 6.6967 21.6967C5.29018 23.1032 4.5 25.0109 4.5 27C4.5 28.1935 4.97411 29.3381 5.81802 30.182C6.66193 31.0259 7.80653 31.5 9 31.5H27C28.1935 31.5 29.3381 31.0259 30.182 30.182C31.0259 29.3381 31.5 28.1935 31.5 27C31.5 25.0109 30.7098 23.1032 29.3033 21.6967C27.8968 20.2902 25.9891 19.5 24 19.5H12Z"
                    fill="white" />
            </svg>
        </a>

    </nav>
</header>
