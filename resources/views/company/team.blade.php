@extends('layouts.main')

@section('title', 'Our Team')
@section('description', 'Meet the experts behind GSM Trading Lab. Our team of analysts, traders, and educators.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Meet Our Team</h1>
            <p class="page-breadcrumb">Home / Company / Team</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div class="features-grid">
                @forelse($members as $member)
                    <div class="feature-card" style="text-align: center;">
                        @if($member->image_url)
                            <img src="{{ asset($member->image_url) }}" alt="{{ $member->name }}"
                                style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 1.5rem; border: 3px solid var(--primary);">
                        @else
                            <div
                                style="width: 150px; height: 150px; border-radius: 50%; background: var(--dark-light); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; font-size: 3rem; color: var(--gray);">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                        @endif
                        <h3 style="margin-bottom: 0.5rem;">{{ $member->name }}</h3>
                        <p style="color: var(--primary); font-weight: bold; margin-bottom: 1rem;">{{ $member->role }}</p>
                        @if($member->bio)
                            <p style="font-size: 0.9rem; color: var(--gray-light); margin-bottom: 1.5rem;">{{ $member->bio }}</p>
                        @endif

                        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                            @if($member->facebook_url)
                                <a href="{{ $member->facebook_url }}" target="_blank"
                                    style="color: var(--white); text-decoration: none; font-size: 1.2rem;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if($member->instagram_url)
                                <a href="{{ $member->instagram_url }}" target="_blank"
                                    style="color: var(--white); text-decoration: none; font-size: 1.2rem;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if($member->threads_url)
                                <a href="{{ $member->threads_url }}" target="_blank"
                                    style="color: var(--white); text-decoration: none; font-size: 1.2rem;">
                                    <i class="fab fa-threads"></i>
                                </a>
                            @endif
                            @if($member->twitter_url)
                                <a href="{{ $member->twitter_url }}" target="_blank"
                                    style="color: var(--white); text-decoration: none; font-size: 1.2rem;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if($member->linkedin_url)
                                <a href="{{ $member->linkedin_url }}" target="_blank"
                                    style="color: var(--white); text-decoration: none; font-size: 1.2rem;">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif
                            @if($member->youtube_url)
                                <a href="{{ $member->youtube_url }}" target="_blank"
                                    style="color: var(--white); text-decoration: none; font-size: 1.2rem;">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif
                            @if($member->tiktok_url)
                                <a href="{{ $member->tiktok_url }}" target="_blank"
                                    style="color: var(--white); text-decoration: none; font-size: 1.2rem;">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="card" style="grid-column: 1 / -1; text-align: center;">
                        <p>Our team is growing! Stay tuned to meet the experts.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection