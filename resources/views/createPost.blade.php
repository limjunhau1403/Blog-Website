@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/pages/createPost.css') }}">

<head>
    <title>Create Blog</title>
</head>
@section('content')
    <div class="blog-container">
        <h1 class="blog-title">Create a New Blog</h1>

        <form class="blog-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Thumbnail:</label>
                <div class="file-input-container">
                    <label class="file-input-label" for="image">
                        <span class="file-input-button">Choose File</span>
                        <span class="file-input-name">No file chosen</span>
                    </label>
                    <input type="file" name="image" id="image" required
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                </div>
                <div class="image-preview" id="imagePreview">
                    @if (session('image_path'))
                        <img id="previewImage" src="{{ asset('storage/' . session('image_path')) }}" alt="Preview"
                            style="display: block; max-width: 100%; max-height: 200px; margin-top: 15px; border-radius: 4px;">
                    @else
                        <img id="previewImage" src="#" alt="Preview"
                            style="display: none; max-width: 100%; max-height: 200px; margin-top: 15px; border-radius: 4px;">
                    @endif
                </div>
            </div>
            <div class="button-group">
                <button type="submit" name="action" value="post">Post</button>
                <button type="submit" formaction="{{ route('posts.preview') }}" name="action"
                    value="preview">Preview</button>
            </div>
        </form>
        @if (session('preview_post'))
            <div class="preview-container" style="margin-top: 50px;">
                <h2>Preview</h2>
                <div class="preview-box" style="border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
                    <h3>{{ session('preview_post.title') }}</h3>
                    <div style="white-space: pre-wrap;">{{ session('preview_post.content') }}</div>
                    @if (session('preview_post.image'))
                        <img src="{{ asset('storage/' . session('preview_post.image')) }}" alt="Preview Image"
                            style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                    @endif
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');

            fileInput.addEventListener('change', function() {
                const preview = document.getElementById('previewImage');
                const fileNameDisplay = this.parentElement.querySelector('.file-input-name');

                if (this.files && this.files[0]) {
                    fileNameDisplay.textContent = this.files[0].name;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    fileNameDisplay.textContent = 'No file chosen';
                    preview.style.display = 'none';
                }
            });
        });
    </script>
@endsection
