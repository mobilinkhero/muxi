@extends('layouts.admin')

@section('title', 'Trainee Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Trainee Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Performance analytics & progression data.</p>
        </div>
    </div>

    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-chart-pie" style="color: var(--h-primary);"></i> Learning Progress Analytics
        </h3>

        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Operative Identity</th>
                        <th>Sessions Engaged</th>
                        <th>Late Entries</th>
                        <th>Attendance Rating</th>
                        <th>Module Completion</th>
                        <th>Account Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $totalClasses = \App\Models\LiveClass::where('status', 'completed')->count() ?: 1; 
                        $totalVideos = \App\Models\ClassRecording::count() ?: 1;
                    @endphp
                    @forelse($students as $student)
                        @php
                            // Assuming relationships exist, otherwise we fallback to 0
                            $joined = $student->liveClassAttendance ? $student->liveClassAttendance->count() : 0;
                            $late = $student->liveClassAttendance ? $student->liveClassAttendance->where('status', 'late')->count() : 0;
                            
                            // Adjust calculation to avoid division by zero if $totalClasses is somehow 0 (handled above but good to be safe)
                            $attendanceRate = $totalClasses > 0 ? round(($joined / $totalClasses) * 100) : 0;
                            
                            // Mocking video progress if relationship doesn't exist or is empty for now
                            $videosWatched = $student->videoProgress ? $student->videoProgress->where('is_completed', true)->count() : 0;
                            $videoRate = $totalVideos > 0 ? round(($videosWatched / $totalVideos) * 100) : 0;
                        @endphp
                        <tr>
                            <td style="color: white; font-weight: 800;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 24px; height: 24px; background: rgba(236, 72, 153, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: var(--h-accent);">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div>
                                        {{ $student->name }}
                                        <div style="font-size: 0.75rem; color: #64748B; font-weight: 400; font-family: 'JetBrains Mono';">{{ $student->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-family: 'JetBrains Mono'; color: #E2E8F0;">
                                {{ $joined }} <span style="color: #64748B; font-size: 0.8rem;">/ {{ $totalClasses }}</span>
                            </td>
                            <td style="font-family: 'JetBrains Mono'; color: {{ $late > 0 ? '#EF4444' : '#64748B' }};">
                                {{ $late }}
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="flex: 1; height: 6px; background: rgba(255,255,255,0.05); border-radius: 4px; overflow: hidden;">
                                        <div style="width: {{ $attendanceRate }}%; height: 100%; background: {{ $attendanceRate > 70 ? '#10B981' : ($attendanceRate > 40 ? '#F59E0B' : '#EF4444') }}; box-shadow: 0 0 10px {{ $attendanceRate > 70 ? '#10B981' : ($attendanceRate > 40 ? '#F59E0B' : '#EF4444') }};"></div>
                                    </div>
                                    <span style="font-size: 0.75rem; color: {{ $attendanceRate > 70 ? '#10B981' : ($attendanceRate > 40 ? '#F59E0B' : '#EF4444') }}; font-family: 'JetBrains Mono'; width: 30px; text-align: right;">{{ $attendanceRate }}%</span>
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.75rem; color: #94A3B8; margin-bottom: 4px; font-family: 'JetBrains Mono';">
                                    {{ $videosWatched }} / {{ $totalVideos }} Protocols
                                </div>
                                <div style="height: 6px; background: rgba(255,255,255,0.05); border-radius: 4px; overflow: hidden;">
                                    <div style="width: {{ $videoRate }}%; height: 100%; background: var(--h-primary); box-shadow: 0 0 10px var(--h-primary);"></div>
                                </div>
                            </td>
                            <td>
                                <span class="status-pill" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">
                                    ACTIVE
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: #64748B;">
                                <i class="fas fa-users-slash" style="font-size: 2rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                No trainee data found in the matrix.
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
