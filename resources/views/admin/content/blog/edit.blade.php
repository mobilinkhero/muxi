@extends('layouts.admin')

@section('title', 'Edit Blog Post')
@section('header', 'Edit Blog Post')

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <h3 style="color: var(--white); margin-bottom: 1.5rem;">Edit: {{ $post->title }}</h3>
        <form action="{{ route('admin.content.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Post Title</label>
                <input type="text" name="title" class="form-input" required value="{{ old('title', $post->title) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Slug (URL)</label>
                <input type="text" name="slug" class="form-input" required value="{{ old('slug', $post->slug) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Key Image</label>
                <input type="file" name="image" class="form-input" accept="image/*">
                @if($post->image_url)
                    <div style="margin-top: 1rem;">
                        <img src="{{ asset($post->image_url) }}" style="max-width: 200px; border-radius: 8px;">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label">Content (HTML Supported)</label>
                <textarea name="content" class="form-input" rows="15"
                    required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="form-check" style="margin-bottom: 2rem;">
                <input type="checkbox" name="is_published" value="1" id="is_published" {{ $post->is_published ? 'checked' : '' }}>
                <label for="is_published" style="color: white; margin-left: 0.5rem;">Published</label>
            </div>

            <div style="text-align: right;">
                <a href="{{ route('admin.content.blog.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </div>
        </form>
    </div>
@endsection