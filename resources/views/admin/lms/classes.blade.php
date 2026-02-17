@extends('layouts.admin')

@section('title', 'Live Ops - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Live Ops</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Schedule & broadcast live training sessions.</p>
        </div>
        <button type="button" class="btn-primary-h"
            onclick="document.getElementById('createClassModal').style.display='flex'">
            <i class="fas fa-plus-circle"></i> Initialize Session
        </button>
    </div>

    <!-- Active & Scheduled Classes -->
    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-satellite-dish" style="color: var(--h-accent);"></i> Active & Scheduled Transmissions
        </h3>
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Session Title</th>
                        <th>Schedule / Duration</th>
                        <th>Uplink Status</th>
                        <th>Participants</th>
                        <th>Directives</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $class)
                            <tr>
                                <td>
                                    <div style="font-weight: 800; color: white;">{{ $class->title }}</div>
                                    <div
                                        style="font-size: 0.75rem; color: #94A3B8; font-family: 'JetBrains Mono'; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 250px;">
                                        <i class="fas fa-link" style="margin-right: 5px;"></i> {{ $class->meeting_link }}
                                    </div>
                                </td>
                                <td>
                                    <div style="color: #E2E8F0;">{{ $class->scheduled_at->format('M d, H:i') }}</div>
                                    <div style="font-size: 0.75rem; color: #64748B;">{{ $class->duration_minutes }} min duration
                                    </div>
                                </td>
                                <td>
                        @php
                            $statusColor = '#F59E0B'; // pending
                            $statusIcon = 'fa-clock';
                            if ($class->status == 'live') {
                                $statusColor = '#EF4444';
                                $statusIcon = 'fa-broadcast-tower';
                            }
                            if ($class->status == 'completed') {
                                $statusColor = '#10B981';
                                $statusIcon = 'fa-check';
                            }
                        @endphp
                                    <span class="status-pill" style="background: {{ $statusColor }}20; color: {{ $statusColor }};">
                                        <i class="fas {{ $statusIcon }}" style="margin-right: 4px;"></i>
                                        {{ strtoupper($class->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.lms.attendance', $class->id) }}" class="btn-primary-h"
                                        style="padding: 0.4rem 0.8rem; font-size: 0.75rem; background: rgba(255,255,255,0.05); color: #94A3B8; height: auto;">
                                        <i class="fas fa-users" style="margin-right: 5px;"></i> {{ $class->attendees->count() }}
                                    </a>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 8px;">
                                        <a href="{{ $class->meeting_link }}" target="_blank" class="btn-primary-h"
                                            style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.lms.classes.delete', $class->id) }}" method="POST"
                                            onsubmit="return confirm('Abort this session?')">
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
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: #64748B;">
                                <i class="fas fa-calendar-times"
                                    style="font-size: 2rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                No sessions scheduled on the matrix.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Class Modal -->
    <div id="createClassModal"
        style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(5px); z-index: 9999; align-items: center; justify-content: center; padding: 1rem;">
        <div class="h-card"
            style="width: 100%; max-width: 500px; margin: 0; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h3 style="color: white; margin: 0; font-size: 1.25rem;">Initialize Session</h3>
                <button onclick="document.getElementById('createClassModal').style.display='none'"
                    style="background: none; border: none; color: #94A3B8; cursor: pointer; font-size: 1.25rem;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('admin.lms.classes.store') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <label class="h-label">Session Designation</label>
                    <input type="text" name="title" class="h-input" required
                        placeholder="e.g. Masterclass: Technical Analysis">
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Uplink Coordinates (URL)</label>
                    <input type="url" name="meeting_link" class="h-input" required placeholder="https://zoom.us/j/...">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="form-group">
                        <label class="h-label">T-Minus (Start Time)</label>
                        <input type="datetime-local" name="scheduled_at" class="h-input" required>
                    </div>
                    <div class="form-group">
                        <label class="h-label">Duration (Mins)</label>
                        <input type="number" name="duration_minutes" value="60" class="h-input" required>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <button type="button" class="btn-primary-h"
                        style="flex: 1; justify-content: center; background: rgba(255,255,255,0.05); color: #94A3B8; border-color: rgba(255,255,255,0.1);"
                        onclick="document.getElementById('createClassModal').style.display='none'">
                        Cancel protocol
                    </button>
                    <button type="submit" class="btn-primary-h" style="flex: 1; justify-content: center;">
                        <i class="fas fa-rocket"></i> Launch Schedule
                    </button>
                </div>
            </form>
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