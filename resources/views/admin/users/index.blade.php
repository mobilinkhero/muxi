@extends('layouts.admin')

@section('title', 'Manage Users')
@section('header', 'User Management')

@section('content')
    <div class="card">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
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
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge badge-success">Admin</span>
                                @else
                                    <span class="badge badge-secondary">Student</span>
                                @endif
                            </td>
                            <td>
                                @if(!$user->is_admin)
                                    <div style="display: flex; gap: 0.5rem;">
                                        <form action="{{ route('admin.users.impersonate', $user->id) }}" method="POST"
                                            onsubmit="return confirm('You will be logged out as Admin and logged in as this user. Continue?')">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm"
                                                style="color: #10B981; border-color: #10B981;">Login As</button>
                                        </form>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm"
                                            style="color: var(--primary); border-color: var(--primary);">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary btn-sm"
                                                style="color: #ef4444; border-color: #ef4444;">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem;">No users found.</td>
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