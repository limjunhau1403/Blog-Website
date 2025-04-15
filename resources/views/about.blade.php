@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/about.css') }}">

@section('content')
    <div class="about-hero">
        <div class="hero-content">
            <h1>About Our Blog</h1>
            <p class="hero-subtitle">Discover the story behind our platform and the team that makes it all possible</p>
        </div>
    </div>

    <div class="about-container">
        <section class="about-section our-story">
            <div class="section-content">
                <h2>Our Story</h2>
                <p>Founded in 2023, our blog began as a small passion project among friends who wanted to create a space for authentic storytelling. What started as a simple platform has grown into a vibrant community of writers, thinkers, and readers from around the world.</p>
                <p>We believe everyone has a story worth sharing, and we're committed to providing the tools and platform to make that possible.</p>
            </div>
            <div class="section-content">
                <h2>Our Mission</h2>
                <p>To empower individuals to share their unique perspectives and connect through the power of storytelling. We aim to:</p>
                <ul>
                    <li>Provide an accessible platform for writers of all levels</li>
                    <li>Foster meaningful discussions around important topics</li>
                    <li>Celebrate diverse voices and experiences</li>
                    <li>Maintain a respectful and inclusive community</li>
                </ul>
            </div>
        </section>

        <section class="values-section">
            <h2>Our Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">✍️</div>
                    <h3>Authenticity</h3>
                    <p>We champion genuine, original content that reflects true experiences.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌍</div>
                    <h3>Diversity</h3>
                    <p>We actively seek and celebrate diverse voices from all backgrounds.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">💡</div>
                    <h3>Innovation</h3>
                    <p>We continuously improve our platform to better serve our community.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Community</h3>
                    <p>We believe in the power of connection through shared stories.</p>
                </div>
            </div>
        </section>
    </div>
@endsection