@extends('layouts.main')

@section('title', $post->title)
@section('description', Str::limit(strip_tags($post->content), 160))

@section('content')
    @php
        $imageUrl = $post->image_url ? asset($post->image_url) : 'https://placehold.co/1200x600?text=GSM+Trading';
    @endphp

    <div
        style="background-image: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.9)), url('{{ $imageUrl }}'); background-size: cover; background-position: center; height: 50vh; display: flex; align-items: center; justify-content: center; position: relative;">
        <div class="container" style="text-align: center; position: relative; z-index: 2;">
            <span
                style="background: var(--primary); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">
                {{ $post->published_at ? $post->published_at->format('F d, Y') : 'Draft' }}
            </span>
            <h1 style="font-size: 3rem; margin: 1rem 0; font-weight: 800; text-shadow: 0 4px 12px rgba(0,0,0,0.5);">
                {{ $post->title }}</h1>
            <p style="color: var(--gray-light); font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
                By <span style="color: white; font-weight: 600;">GSM Trading Team</span>
            </p>
        </div>
    </div>

    <article class="content-section">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <div class="blog-content" style="font-size: 1.15rem; line-height: 1.8; color: var(--gray-light);">
                {!! $post->content !!}
            </div>

            <div
                style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('company.blog') }}" class="btn btn-secondary">← Back to Blog</a>
                <div style="display: flex; gap: 1rem;">
                    <span style="color: var(--gray);">Share:</span>
                    <a href="#" style="color: white;">Twitter</a>
                    <a href="#" style="color: white;">Facebook</a>
                    <a href="#" style="color: white;">LinkedIn</a>
                </div>
            </div>
        </div>
    </article>
@endsection