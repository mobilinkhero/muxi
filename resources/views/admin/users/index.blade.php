@extends('layouts.admin')

@section('title', 'Manage Users')
@section('header', 'User Management')

@section('actions')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">Add New User</a>
@endsection

@section('content')
    <div class="card">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Info</th>
                        <th>Joined</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div style="font-size: 0.8rem; color: var(--gray);">Ph: {{ $user->phone ?? 'N/A' }}</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">WA: {{ $user->whatsapp ?? 'N/A' }}</div>
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span style="background: rgba(16, 185, 129, 0.2); color: #10B981; padding: 0.1rem 0.4rem; border-radius: 4px; font-size: 0.75rem; margin-right: 0.25rem;">Admin</span>
                                @endif
                                @if($user->is_premium)
                                    <span style="background: rgba(245, 158, 11, 0.2); color: #F59E0B; padding: 0.1rem 0.4rem; border-radius: 4px; font-size: 0.75rem;">Premium</span>
                                @elseif(!$user->is_admin)
                                     <span style="background: rgba(99, 102, 241, 0.2); color: var(--primary); padding: 0.1rem 0.4rem; border-radius: 4px; font-size: 0.75rem;">Student</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    @if(!$user->is_admin)
                                        <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST"
                                            onsubmit="return confirm('You will be logged out as Admin and logged in as this user. Continue?')">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm"
                                                style="color: #10B981; border-color: #10B981; padding: 0.25rem 0.5rem; font-size: 0.7rem;">Login As</button>
                                        </form>
                                    @endif
                                    
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm"
                                        style="color: var(--primary); border-color: var(--primary); padding: 0.25rem 0.5rem; font-size: 0.7rem;">Edit</a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary btn-sm"
                                                style="color: #ef4444; border-color: #ef4444; padding: 0.25rem 0.5rem; font-size: 0.7rem;">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 2rem;">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 1rem;">
            {{ $users->links() }}
        </div>
    </div>
@endsection