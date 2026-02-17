@extends('layouts.admin')

@section('title', 'Applicant Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Applicant Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Candidate pool for position: {{ $job->title }}</p>
        </div>
        <a href="{{ route('admin.content.careers.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Return to Matrix
        </a>
    </div>

    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-users" style="color: var(--h-primary);"></i> Total Candidates:
            {{ $job->applications->count() }}
        </h3>

        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Candidate Identity</th>
                        <th>Contact / Email</th>
                        <th>Comms / Phone</th>
                        <th>Dossier (CV)</th>
                        <th>Statement</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($job->applications as $app)
                        <tr>
                            <td style="color: #64748b; font-family: 'JetBrains Mono'; font-size: 0.8rem;">
                                {{ $app->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td style="color: white; font-weight: 800;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div
                                        style="width: 24px; height: 24px; background: rgba(99, 102, 241, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: var(--h-primary);">
                                        {{ substr($app->name, 0, 1) }}
                                    </div>
                                    {{ $app->name }}
                                </div>
                            </td>
                            <td>{{ $app->email }}</td>
                            <td>{{ $app->phone ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ asset($app->cv_path) }}" target="_blank" class="btn-primary-h"
                                    style="padding: 0.3rem 0.8rem; font-size: 0.75rem; height: auto;">
                                    <i class="fas fa-file-alt" style="margin-right: 5px;"></i> View CV
                                </a>
                            </td>
                            <td>
                                @if($app->cover_letter)
                                    <button onclick="alert('{{ trim(preg_replace('/\s+/', ' ', $app->cover_letter)) }}')"
                                        class="btn-primary-h"
                                        style="padding: 0.3rem 0.8rem; font-size: 0.75rem; height: auto; background: rgba(255,255,255,0.05); color: #94A3B8;">
                                        <i class="fas fa-readme" style="margin-right: 5px;"></i> Inspect
                                    </button>
                                @else
                                    <span style="color: #64748B; font-size: 0.8rem;">NO STATEMENT</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: #64748B;">
                                <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No applications received for this protocol yet.
                            </td>
                        </tr>
                    @endforelse
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