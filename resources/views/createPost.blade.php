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
            <input type="text" name="title" id="title" required>
        </div>
        
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Thumbnail:</label>
            <div class="file-input-container">
                <label class="file-input-label" for="image">
                    <span class="file-input-button">Choose File</span>
                    <span class="file-input-name">No file chosen</span>
                </label>
                <input type="file" name="image" id="image" required accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
            </div>
            <div class="image-preview" id="imagePreview">
                <img id="previewImage" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 200px; margin-top: 15px; border-radius: 4px;">
            </div>
        </div>
        
        <button type="submit">Post</button>
    </form>
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