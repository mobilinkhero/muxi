@extends('layouts.admin')

@section('title', 'Student Performance')
@section('header', 'Overall Student Stats')

@section('content')
    <div class="card" style="border: 1px solid rgba(255,255,255,0.05); overflow: hidden;">
        <div class="card-header" style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
            <h3 style="font-size: 1.1rem; margin: 0;">Learning Progress Analytics</h3>
        </div>
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: rgba(0,0,0,0.2);">
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Student</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Classes Joined</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Late Joins</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Attendance %</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Quizzes</th>
                        <th style="padding: 1rem 1.5rem; color: var(--gray);">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $totalClasses = \App\Models\LiveClass::where('status', 'completed')->count() ?: 1; 
                    @endphp
                    @forelse($students as $student)
                        @php
                            $joined = $student->liveClassAttendance->count();
                            $late = $student->liveClassAttendance->where('status', 'late')->count();
                            $attendanceRate = round(($joined / $totalClasses) * 100);
                        @endphp
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.03);">
                            <td style="padding: 1rem 1.5rem;">
                                <div style="font-weight: bold; color: var(--white);">{{ $student->name }}</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">{{ $student->email }}</div>
                            </td>
                            <td style="padding: 1rem 1.5rem; color: var(--white); font-weight: bold;">
                                {{ $joined }}
                            </td>
                            <td style="padding: 1rem 1.5rem; color: {{ $late > 0 ? '#ef4444' : 'var(--gray)' }};">
                                {{ $late }}
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="width: 100px; height: 8px; background: rgba(255,255,255,0.05); border-radius: 10px; overflow: hidden;">
                                    <div style="width: {{ $attendanceRate }}%; height: 100%; background: {{ $attendanceRate > 70 ? '#10b981' : ($attendanceRate > 40 ? '#f59e0b' : '#ef4444') }};"></div>
                                </div>
                                <span style="font-size: 0.75rem; color: var(--gray);">{{ $attendanceRate }}%</span>
                            </td>
                            <td style="padding: 1rem 1.5rem; color: var(--gray);">
                                0 Attempts
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <span style="padding: 0.25rem 0.5rem; border-radius: 4px; background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 0.7rem; font-weight: bold;">ACTIVE</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 3rem; text-align: center; color: var(--gray);">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
