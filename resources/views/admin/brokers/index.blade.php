@extends('layouts.admin')

@section('title', 'Broker Nexus')

@section('content')
    <div class="h-reveal">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2 style="margin: 0; font-weight: 900; font-size: 2rem; letter-spacing: -1px; color: white;">Broker Nexus
                </h2>
                <p style="color: #94A3B8; margin-top: 5px;">Manage partner links and referral endpoints.</p>
            </div>
            <a href="{{ route('admin.brokers.create') }}" class="btn-primary-h">
                <i class="fas fa-link"></i> New Connection
            </a>
        </div>

        <div class="h-card">
            <div style="overflow-x: auto;">
                <table class="h-table">
                    <thead>
                        <tr>
                            <th>Partner Identity</th>
                            <th>Referral Endpoint</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brokers as $broker)
                            <tr>
                                <td style="display: flex; align-items: center; gap: 15px;">
                                    <div
                                        style="width: 50px; height: 50px; background: rgba(255,255,255,0.03); border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--h-border); overflow: hidden;">
                                        @if($broker->logo_path)
                                            <img src="{{ $broker->logo_path }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <i class="fas fa-building" style="color: var(--h-primary);"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 800; color: white; font-size: 1rem;">{{ $broker->name }}</div>
                                        <div style="font-size: 0.7rem; color: #64748b; font-family: 'JetBrains Mono';">NODE:
                                            {{ strtoupper(Str::slug($broker->name)) }}</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ $broker->referral_link }}" target="_blank"
                                        style="color: var(--h-primary); text-decoration: none; font-family: 'JetBrains Mono'; font-size: 0.85rem; border-bottom: 1px dashed rgba(99, 102, 241, 0.3);">
                                        {{ Str::limit($broker->referral_link, 40) }}
                                    </a>
                                </td>
                                <td>
                                    <span class="status-pill" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">
                                        ACTIVE
                                    </span>
                                </td>
                                <td>
                                    @if($broker->is_recommended)
                                        <span class="status-pill"
                                            style="background: rgba(245, 158, 11, 0.1); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.2);">
                                            <i class="fas fa-star" style="font-size: 0.7rem;"></i> TOP SELECTION
                                        </span>
                                    @else
                                        <span style="color: #475569; font-size: 0.75rem; font-weight: 700;">STANDARD</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <a href="{{ route('admin.brokers.edit', $broker->id) }}" class="btn-primary-h"
                                            style="padding: 8px 12px; font-size: 0.75rem; background: rgba(255, 255, 255, 0.05); color: white; border-color: var(--h-border);">
                                            <i class="fas fa-sliders"></i> Config
                                        </a>
                                        <form action="{{ route('admin.brokers.destroy', $broker->id) }}" method="POST"
                                            onsubmit="return confirm('Disconnect this node?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-primary-h"
                                                style="padding: 8px 12px; font-size: 0.75rem; background: rgba(239, 68, 68, 0.05); color: #EF4444; border-color: rgba(239, 68, 68, 0.1);">
                                                <i class="fas fa-unlink"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 5rem; color: #64748b;">
                                    <i class="fas fa-network-wired"
                                        style="font-size: 3rem; opacity: 0.2; margin-bottom: 1rem; display: block;"></i>
                                    No broker connections detected in the nexus.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power4.out"
            });
        });
    </script>
@endsection