@extends('layouts.admin')

@section('title', 'Sentinel Hub - Security Logs')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Sentinel Surveillance</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Cross-referencing hardware fingerprints and geolocation nodes</p>
        </div>
        <div class="security-status-badge">
            <div class="pulse-icon"></div>
            <span>LIVE_SCANNING_ACTIVE</span>
        </div>
    </div>

    <div class="h-card h-reveal" style="padding: 1rem;">
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Hardware Profile</th>
                        <th>Visual / Compute</th>
                        <th>Network Node (IP)</th>
                        <th>Geo-Coordinates</th>
                        <th>Activity Level</th>
                        <th>Protocol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div style="font-weight: 800; font-size: 1rem;">{{ $user->name }}</div>
                                <div style="font-size: 0.75rem; color: #94A3B8; font-family: 'JetBrains Mono';">UID:
                                    #{{ $user->id }}</div>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem; color: white; font-weight: 700;">
                                    {{ $user->device ?? 'NODE_UNDEFINED' }}</div>
                                <div style="font-size: 0.7rem; color: #10B981; font-family: 'JetBrains Mono'; margin-top: 4px;">
                                    {{ $user->device_model ?? 'UNSPECIFIED' }}</div>
                                <div style="font-size: 0.7rem; color: #64748B;">{{ $user->browser }} / {{ $user->os }}</div>
                            </td>
                            <td>
                                <div style="font-size: 0.75rem; color: #94A3B8;">Res: {{ $user->screen_resolution ?? 'N/A' }}
                                </div>
                                <div style="font-size: 0.75rem; color: #94A3B8; margin-top: 4px;">CPU:
                                    {{ $user->cpu_cores ?? '?' }} Cores</div>
                                <div style="font-size: 0.65rem; color: var(--h-primary); margin-top: 4px; max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                    title="{{ $user->gpu_info }}">
                                    GPU: {{ $user->gpu_info ?? 'N/A' }}
                                </div>
                            </td>
                            <td>
                                <div
                                    style="font-family: 'JetBrains Mono'; color: #10B981; background: rgba(16, 185, 129, 0.1); padding: 4px 10px; border-radius: 8px; font-size: 0.85rem; display: inline-block;">
                                    {{ $user->last_login_ip ?? '???.???.???.???' }}
                                </div>
                                <div style="font-size: 0.6rem; color: #475569; margin-top: 8px; font-family: 'JetBrains Mono';">
                                    FP: {{ Str::limit($user->browser_fingerprint, 20) ?? 'NO_HASH' }}</div>
                            </td>
                            <td>
                                @if($user->latitude && $user->longitude)
                                    <div style="font-size: 0.85rem; color: #F59E0B; font-weight: 800;">
                                        {{ $user->city ?? 'Unknown' }}, {{ $user->country ?? 'Global' }}</div>
                                    <a href="https://www.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}"
                                        target="_blank"
                                        style="color: var(--h-primary); font-size: 0.7rem; text-decoration: none; display: flex; align-items: center; gap: 4px; margin-top: 6px; font-weight: 700;">
                                        <i class="fas fa-crosshairs"></i> TRACK_POINT
                                    </a>
                                @else
                                    <span style="color: #475569; font-size: 0.75rem;">GPS_OFFLINE</span>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 900; color: #10B981;">{{ $user->visit_count }} <span
                                        style="font-size: 0.7rem; opacity: 0.6;">LOGS</span></div>
                                <div style="font-size: 0.7rem; color: #94A3B8; margin-top: 4px;">
                                    {{ $user->last_active_at ? $user->last_active_at->diffForHumans() : 'INF_TIME' }}</div>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary-h"
                                    style="padding: 0.5rem 1rem; font-size: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid var(--h-border);">
                                    ACCESS_PROFILE
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 5rem; color: #94A3B8;">SENTINEL_IDLE:
                                NO_DATA_STREAMS</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div style="padding: 1.5rem; border-top: 1px solid var(--h-border);">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <style>
        .security-status-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 10px 20px;
            border-radius: 50px;
            color: #10B981;
            font-size: 0.75rem;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .pulse-icon {
            width: 10px;
            height: 10px;
            background: #10B981;
            border-radius: 50%;
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.1,
                ease: "power4.out"
            });
        });
    </script>
@endsection