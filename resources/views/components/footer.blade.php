<footer>
    <div class="footer-container">
        <!-- Top section with logo and navigation -->
        <div class="footer-top">
            <!-- Logo section -->
            <div class="logo-section">
                <!-- Logo icon -->
                <x-logo :data="['width' => 35, 'height' => 35, 'fontSize' => '16px', 'viewBox' => '0 0 50 50']" />
            </div>

            <!-- Navigation links -->
            <nav>
                <ul>
                    <li><a href="/">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('about') }}">{{ __('About us') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('Contact us') }}</a></li>
                </ul>
            </nav>
        </div>

        <!-- Bottom section with contact info -->
        <div class="footer-bottom">
            <div>{{ __('HighBlog') }}</div>
            <div>{{ __('highblog@highblog.com') }}&nbsp;&nbsp;{{ __('011 2134 5442') }}</div>
        </div>
    </div>
</footer>
