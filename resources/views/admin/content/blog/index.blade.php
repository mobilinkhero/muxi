@extends('layouts.admin')

@section('title', 'Blog Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Blog Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing intelligence briefings & articles.</p>
        </div>
        <a href="{{ route('admin.content.blog.create') }}" class="btn-primary-h">
            <i class="fas fa-plus"></i> Initialize New Brief
        </a>
    </div>

    <div class="h-card h-reveal">
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Subject / Title</th>
                        <th>Operative (Author)</th>
                        <th>Clearance Status</th>
                        <th>Timestamp</th>
                        <th>Directives</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td style="font-weight: 800; color: white;">{{ $post->title }}</td>
                            <td style="color: #94A3B8; font-family: 'JetBrains Mono'; font-size: 0.85rem;">
                                <i class="fas fa-user-circle" style="margin-right: 5px;"></i>
                                {{ $post->author->name ?? 'SYSTEM_ADMIN' }}
                            </td>
                            <td>
                                @if($post->is_published)
                                    <span class="status-pill" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">
                                        <i class="fas fa-satellite-dish" style="margin-right:4px;"></i> BROADCASTING
                                    </span>
                                @else
                                    <span class="status-pill" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B;">
                                        <i class="fas fa-eraser" style="margin-right:4px;"></i> CLASSIFIED (DRAFT)
                                    </span>
                                @endif
                            </td>
                            <td style="color: #64748b; font-family: 'JetBrains Mono'; font-size: 0.8rem;">
                                {{ $post->published_at ? $post->published_at->format('Y-m-d H:i') : 'PENDING_RELEASE' }}
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('company.blog.show', $post->slug) }}" target="_blank"
                                        class="btn-primary-h"
                                        style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(255, 255, 255, 0.05); color: #94A3B8;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.content.blog.edit', $post->id) }}" class="btn-primary-h"
                                        style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.content.blog.delete', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Purge this intelligence record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-primary-h"
                                            style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power4.out"
            });
        });
    </script>
@endsection