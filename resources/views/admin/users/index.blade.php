@extends('layouts.admin')

@section('title', 'User Overlord - Terminal')

@section('content')

    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">User Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing {{ $users->total() }} registered entities in the terminal</p>
        </div>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <form action="{{ route('admin.users.index') }}" method="GET">
                <input type="text" name="search" class="h-input" style="width: 300px;" placeholder="Scan by name or email..." value="{{ request('search') }}">
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn-primary-h" style="padding: 12px 24px; border-radius: 16px;">
                <i class="fas fa-user-plus"></i> New Entity
            </a>
        </div>
    </div>

    <div class="h-card h-reveal" style="padding: 1rem;">
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Identity</th>
                        <th>Contact Data</th>
                        <th>Security Profile</th>
                        <th>Status</th>
                        <th>Protocols</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div style="width: 45px; height: 45px; border-radius: 14px; background: {{ $user->is_admin ? 'var(--h-accent)' : ($user->is_premium ? 'var(--h-secondary)' : 'var(--h-primary)') }}; display: flex; align-items: center; justify-content: center; font-weight: 900; color: white; border: 2px solid rgba(255,255,255,0.1);">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 800; font-size: 1rem; color: white;">{{ $user->name }}</div>
                                        <div style="font-size: 0.75rem; color: #94A3B8; font-family: 'JetBrains Mono';">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem; color: #F8FAFC;">
                                    <i class="fas fa-phone-alt" style="width: 15px; opacity: 0.5;"></i> {{ $user->phone ?? 'NO_LOG' }}
                                </div>
                                <div style="font-size: 0.85rem; color: #10B981; margin-top: 4px;">
                                    <i class="fab fa-whatsapp" style="width: 15px; opacity: 0.8;"></i> {{ $user->whatsapp ?? 'NO_LOG' }}
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.75rem; color: #94A3B8; font-family: 'JetBrains Mono';">IP: {{ $user->last_login_ip ?? '???.???.???.???' }}</div>
                                @if($user->latitude && $user->longitude)
                                    <a href="https://www.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}" target="_blank" 
                                       style="font-size: 0.75rem; color: var(--h-primary); text-decoration: none; display: flex; align-items: center; gap: 4px; margin-top: 4px;">
                                        <i class="fas fa-map-marker-alt"></i> Geolocation Active
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px;">
                                    @if($user->is_admin)
                                        <span class="status-pill" style="background: rgba(236, 72, 153, 0.1); color: var(--h-accent);">ADMIN</span>
                                    @endif
                                    @if($user->is_premium)
                                        <span class="status-pill" style="background: rgba(16, 185, 129, 0.1); color: var(--h-secondary);">PREMIUM</span>
                                    @else
                                        <span class="status-pill" style="background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">STUDENT</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    @if(!$user->is_admin)
                                        <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST" target="_blank">
                                            @csrf
                                            <button type="submit" class="btn-primary-h" style="padding: 6px 12px; font-size: 0.7rem; background: rgba(16, 185, 129, 0.1); color: var(--h-secondary); border: 1px solid rgba(16, 185, 129, 0.2);">
                                                <i class="fas fa-user-secret"></i> Bypass
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-primary-h" style="padding: 6px 12px; font-size: 0.7rem; background: rgba(99, 102, 241, 0.1); color: var(--h-primary); border: 1px solid rgba(99, 102, 241, 0.2);">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Execute Purge Sequence for this entity?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-primary-h" style="padding: 6px 12px; font-size: 0.7rem; background: rgba(239, 68, 68, 0.1); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.2);">
                                                <i class="fas fa-trash-alt"></i> Purge
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 4rem; color: #94A3B8;">
                                <i class="fas fa-user-slash" style="font-size: 3rem; opacity: 0.2; margin-bottom: 1rem;"></i>
                                <p>No entity detected in this sector.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 1.5rem; border-top: 1px solid var(--h-border);">
            {{ $users->links() }}
        </div>
    </div>

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