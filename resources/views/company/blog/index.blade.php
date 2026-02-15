@extends('layouts.main')

@section('title', 'Blog')
@section('description', 'Latest news, market analysis, and trading insights from GSM Trading Lab.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">GSM Trading Insights</h1>
            <p class="page-breadcrumb">Home / Company / Blog</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div class="blog-grid"
                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                @forelse($posts as $post)
                    <div class="blog-card"
                        style="background: var(--dark-light); border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); transition: transform 0.2s;">
                        @if($post->image_url)
                            <img src="{{ asset($post->image_url) }}" alt="{{ $post->title }}"
                                style="width: 100%; height: 200px; object-fit: cover;">
                        @endif
                        <div style="padding: 1.5rem;">
                            <span
                                style="color: var(--primary); font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                            </span>
                            <h3 style="margin: 0.5rem 0 1rem; font-size: 1.25rem;">
                                <a href="{{ route('company.blog.show', $post->slug) }}"
                                    style="color: var(--white); text-decoration: none;">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p
                                style="color: var(--gray-light); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('company.blog.show', $post->slug) }}"
                                style="color: var(--primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                Read More →
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center;">
                        <p style="padding: 2rem; color: var(--gray);">No blog posts yet. Stay tuned!</p>
                    </div>
                @endforelse
            </div>

            <div style="margin-top: 3rem; display: flex; justify-content: center;">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection