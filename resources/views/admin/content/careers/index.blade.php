@extends('layouts.admin')

@section('title', 'Recruitment Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Recruitment Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing operative positions & applications.</p>
        </div>
    </div>

    <!-- Create New Job Form -->
    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-plus-circle" style="color: var(--h-primary);"></i> Initialize New Position
        </h3>
        <form action="{{ route('admin.content.careers.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label class="h-label">Position Designation</label>
                    <input type="text" name="title" class="h-input" required placeholder="e.g. Crypto Analyst">
                </div>
                <div class="form-group">
                    <label class="h-label">Division / Department</label>
                    <input type="text" name="department" class="h-input" required placeholder="e.g. Research Intelligence">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label class="h-label">Operation Base</label>
                    <input type="text" name="location" class="h-input" required placeholder="e.g. Remote / London HQ">
                </div>
                <div class="form-group">
                    <label class="h-label">Engagement Type</label>
                    <select name="type" class="h-input">
                        <option value="Full-time">Full-time Mission</option>
                        <option value="Part-time">Part-time Mission</option>
                        <option value="Contract">Contractual</option>
                        <option value="Internship">Training Program</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Mission Brief (Job Description)</label>
                <textarea name="description" class="h-input" rows="5" required
                    placeholder="Describe the role responsibilities and requirements..."
                    style="font-family: 'JetBrains Mono'; line-height: 1.6;"></textarea>
            </div>

            <div
                style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--h-border); padding-top: 1.5rem;">
                <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" checked id="is_active"
                        style="width: 20px; height: 20px; accent-color: var(--h-primary);">
                    <div>
                        <div style="font-weight: 800; color: white;">ACTIVATE RECRUITMENT</div>
                        <div style="font-size: 0.75rem; color: #94A3B8;">Immediately open for applications</div>
                    </div>
                </label>

                <button type="submit" class="btn-primary-h">
                    <i class="fas fa-paper-plane"></i> Deploy Position
                </button>
            </div>
        </form>
    </div>

    <!-- Active Listings Table -->
    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-list-ul" style="color: var(--h-secondary);"></i> Active Protocols
        </h3>
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Designation</th>
                        <th>Division</th>
                        <th>Base</th>
                        <th>Engagement</th>
                        <th>Status</th>
                        <th>Directives</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td style="color: white; font-weight: 800;">{{ $job->title }}</td>
                            <td>{{ $job->department }}</td>
                            <td>{{ $job->location }}</td>
                            <td>{{ $job->type }}</td>
                            <td>
                                @if($job->is_active)
                                    <span class="status-pill" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">
                                        <i class="fas fa-check-circle" style="margin-right:4px;"></i> ACTIVE
                                    </span>
                                @else
                                    <span class="status-pill" style="background: rgba(148, 163, 184, 0.1); color: #94A3B8;">
                                        <i class="fas fa-pause-circle" style="margin-right:4px;"></i> HALTED
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                    <a href="{{ route('admin.content.careers.applications', $job->id) }}" class="btn-primary-h"
                                        style="padding: 0.5rem 1rem; height: 32px; font-size: 0.75rem; background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                        <i class="fas fa-users" style="margin-right: 5px;"></i>
                                        {{ $job->applications()->count() }}
                                    </a>
                                    <a href="{{ route('admin.content.careers.edit', $job->id) }}" class="btn-primary-h"
                                        style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(255, 255, 255, 0.05); color: #94A3B8;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.content.careers.delete', $job->id) }}" method="POST"
                                        onsubmit="return confirm('Terminate this recruitment protocol?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-primary-h"
                                            style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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