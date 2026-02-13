@extends('layouts.admin')

@section('title', 'Class Attendance')
@section('header', 'Attendance for: ' . $class->title)

@section('actions')
    <a href="{{ route('admin.lms.classes') }}" class="btn btn-secondary btn-sm">← Back to Classes</a>
@endsection

@section('content')
    <div class="card" style="border: 1px solid rgba(255,255,255,0.05); overflow: hidden;">
        <div class="card-header"
            style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Student Attendance Log</h3>
                    <p style="font-size: 0.85rem; color: var(--gray);">Total Joined: {{ $attendees->count() }}</p>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.85rem; color: var(--gray);">Scheduled:
                        {{ $class->scheduled_at->format('M d, h:i A') }}</div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: rgba(0,0,0,0.2);">
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Student Name</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Email</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Joined At</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendees as $attendee)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.03);">
                            <td style="padding: 1rem 1.5rem;">
                                <div style="font-weight: bold; color: var(--white);">{{ $attendee->user->name }}</div>
                            </td>
                            <td style="padding: 1rem 1.5rem; color: var(--gray-light);">
                                {{ $attendee->user->email }}
                            </td>
                            <td style="padding: 1rem 1.5rem; color: var(--gray-light);">
                                {{ $attendee->joined_at->format('h:i:s A') }}
                                <div style="font-size: 0.75rem; color: var(--gray);">
                                    {{ $attendee->created_at->diffForHumans($class->scheduled_at) }}</div>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                @php
                                    $statusColor = $attendee->status == 'on-time' ? '#10b981' : '#ef4444';
                                @endphp
                                <span
                                    style="padding: 0.25rem 0.75rem; border-radius: 50px; background: {{ $statusColor }}20; color: {{ $statusColor }}; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">
                                    {{ $attendee->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 3rem; text-align: center; color: var(--gray);">
                                No students have joined this class yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection