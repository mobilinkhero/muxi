@extends('layouts.admin')

@section('title', 'Manage Daily Tasks')
@section('header', 'Daily Practical Tasks')

@section('content')
    <div class="card">
        <div style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1rem;">Add New Task</h3>
            <form action="{{ route('admin.lms.tasks.store') }}" method="POST">
                @csrf
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <div style="flex: 2; min-width: 300px;">
                        <input type="text" name="title" class="form-input"
                            placeholder="Task Title (e.g. Submit Risk Management Quiz)" required>
                    </div>
                    <div style="flex: 3; min-width: 300px;">
                        <input type="text" name="description" class="form-input"
                            placeholder="Short Description (e.g. Required for next practical level)">
                    </div>
                    <div style="flex: 1;">
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Add Task</button>
                    </div>
                </div>
            </form>
        </div>

        <h3 style="margin-bottom: 1rem;">Active Tasks</h3>
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: rgba(255,255,255,0.05); text-align: left;">
                        <th style="padding: 1rem; color: var(--gray);">Task Details</th>
                        <th style="padding: 1rem; color: var(--gray);">Date Created</th>
                        <th style="padding: 1rem; color: var(--gray);">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="padding: 1rem;">
                                <div style="font-weight: bold; font-size: 1rem; color: var(--white);">{{ $task->title }}</div>
                                <div style="font-size: 0.85rem; color: var(--gray);">{{ $task->description }}</div>
                            </td>
                            <td style="padding: 1rem; color: var(--gray);">
                                {{ $task->created_at->format('M d, Y') }}
                            </td>
                            <td style="padding: 1rem;">
                                <form action="{{ route('admin.lms.tasks.delete', $task->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background: none; border: none; color: #ef4444; cursor: pointer;">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 2rem; color: var(--gray);">No active tasks
                                found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection