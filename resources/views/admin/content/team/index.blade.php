@extends('layouts.admin')

@section('title', 'Manage Team')
@section('header', 'Team Management')

@section('content')
    <div class="card">
        <h3 style="color: var(--white); margin-bottom: 1.5rem;">Add Team Member</h3>
        <form action="{{ route('admin.content.team.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-input" required placeholder="John Doe">
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <input type="text" name="role" class="form-input" required placeholder="Senior Analyst">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Bio (Optional)</label>
                <textarea name="bio" class="form-input" rows="3" placeholder="Brief description..."></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Profile Image</label>
                    <input type="file" name="image" class="form-input" accept="image/*">
                </div>
                <div class="form-group">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-input" placeholder="https://linkedin.com/in/...">
                </div>
                <div class="form-group">
                    <label class="form-label">Twitter URL</label>
                    <input type="url" name="twitter_url" class="form-input" placeholder="https://twitter.com/...">
                </div>
            </div>

            <div style="text-align: right; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">Add Member</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h3 style="color: var(--white); margin-bottom: 1rem;">Current Team Members</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>
                            @if($member->image_url)
                                <img src="{{ asset($member->image_url) }}" alt="{{ $member->name }}"
                                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div
                                    style="width: 40px; height: 40px; border-radius: 50%; background: var(--dark-light); display: flex; align-items: center; justify-content: center; color: var(--gray);">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </td>
                        <td style="color: white; font-weight: bold;">{{ $member->name }}</td>
                        <td>{{ $member->role }}</td>
                        <td>
                            @if($member->is_active)
                                <span style="color: #10B981;">Active</span>
                            @else
                                <span style="color: var(--gray);">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.content.team.delete', $member->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm"
                                    style="background: #ef4444; color: white;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection