@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/pages/editPost.css') }}">

@section('content')
    <div class="edit-post-container">
        <h1>Edit Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="form-group">
                <label>Current Image:</label>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current post image" class="current-image">
                @else
                    <p>No image uploaded</p>
                @endif
            </div>

            <div class="form-group">
                <label for="image">Change Image (optional):</label>
                <div class="file-input-container">
                    <label class="file-input-label" for="image">
                        <span class="file-input-button">Choose File</span>
                        <span class="file-input-name">No file chosen</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>
                <div class="image-preview" id="imagePreview">
                    <img id="previewImage" src="#" alt="Preview"
                        style="display: none; max-width: 100%; max-height: 200px; margin-top: 15px; border-radius: 4px;">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Update Post</button>
                <a href="/profile" class="btn btn-secondary">Cancel</a>
            </div>
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
