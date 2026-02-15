@extends('layouts.admin')

@section('title', 'Manage Careers')
@section('header', 'Careers Management')

@section('content')
    <div class="card">
        <h3 style="color: var(--white); margin-bottom: 1.5rem;">Post New Job</h3>
        <form action="{{ route('admin.content.careers.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Job Title</label>
                    <input type="text" name="title" class="form-input" required placeholder="Crypto Analyst">
                </div>
                <div class="form-group">
                    <label class="form-label">Department</label>
                    <input type="text" name="department" class="form-input" required placeholder="Research">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-input" required placeholder="Remote / London">
                </div>
                <div class="form-group">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-input">
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Job Description</label>
                <textarea name="description" class="form-input" rows="5" required
                    placeholder="Describe the role..."></textarea>
            </div>

            <div class="form-check" style="margin-bottom: 1rem;">
                <input type="checkbox" name="is_active" value="1" checked id="is_active">
                <label for="is_active" style="color: white; margin-left: 0.5rem;">Mark as Active</label>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">Post Job</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h3 style="color: var(--white); margin-bottom: 1rem;">Active Listings</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td style="color: white; font-weight: bold;">{{ $job->title }}</td>
                        <td>{{ $job->department }}</td>
                        <td>{{ $job->location }}</td>
                        <td>{{ $job->type }}</td>
                        <td>
                            @if($job->is_active)
                                <span style="color: #10B981;">Active</span>
                            @else
                                <span style="color: var(--gray);">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.content.careers.delete', $job->id) }}" method="POST"
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