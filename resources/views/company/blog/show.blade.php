@extends('layouts.main')

@section('title', $post->title)
@section('description', Str::limit(strip_tags($post->content), 160))

@section('content')
    <div
        style="position: relative; height: 60vh; min-height: 400px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
        @if($post->image_url)
            <div
                style="position: absolute; inset: 0; background-image: url('{{ $post->image_url }}'); background-size: cover; background-position: center;">
            </div>
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15,23,42,0.7), #0f172a);">
            </div>
        @else
            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%);"></div>
        @endif

        <div class="container" style="position: relative; z-index: 10; text-align: center; max-width: 800px;">
            <div style="margin-bottom: 1rem;">
                <span
                    style="background: rgba(16, 185, 129, 0.2); color: #10B981; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">
                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                </span>
            </div>
            <h1
                style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; line-height: 1.2; margin-bottom: 1.5rem; text-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                {{ $post->title }}
            </h1>
            <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                <div
                    style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                    G
                </div>
                <div style="text-align: left;">
                    <div style="font-weight: 600; color: white;">GSM Trading Team</div>
                    <div style="font-size: 0.875rem; color: var(--gray);">Market Analysis</div>
                </div>
            </div>
        </div>
    </div>

    <article class="content-section" style="padding-top: 4rem;">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <div class="blog-content" style="font-size: 1.125rem; line-height: 1.8; color: var(--gray-light);">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div
                style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <a href="{{ route('company.blog') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i> Back to Blog
                </a>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <span style="color: var(--gray);">Share:</span>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}"
                        target="_blank" style="color: white; font-size: 1.2rem; transition: color 0.2s;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
                        style="color: white; font-size: 1.2rem; transition: color 0.2s;">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                        target="_blank" style="color: white; font-size: 1.2rem; transition: color 0.2s;">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </article>
@endsection