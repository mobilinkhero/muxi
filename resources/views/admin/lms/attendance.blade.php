@extends('layouts.admin')

@section('title', 'Attendance Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Attendance Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Access logs for session: {{ $class->title }}</p>
        </div>
        <a href="{{ route('admin.lms.classes') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Return to Classes
        </a>
    </div>

    <div class="h-card h-reveal">
        <div
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1.5rem;">
            <h3 style="color: white; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
                <i class="fas fa-user-clock" style="color: var(--h-primary);"></i> Total Present: {{ $attendees->count() }}
            </h3>
            <div style="text-align: right;">
                <div style="font-size: 0.75rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 1px;">Session
                    Scheduled</div>
                <div style="font-family: 'JetBrains Mono'; color: white; font-weight: 700;">
                    {{ $class->scheduled_at->format('Y-m-d H:i') }}</div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Student Identity</th>
                        <th>Contact / Email</th>
                        <th>Entry Timestamp</th>
                        <th>Punctuality Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendees as $attendee)
                        <tr>
                            <td style="color: white; font-weight: 800;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div
                                        style="width: 24px; height: 24px; background: rgba(99, 102, 241, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: var(--h-primary);">
                                        {{ substr($attendee->user->name, 0, 1) }}
                                    </div>
                                    {{ $attendee->user->name }}
                                </div>
                            </td>
                            <td>{{ $attendee->user->email }}</td>
                            <td>
                                <div style="font-family: 'JetBrains Mono'; color: #E2E8F0;">
                                    {{ $attendee->joined_at->format('H:i:s') }}</div>
                                <div style="font-size: 0.75rem; color: #64748B;">
                                    {{ $attendee->created_at->diffForHumans($class->scheduled_at) }}</div>
                            </td>
                            <td>
                                @php
                                    $isLate = $attendee->status !== 'on-time';
                                @endphp
                                <span class="status-pill"
                                    style="background: {{ $isLate ? 'rgba(239, 68, 68, 0.1)' : 'rgba(16, 185, 129, 0.1)' }}; color: {{ $isLate ? '#EF4444' : '#10B981' }};">
                                    <i class="fas {{ $isLate ? 'fa-exclamation-triangle' : 'fa-check-circle' }}"
                                        style="margin-right:4px;"></i>
                                    {{ strtoupper($attendee->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem; color: #64748B;">
                                <i class="fas fa-users-slash"
                                    style="font-size: 2rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                No attendance records found for this session.
                            </td>
                        </tr>
                    @endforelse
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