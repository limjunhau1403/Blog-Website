<header class="header">  <!-- Added class for specificity -->
    <div class="logo">
        <a href="/">BlogSite</a>
    </div>
    <nav class="nav">
        <a href="/home">Home</a>
        <a href="/about">About</a>
        <a href="{{ route('posts.createPost') }}">Add Blog</a>
    </nav>
</header>