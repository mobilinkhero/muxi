@extends('layouts.admin')

@section('title', 'Consultation Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Consultation Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Incoming capital advisory requests.</p>
        </div>
    </div>

    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-handshake" style="color: var(--h-primary);"></i> Active Inquiries:
            {{ $consultations->total() }}
        </h3>

        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Client Identity</th>
                        <th>Contact / Email</th>
                        <th>Capital Range</th>
                        <th>Timestamp</th>
                        <th>Directives</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($consultations as $consultation)
                        <tr>
                            <td style="color: #64748b; font-family: 'JetBrains Mono';">#{{ $consultation->id }}</td>
                            <td style="color: white; font-weight: 800;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div
                                        style="width: 24px; height: 24px; background: rgba(16, 185, 129, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: #10B981;">
                                        {{ substr($consultation->name, 0, 1) }}
                                    </div>
                                    {{ $consultation->name }}
                                </div>
                            </td>
                            <td>{{ $consultation->email }}</td>
                            <td>
                                <span class="status-pill" style="background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                    {{ $consultation->capital }}
                                </span>
                            </td>
                            <td style="color: #64748b; font-family: 'JetBrains Mono'; font-size: 0.8rem;">
                                {{ $consultation->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td>
                                <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST"
                                    onsubmit="return confirm('Purge this consultation record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-primary-h"
                                        style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: #64748B;">
                                <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No consultation requests detected in the stream.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 1rem;">
            {{ $consultations->links() }}
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