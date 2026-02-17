@extends('layouts.admin')

@section('title', 'Modify Protocol - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Modify Protocol</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Editing position parameters: {{ $job->title }}</p>
        </div>
        <a href="{{ route('admin.content.careers.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Return to Matrix
        </a>
    </div>

    <div class="h-reveal" style="max-width: 900px; margin: 0 auto;">
        <form action="{{ route('admin.content.careers.update', $job->id) }}" method="POST">
            @csrf

            <div class="h-card">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">Position Designation</label>
                        <input type="text" name="title" class="h-input" required value="{{ old('title', $job->title) }}">
                    </div>
                    <div class="form-group">
                        <label class="h-label">Division / Department</label>
                        <input type="text" name="department" class="h-input" required
                            value="{{ old('department', $job->department) }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">Operation Base</label>
                        <input type="text" name="location" class="h-input" required
                            value="{{ old('location', $job->location) }}">
                    </div>
                    <div class="form-group">
                        <label class="h-label">Engagement Type</label>
                        <select name="type" class="h-input">
                            <option value="Full-time" {{ $job->type == 'Full-time' ? 'selected' : '' }}>Full-time Mission
                            </option>
                            <option value="Part-time" {{ $job->type == 'Part-time' ? 'selected' : '' }}>Part-time Mission
                            </option>
                            <option value="Contract" {{ $job->type == 'Contract' ? 'selected' : '' }}>Contractual</option>
                            <option value="Internship" {{ $job->type == 'Internship' ? 'selected' : '' }}>Training Program
                            </option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">Compensation (Optional)</label>
                        <input type="text" name="salary" class="h-input" placeholder="e.g. $50k - $70k"
                            value="{{ old('salary', $job->salary) }}">
                    </div>
                    <div class="form-group">
                        <label class="h-label">Clearance Level</label>
                        <select name="experience_level" class="h-input">
                            <option value="">Select Level...</option>
                            <option value="Entry Level" {{ $job->experience_level == 'Entry Level' ? 'selected' : '' }}>Entry
                                Level</option>
                            <option value="Mid Level" {{ $job->experience_level == 'Mid Level' ? 'selected' : '' }}>Mid Level
                            </option>
                            <option value="Senior Level" {{ $job->experience_level == 'Senior Level' ? 'selected' : '' }}>
                                Senior Level</option>
                            <option value="Executive" {{ $job->experience_level == 'Executive' ? 'selected' : '' }}>Executive
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="h-label">Mission Deadline</label>
                        <input type="date" name="deadline" class="h-input"
                            value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Mission Brief (Description)</label>
                    <textarea name="description" class="h-input" rows="6" required
                        style="font-family: 'JetBrains Mono'; line-height: 1.6;">{{ old('description', $job->description) }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Prerequisites (Optional)</label>
                    <textarea name="requirements" class="h-input" rows="6"
                        style="font-family: 'JetBrains Mono'; line-height: 1.6;">{{ old('requirements', $job->requirements) }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Incentives (Optional)</label>
                    <textarea name="benefits" class="h-input" rows="6"
                        style="font-family: 'JetBrains Mono'; line-height: 1.6;">{{ old('benefits', $job->benefits) }}</textarea>
                </div>

                <div
                    style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--h-border); padding-top: 1.5rem; margin-top: 2rem;">
                    <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" id="is_active" {{ $job->is_active ? 'checked' : '' }} style="width: 20px; height: 20px; accent-color: var(--h-primary);">
                        <div>
                            <div style="font-weight: 800; color: white;">ACTIVE PROTOCOL</div>
                            <div style="font-size: 0.75rem; color: #94A3B8;">Open for new applicants</div>
                        </div>
                    </label>

                    <button type="submit" class="btn-primary-h">
                        <i class="fas fa-save"></i> Update Protocol
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power4.out"
            });
        });
    </script>
@endsection