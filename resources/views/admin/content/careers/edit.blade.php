@extends('layouts.admin')

@section('title', 'Edit Job Posting')
@section('header', 'Edit Job Posting')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h3 style="color: var(--white); margin-bottom: 1.5rem;">Edit: {{ $job->title }}</h3>
        <form action="{{ route('admin.content.careers.update', $job->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-input" required value="{{ old('title', $job->title) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-input" required
                    value="{{ old('department', $job->department) }}">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-input" required
                        value="{{ old('location', $job->location) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-input">
                        <option value="Full-time" {{ $job->type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ $job->type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ $job->type == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ $job->type == 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Salary (Optional)</label>
                    <input type="text" name="salary" class="form-input" placeholder="e.g. $50k - $70k"
                        value="{{ old('salary', $job->salary) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Experience Level</label>
                    <select name="experience_level" class="form-input">
                        <option value="">Select...</option>
                        <option value="Entry Level" {{ $job->experience_level == 'Entry Level' ? 'selected' : '' }}>Entry
                            Level</option>
                        <option value="Mid Level" {{ $job->experience_level == 'Mid Level' ? 'selected' : '' }}>Mid Level
                        </option>
                        <option value="Senior Level" {{ $job->experience_level == 'Senior Level' ? 'selected' : '' }}>Senior
                            Level</option>
                        <option value="Executive" {{ $job->experience_level == 'Executive' ? 'selected' : '' }}>Executive
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-input"
                        value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Job Description</label>
                <textarea name="description" class="form-input" rows="6"
                    required>{{ old('description', $job->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Requirements (Optional)</label>
                <textarea name="requirements" class="form-input" rows="6">{{ old('requirements', $job->requirements) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Benefits (Optional)</label>
                <textarea name="benefits" class="form-input" rows="6">{{ old('benefits', $job->benefits) }}</textarea>
            </div>

            <div class="form-check" style="margin-bottom: 1rem;">
                <input type="checkbox" name="is_active" value="1" id="is_active" {{ $job->is_active ? 'checked' : '' }}>
                <label for="is_active" style="color: white; margin-left: 0.5rem;">Active</label>
            </div>

            <div style="text-align: right; margin-top: 2rem;">
                <a href="{{ route('admin.content.careers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Job</button>
            </div>
        </form>
    </div>
@endsection