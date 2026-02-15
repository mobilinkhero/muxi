@extends('layouts.main')

@section('title', $job->title)
@section('description', 'Apply for ' . $job->title . ' at GSM Trading Lab')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">{{ $job->title }}</h1>
            <p class="page-breadcrumb">
                <a href="{{ route('company.careers') }}">Careers</a> / {{ $job->title }}
            </p>
        </div>
    </header>

    <section class="content-section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Job Details -->
                <div>
                    <div class="card" style="margin-bottom: 2rem; padding: 2rem;">
                        <div
                            style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem; font-size: 0.9rem; color: var(--gray);">
                            <span style="background: rgba(255,255,255,0.05); padding: 0.5rem 1rem; border-radius: 4px;">🏢
                                {{ $job->department }}</span>
                            <span style="background: rgba(255,255,255,0.05); padding: 0.5rem 1rem; border-radius: 4px;">📍
                                {{ $job->location }}</span>
                            <span style="background: rgba(255,255,255,0.05); padding: 0.5rem 1rem; border-radius: 4px;">💼
                                {{ $job->type }}</span>
                            @if($job->experience_level)
                                <span style="background: rgba(255,255,255,0.05); padding: 0.5rem 1rem; border-radius: 4px;">🎓
                                    {{ $job->experience_level }}</span>
                            @endif
                            @if($job->salary)
                                <span
                                    style="background: rgba(16, 185, 129, 0.1); color: #10B981; padding: 0.5rem 1rem; border-radius: 4px;">💰
                                    {{ $job->salary }}</span>
                            @endif
                        </div>

                        <h3 style="color: var(--white); margin-bottom: 1rem;">Job Description</h3>
                        <div style="color: var(--gray-light); line-height: 1.8; margin-bottom: 2rem;">
                            {!! nl2br(e($job->description)) !!}
                        </div>

                        @if($job->requirements)
                            <h3 style="color: var(--white); margin-bottom: 1rem;">Requirements</h3>
                            <div style="color: var(--gray-light); line-height: 1.8; margin-bottom: 2rem;">
                                {!! nl2br(e($job->requirements)) !!}
                            </div>
                        @endif

                        @if($job->benefits)
                            <h3 style="color: var(--white); margin-bottom: 1rem;">Benefits</h3>
                            <div style="color: var(--gray-light); line-height: 1.8;">
                                {!! nl2br(e($job->benefits)) !!}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Application Form -->
                <div>
                    <div class="card" style="position: sticky; top: 2rem; padding: 2rem;">
                        <h3 style="color: var(--white); margin-bottom: 1.5rem;">Apply for this Position</h3>

                        @if(session('success'))
                            <div
                                style="background: rgba(16, 185, 129, 0.2); color: #10B981; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('company.careers.apply', $job->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-input" required placeholder="John Doe">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-input" required placeholder="john@example.com">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-input" placeholder="+1234567890">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Upload CV / Resume (PDF, DOC)</label>
                                <input type="file" name="cv" class="form-input" accept=".pdf,.doc,.docx" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Cover Letter (Optional)</label>
                                <textarea name="cover_letter" class="form-input" rows="4"
                                    placeholder="Teil us why you're a good fit..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection