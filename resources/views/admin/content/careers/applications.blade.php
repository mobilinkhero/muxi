@extends('layouts.admin')

@section('title', 'Job Applications')
@section('header', 'Applications for: ' . $job->title)

@section('actions')
    <a href="{{ route('admin.content.careers.index') }}" class="btn btn-secondary btn-sm">Back to Jobs</a>
@endsection

@section('content')
    <div class="card">
        <h3 style="color: var(--white); margin-bottom: 1rem;">Total Applications: {{ $job->applications->count() }}</h3>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>CV</th>
                        <th>Cover Letter</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($job->applications as $app)
                        <tr>
                            <td>{{ $app->created_at->format('M d, Y') }}</td>
                            <td style="color: white; font-weight: bold;">{{ $app->name }}</td>
                            <td>{{ $app->email }}</td>
                            <td>{{ $app->phone ?? '-' }}</td>
                            <td>
                                <a href="{{ asset($app->cv_path) }}" target="_blank" class="btn btn-sm btn-primary"
                                    style="padding: 0.2rem 0.5rem; font-size: 0.8rem;">
                                    View CV
                                </a>
                            </td>
                            <td>
                                @if($app->cover_letter)
                                    <button onclick="alert('{{ trim(preg_replace('/\s+/', ' ', $app->cover_letter)) }}')"
                                        class="btn btn-sm btn-secondary" style="padding: 0.2rem 0.5rem; font-size: 0.8rem;">
                                        Read
                                    </button>
                                @else
                                    <span style="color: var(--gray);">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem;">No applications received yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection