@extends('layouts.admin')

@section('title', 'User Overlord - Terminal')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        :root {
            --h-bg: #020617;
            --h-card: rgba(15, 23, 42, 0.4);
            --h-border: rgba(255, 255, 255, 0.08);
            --h-primary: #6366F1;
            --h-secondary: #10B981;
            --h-accent: #EC4899;
            --font-h: 'Outfit', sans-serif;
        }

        .h-card {
            background: var(--h-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--h-border);
            border-radius: 28px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .h-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .h-table tr {
            background: rgba(255, 255, 255, 0.02);
            transition: 0.4s cubic-bezier(0.2, 1, 0.3, 1);
        }

        .h-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: scale(1.005);
        }

        .h-table td, .h-table th {
            padding: 1.5rem;
            text-align: left;
            vertical-align: middle;
        }

        .h-table th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #94A3B8;
            font-weight: 800;
        }

        .h-table td:first-child { border-radius: 20px 0 0 20px; }
        .h-table td:last-child { border-radius: 0 20px 20px 0; }

        .status-pill {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 14px;
            background: var(--h-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: white;
            border: 2px solid rgba(255,255,255,0.1);
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .h-reveal { opacity: 0; transform: translateY(20px); }

        .search-bar {
            background: rgba(0,0,0,0.2);
            border: 1px solid var(--h-border);
            border-radius: 16px;
            padding: 0.8rem 1.5rem;
            color: white;
            width: 300px;
            transition: 0.3s;
        }

        .search-bar:focus {
            outline: none;
            border-color: var(--h-primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
    </style>

    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">User Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing {{ $users->total() }} registered entities in the terminal</p>
        </div>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <form action="{{ route('admin.users.index') }}" method="GET">
                <input type="text" name="search" class="search-bar" placeholder="Scan by name or email..." value="{{ request('search') }}">
            </form>
            <a href="{{ route('admin.users.create') }}" class="action-btn" style="background: var(--h-primary); color: white; padding: 12px 24px; border-radius: 16px;">
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
                                    <div class="user-avatar" style="background: {{ $user->is_admin ? 'var(--h-accent)' : ($user->is_premium ? 'var(--h-secondary)' : 'var(--h-primary)') }}">
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
                                            <button type="submit" class="action-btn" style="background: rgba(16, 185, 129, 0.1); color: var(--h-secondary); border: 1px solid rgba(16, 185, 129, 0.2);">
                                                <i class="fas fa-user-secret"></i> Bypass
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn" style="background: rgba(99, 102, 241, 0.1); color: var(--h-primary); border: 1px solid rgba(99, 102, 241, 0.2);">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Execute Purge Sequence for this entity?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn" style="background: rgba(239, 68, 68, 0.1); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.2);">
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