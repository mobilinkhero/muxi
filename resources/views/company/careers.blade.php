@extends('layouts.main')

@section('title', 'Careers')
@section('description', 'Join the team at GSM Trading Lab. Explore current job openings and career opportunities.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Careers</h1>
            <p class="page-breadcrumb">Home / Company / Careers</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div style="margin-bottom: 3rem; text-align: center; max-width: 700px; margin-left: auto; margin-right: auto;">
                <p style="font-size: 1.2rem; color: var(--gray-light);">
                    We are always looking for talented individuals who are passionate about finance, technology, and
                    education. Join us in our mission to democratize trading knowledge.
                </p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @forelse($jobs as $job)
                    <div class="card" style="padding: 2rem;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                            <div>
                                <h3 style="color: var(--white); margin-bottom: 0.5rem;">{{ $job->title }}</h3>
                                <div style="font-size: 0.9rem; color: var(--gray);">
                                    <span style="display: inline-flex; align-items: center; gap: 0.5rem; margin-right: 1.5rem;">
                                        🏢 {{ $job->department }}
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 0.5rem; margin-right: 1.5rem;">
                                        📍 {{ $job->location }}
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 0.5rem; margin-right: 1.5rem;">
                                        💼 {{ $job->type }}
                                    </span>
                                    @if($job->salary)
                                        <span style="display: inline-flex; align-items: center; gap: 0.5rem; color: #10B981;">
                                            💰 {{ $job->salary }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('company.careers.show', $job->id) }}" class="btn btn-primary btn-sm">
                                View Details & Apply
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="card" style="text-align: center;">
                        <p style="padding: 2rem;">No current openings. Check back later!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection