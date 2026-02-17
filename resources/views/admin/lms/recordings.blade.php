@extends('layouts.admin')

@section('title', 'Video Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Video Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing instructional recordings & media.</p>
        </div>
    </div>

    <!-- Upload Form -->
    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-cloud-upload-alt" style="color: var(--h-primary);"></i> Initialise Upload
        </h3>
        
        <form id="uploadForm" action="{{ route('admin.lms.recordings.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Video Details -->
                <div>
                    <div class="form-group mb-4">
                        <label class="h-label">Session Designation</label>
                        <input type="text" name="title" class="h-input" placeholder="e.g. Risk Management Masterclass - Day 1" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="h-label">Briefing (Description)</label>
                        <textarea name="description" class="h-input" style="height: 120px;" placeholder="Summary of mission content..." style="font-family: 'JetBrains Mono'; line-height: 1.6;"></textarea>
                    </div>
                </div>

                <!-- File Uploads -->
                <div>
                    <div class="form-group mb-4">
                        <label class="h-label">Video Data Stream (MP4, MOV)</label>
                        <div style="border: 2px dashed rgba(255,255,255,0.1); padding: 1.5rem; text-align: center; border-radius: 12px; background: rgba(0,0,0,0.2); transition: 0.3s;">
                            <i class="fas fa-film" style="font-size: 2rem; color: #64748B; margin-bottom: 1rem;"></i>
                            <input type="file" name="video_file" id="videoFile" accept="video/*" required style="width: 100%; color: #94A3B8;">
                            <div style="margin-top: 10px; font-size: 0.75rem; color: var(--h-secondary); font-family: 'JetBrains Mono';">
                                <i class="fas fa-infinity"></i> UNLIMITED BANDWIDTH
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="h-label">Visual Cover (Thumbnail)</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="h-input" style="padding: 0.5rem;">
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div id="progressContainer" style="display: none; margin-top: 2rem; background: rgba(0,0,0,0.3); border-radius: 8px; overflow: hidden; padding: 4px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px; padding: 0 10px;">
                    <span style="font-size: 0.75rem; color: var(--h-primary); font-family: 'JetBrains Mono';">UPLOADING STREAM...</span>
                    <span id="progressText" style="font-size: 0.75rem; color: white; font-family: 'JetBrains Mono';">0%</span>
                </div>
                <div style="height: 6px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden;">
                    <div id="progressBar" style="width: 0%; height: 100%; background: var(--h-primary); transition: width 0.3s; box-shadow: 0 0 10px var(--h-primary);"></div>
                </div>
            </div>

            <div style="margin-top: 2rem; text-align: right; border-top: 1px solid var(--h-border); padding-top: 1.5rem;">
                <button type="submit" class="btn-primary-h" id="uploadBtn">
                    <i class="fas fa-satellite-dish"></i> Initiate Transmission
                </button>
            </div>
        </form>
    </div>

    <!-- Published Recordings Grid -->
    <div class="h-reveal" style="margin-top: 3rem;">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-photo-video" style="color: var(--h-secondary);"></i> Archived Logs
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
            @forelse($recordings as $recording)
                <div class="h-card" style="padding: 0; margin-bottom: 0; display: flex; flex-direction: column;">
                    <div style="position: relative; height: 180px; background: #0F172A; overflow: hidden;">
                        @if($recording->thumbnail_url)
                            <img src="{{ asset($recording->thumbnail_url) }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8; transition: 0.3s;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: rgba(99, 102, 241, 0.1);">
                                <i class="fas fa-play-circle" style="font-size: 3rem; color: rgba(255,255,255,0.2);"></i>
                            </div>
                        @endif
                        <div style="position: absolute; top: 10px; right: 10px;">
                            <span class="status-pill" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.1);">
                                {{ $recording->duration ?? 'Video' }}
                            </span>
                        </div>
                    </div>

                    <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                        <div style="font-weight: 800; font-size: 1.1rem; margin-bottom: 0.5rem; color: white;">
                            {{ $recording->title }}
                        </div>
                        <div style="color: #94A3B8; font-size: 0.85rem; margin-bottom: 1.5rem; flex: 1; line-height: 1.5;">
                            {{ \Illuminate\Support\Str::limit($recording->description, 100) }}
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.05);">
                            <div style="font-size: 0.75rem; color: #64748B; font-family: 'JetBrains Mono';">
                                {{ $recording->created_at->format('M d, Y') }}
                            </div>

                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.lms.recordings.edit', $recording->id) }}" class="btn-primary-h" style="padding: 0.4rem; width: 32px; height: 32px; justify-content: center; background: rgba(255,255,255,0.05); color: #94A3B8;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.lms.recordings.delete', $recording->id) }}" method="POST"
                                    onsubmit="return confirm('Purge this recording data?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-primary-h"
                                        style="padding: 0.4rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: #64748B; background: rgba(255,255,255,0.02); border-radius: 20px; border: 1px dashed rgba(255,255,255,0.1);">
                    <i class="fas fa-film" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>No recording logs found in the archives.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
            
            // Hover effect for video cards
            const cards = document.querySelectorAll('.h-card');
            cards.forEach(card => {
                const img = card.querySelector('img');
                if(img) {
                    card.addEventListener('mouseenter', () => {
                        gsap.to(img, { scale: 1.05, duration: 0.5 });
                    });
                    card.addEventListener('mouseleave', () => {
                        gsap.to(img, { scale: 1, duration: 0.5 });
                    });
                }
            });
        });

        const uploadForm = document.getElementById('uploadForm');
        if (uploadForm) {
            uploadForm.addEventListener('submit', function (e) {
                e.preventDefault();
    
                const form = this;
                const formData = new FormData(form);
                const progressBar = document.getElementById('progressBar');
                const progressText = document.getElementById('progressText');
                const progressContainer = document.getElementById('progressContainer');
                const uploadBtn = document.getElementById('uploadBtn');
    
                progressContainer.style.display = 'block';
                // Animate container entrance
                gsap.fromTo(progressContainer, { height: 0, opacity: 0 }, { height: 'auto', opacity: 1, duration: 0.5 });
                
                uploadBtn.disabled = true;
                uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> TRANSMITTING...';
    
                axios.post(form.action, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' },
                    onUploadProgress: function (progressEvent) {
                        const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        progressBar.style.width = percentCompleted + '%';
                        progressText.innerText = percentCompleted + '% COMPLETE';
                        
                        // Particle effect could be added here for extra flair
                    }
                })
                .then(function (response) {
                    progressText.innerText = 'UPLOAD COMPLETE. PROCESSING...';
                    progressBar.style.backgroundColor = '#10B981'; // Green success
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                })
                .catch(function (error) {
                    console.error(error);
                    progressContainer.style.display = 'none';
                    uploadBtn.disabled = false;
                    uploadBtn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> RETRY TRANSMISSION';
                    alert('Upload Protocol Failed: ' + (error.response?.data?.message || error.message));
                });
            });
        }
    </script>
@endsection
