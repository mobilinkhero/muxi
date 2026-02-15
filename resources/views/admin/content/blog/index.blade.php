@extends('layouts.admin')

@section('title', 'Manage Blog')
@section('header', 'Blog Management')

@section('actions')
    <a href="{{ route('admin.content.blog.create') }}" class="btn btn-primary btn-sm">Create New Post</a>
@endsection

@section('content')
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Published Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name ?? 'Admin' }}</td>
                        <td>
                            @if($post->is_published)
                                <span class="badge badge-success"
                                    style="background: #10B981; padding: 2px 6px; border-radius: 4px; color: white;">Published</span>
                            @else
                                <span class="badge badge-warning"
                                    style="background: #F59E0B; padding: 2px 6px; border-radius: 4px; color: black;">Draft</span>
                            @endif
                        </td>
                        <td>{{ $post->published_at ? $post->published_at->format('M d, Y') : '-' }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('company.blog.show', $post->slug) }}" target="_blank"
                                    class="btn btn-sm btn-secondary">View</a>
                                <a href="{{ route('admin.content.blog.edit', $post->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.content.blog.delete', $post->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        style="background: #ef4444; color: white;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection