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
            <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
                @forelse($posts as $post)
                    <div class="blog-card" style="background: var(--dark-light); border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); transition: transform 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                        <a href="{{ route('company.blog.show', $post->slug) }}" style="text-decoration: none; display: block;">
                            <div style="height: 220px; overflow: hidden; position: relative;">
                                @if($post->image_url)
                                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                @else
                                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-chart-line" style="font-size: 3rem; color: rgba(255,255,255,0.1);"></i>
                                    </div>
                                @endif
                                <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.7); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; backdrop-filter: blur(4px);">
                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                                </div>
                            </div>
                            <div style="padding: 1.5rem;">
                                <h3 style="margin: 0 0 0.75rem; font-size: 1.25rem; color: var(--white); line-height: 1.4;">
                                    {{ $post->title }}
                                </h3>
                                <p style="color: var(--gray); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <span style="color: var(--primary); font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                                    Read Article <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i>
                                </span>
                            </div>
                        </a>
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