@extends('layouts.admin')

@section('title', 'Security Tracking')
@section('header', 'User Security & Location Logs')

@section('content')
<div style="margin-bottom: 2rem;">
    <p style="color: var(--gray-light);">Yahan un users ki list hai jinka IP ya GPS data system ne record kiya hai.</p>
</div>

<div class="card">
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Last Known IP</th>
                    <th>Location Details</th>
                    <th>Last Activity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="font-weight: 600; color: var(--white);">{{ $user->name }}</div>
                            <div style="font-size: 0.75rem; color: var(--gray);">ID: #{{ $user->id }}</div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span style="font-family: monospace; color: #10B981; background: rgba(16, 185, 129, 0.1); padding: 0.2rem 0.5rem; border-radius: 4px;">
                                {{ $user->last_login_ip ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            @if($user->latitude && $user->longitude)
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <div style="font-size: 0.8rem; color: var(--gray-light);">
                                        📍 {{ $user->latitude }}, {{ $user->longitude }}
                                    </div>
                                    <a href="https://www.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}" 
                                       target="_blank" 
                                       style="color: #3b82f6; font-size: 0.8rem; text-decoration: underline;">
                                        Open in Google Maps
                                    </a>
                                </div>
                            @else
                                <span style="color: var(--gray); font-size: 0.8rem;">No GPS Signal</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 0.85rem;">{{ $user->updated_at->format('M d, Y') }}</div>
                            <div style="font-size: 0.75rem; color: var(--gray);">{{ $user->updated_at->format('h:i A') }}</div>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm" style="font-size: 0.7rem;">Profile</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 4rem;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">🛡️</div>
                            <p style="color: var(--gray);">Abhi tak kisi user ka tracking data record nahi hua.</p>
                            <p style="font-size: 0.8rem; color: var(--gray-light);">System automatically capture karega jab registered users dashboard visit karenge.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
        <div style="padding: 1rem;">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
