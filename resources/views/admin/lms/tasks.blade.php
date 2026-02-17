@extends('layouts.admin')

@section('title', 'Task Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Task Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing daily practical assignments & objectives.</p>
        </div>
    </div>

    <!-- Add Task Form -->
    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-plus-square" style="color: var(--h-primary);"></i> Initialize New Objective
        </h3>
        <form action="{{ route('admin.lms.tasks.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1.5fr auto; gap: 1rem; align-items: end;">
                <div>
                    <label class="h-label">Objective Designation</label>
                    <input type="text" name="title" class="h-input" placeholder="e.g. Risk Management Assessment" required>
                </div>
                <div>
                    <label class="h-label">Briefing (Description)</label>
                    <input type="text" name="description" class="h-input" placeholder="Mission-critical details...">
                </div>
                <button type="submit" class="btn-primary-h" style="height: 46px;">
                    <i class="fas fa-plus"></i> Deploy Task
                </button>
            </div>
        </form>
    </div>

    <!-- Active Tasks Table -->
    <div class="h-card h-reveal" style="margin-top: 2rem;">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-tasks" style="color: var(--h-accent);"></i> Active Objectives Log
        </h3>

        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th style="width: 60%">Objective Details</th>
                        <th>Deployment Date</th>
                        <th style="text-align: right;">Directives</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>
                                <div style="font-weight: 800; color: white; font-size: 1rem;">{{ $task->title }}</div>
                                <div style="font-size: 0.85rem; color: #94A3B8; margin-top: 4px; line-height: 1.4;">
                                    {{ $task->description }}
                                </div>
                            </td>
                            <td style="color: #64748B; font-family: 'JetBrains Mono'; font-size: 0.85rem;">
                                {{ $task->created_at->format('Y-m-d') }}
                            </td>
                            <td style="text-align: right;">
                                <form action="{{ route('admin.lms.tasks.delete', $task->id) }}" method="POST"
                                    onsubmit="return confirm('Abort this task objective?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-primary-h"
                                        style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 3rem; color: #64748B;">
                                <i class="fas fa-ghost"
                                    style="font-size: 2rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                No active objectives found in the matrix.
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