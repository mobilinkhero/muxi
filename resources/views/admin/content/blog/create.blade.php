@extends('layouts.admin')

@section('title', 'Create Blog Post')
@section('header', 'Create New Post')

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <form action="{{ route('admin.content.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Post Title</label>
                <input type="text" name="title" class="form-input" required placeholder="Enter post title..."
                    onkeyup="generateSlug(this.value)">
            </div>

            <div class="form-group">
                <label class="form-label">Slug (URL)</label>
                <input type="text" name="slug" id="slug" class="form-input" required placeholder="post-url-slug" readonly
                    style="background: rgba(0,0,0,0.2); color: var(--gray);">
            </div>

            <div class="form-group">
                <label class="form-label">Key Image</label>
                <input type="file" name="image" class="form-input" accept="image/*">
            </div>

            <div class="form-group">
                <label class="form-label">Content (HTML Supported)</label>
                <textarea name="content" class="form-input" rows="15" required
                    placeholder="Write your content here..."></textarea>
                <small style="color: var(--gray);">You can use basic HTML tags for formatting.</small>
            </div>

            <div class="form-check" style="margin-bottom: 2rem;">
                <input type="checkbox" name="is_published" value="1" id="is_published" checked>
                <label for="is_published" style="color: white; margin-left: 0.5rem;">Publish Immediately</label>
            </div>

            <div style="text-align: right;">
                <a href="{{ route('admin.content.blog.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </div>
        </form>
    </div>

    <script>
        function generateSlug(text) {
            const slug = text.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        }
    </script>
@endsection