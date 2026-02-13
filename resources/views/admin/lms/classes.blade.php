@extends('layouts.admin')

@section('title', 'Live Class Management')
@section('header', 'Schedule & Manage Live Sessions')

@section('actions')
    <button type="button" class="btn btn-primary btn-sm"
        onclick="document.getElementById('createClassModal').style.display='flex'">Schedule New Class</button>
@endsection

@section('content')
    <div class="card" style="border: 1px solid rgba(255,255,255,0.05); overflow: hidden;">
        <div class="card-header"
            style="background: rgba(255,255,255,0.02); padding: 1rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
            <h3 style="font-size: 1.1rem; margin: 0;">Active & Scheduled Classes</h3>
        </div>
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: rgba(0,0,0,0.2);">
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Title</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Date & Time</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Duration</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Status</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Attendees</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $class)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.03);">
                            <td style="padding: 1rem 1.5rem;">
                                <div style="font-weight: bold; color: var(--white);">{{ $class->title }}</div>
                                <div
                                    style="font-size: 0.8rem; color: var(--primary-light); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 200px;">
                                    {{ $class->meeting_link }}
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem; color: var(--gray-light);">
                                {{ $class->scheduled_at->format('M d, Y - h:i A') }}
                            </td>
                            <td style="padding: 1rem 1.5rem; color: var(--gray-light);">
                                {{ $class->duration_minutes }} mins
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                @php
                                    $statusColor = '#f59e0b'; // pending
                                    if ($class->status == 'live')
                                        $statusColor = '#ef4444';
                                    if ($class->status == 'completed')
                                        $statusColor = '#10b981';
                                @endphp
                                <span
                                    style="padding: 0.25rem 0.75rem; border-radius: 50px; background: {{ $statusColor }}20; color: {{ $statusColor }}; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">
                                    {{ $class->status }}
                                </span>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <a href="{{ route('admin.lms.attendance', $class->id) }}"
                                    style="color: var(--primary-light); text-decoration: none; font-weight: bold;">
                                    📊 View ({{ $class->attendees->count() }})
                                </a>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <form action="{{ route('admin.lms.classes.delete', $class->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1.2rem;">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 3rem; text-align: center; color: var(--gray);">
                                No classes scheduled yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Class Modal -->
    <div id="createClassModal"
        style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center; padding: 1rem;">
        <div class="card"
            style="width: 100%; max-width: 500px; padding: 2rem; border: 1px solid rgba(255,255,255,0.1); background: #1a1c23;">
            <h3 style="margin-bottom: 2rem;">Schedule Live Class</h3>
            <form action="{{ route('admin.lms.classes.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--gray);">Class Title</label>
                    <input type="text" name="title" required
                        style="width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--gray);">Meeting Link
                        (Zoom/Meet)</label>
                    <input type="url" name="meeting_link" required
                        style="width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;"
                        placeholder="https://zoom.us/j/...">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--gray);">Start Time</label>
                        <input type="datetime-local" name="scheduled_at" required
                            style="width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--gray);">Duration (Mins)</label>
                        <input type="number" name="duration_minutes" value="60" required
                            style="width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;">
                    </div>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">Save
                        Class</button>
                    <button type="button" class="btn btn-secondary" style="flex: 1; justify-content: center;"
                        onclick="document.getElementById('createClassModal').style.display='none'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection