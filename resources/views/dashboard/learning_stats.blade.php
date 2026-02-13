@extends('layouts.dashboard')

@section('title', 'My Learning Journey')

@section('content')
    <div style="padding: 2rem;">
        <header style="margin-bottom: 3rem;">
            <h1 style="font-size: 2.5rem; font-weight: 800; color: var(--white); margin-bottom: 0.5rem;">My Learning Journey
            </h1>
            <p style="color: var(--gray); font-size: 1.1rem;">Detailed insights into your attendance and performance.</p>
        </header>

        <!-- Stats Summary -->
        <div
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <div class="dashboard-card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📺</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: var(--white);">{{ $attendance->count() }}</div>
                <div style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase;">Classes Joined</div>
            </div>
            <div class="dashboard-card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">⏰</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #ef4444;">
                    {{ $attendance->where('status', 'late')->count() }}</div>
                <div style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase;">Late Entries</div>
            </div>
            <div class="dashboard-card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📝</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: var(--primary-light);">0</div>
                <div style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase;">Quizzes Taken</div>
            </div>
            <div class="dashboard-card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">🏆</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: #10b981;">0</div>
                <div style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase;">Certificates</div>
            </div>
        </div>

        <!-- Attendance History -->
        <div class="dashboard-card" style="padding: 0; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                <h3 style="margin: 0;">Live Class Attendance History</h3>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: left; background: rgba(0,0,0,0.2);">
                            <th style="padding: 1rem 1.5rem; color: var(--gray); font-size: 0.85rem;">CLASS TITLE</th>
                            <th style="padding: 1rem 1.5rem; color: var(--gray); font-size: 0.85rem;">DATE</th>
                            <th style="padding: 1rem 1.5rem; color: var(--gray); font-size: 0.85rem;">JOINED AT</th>
                            <th style="padding: 1rem 1.5rem; color: var(--gray); font-size: 0.85rem;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendance as $item)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.03);">
                                <td style="padding: 1.25rem 1.5rem;">
                                    <div style="font-weight: 600; color: var(--white);">{{ $item->liveClass->title }}</div>
                                </td>
                                <td style="padding: 1.25rem 1.5rem; color: var(--gray-light);">
                                    {{ $item->liveClass->scheduled_at->format('M d, Y') }}
                                </td>
                                <td style="padding: 1.25rem 1.5rem; color: var(--gray-light);">
                                    {{ $item->joined_at->format('h:i A') }}
                                    <span
                                        style="font-size: 0.75rem; color: var(--gray); margin-left: 5px;">({{ $item->joined_at->diffForHumans($item->liveClass->scheduled_at) }})</span>
                                </td>
                                <td style="padding: 1.25rem 1.5rem;">
                                    @php
                                        $statusColor = $item->status == 'on-time' ? '#10b981' : '#ef4444';
                                    @endphp
                                    <span
                                        style="padding: 0.2rem 0.6rem; border-radius: 4px; background: {{ $statusColor }}20; color: {{ $statusColor }}; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 4rem; text-align: center; color: var(--gray);">
                                    You haven't joined any live classes yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection