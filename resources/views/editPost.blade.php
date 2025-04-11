<!-- resources/views/posts/create.blade.php -->
<form action="{{ route('posts.edit') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <button type="submit">Update</button>
</form>