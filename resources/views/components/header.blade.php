<header class="header"> <!-- Added class for specificity -->
    <div class="logo-container">
        <x-logo :data="['width' => 50, 'height' => 50, 'fontSize' => '24px', 'viewBox' => '0 0 50 50']" />
    </div>
    <nav class="nav">
        <a href="/home">Home</a>
        <a href="/about">About</a>
        <a href="{{ route('posts.createPost') }}">Add Blog</a>
    </nav>
</header>
