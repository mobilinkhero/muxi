@extends('layouts.admin')

@section('title', 'Modify Stream - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Modify Stream</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Update session data for: {{ $recording->title }}</p>
        </div>
        <a href="{{ route('admin.lms.recordings') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Return to Matrix
        </a>
    </div>

    <div class="h-card h-reveal">
        <form id="updateForm" action="{{ route('admin.lms.recordings.update', $recording->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Video Details -->
                <div>
                    <h3
                        style="color: white; margin-bottom: 1.5rem; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 0.5rem;">
                        <i class="fas fa-file-alt" style="color: var(--h-primary); margin-right: 8px;"></i> Meta Data
                    </h3>

                    <div class="form-group mb-4">
                        <label class="h-label">Session Designation</label>
                        <input type="text" name="title" class="h-input" value="{{ $recording->title }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="h-label">Briefing (Description)</label>
                        <textarea name="description" class="h-input"
                            style="height: 150px; line-height: 1.6;">{{ $recording->description }}</textarea>
                    </div>
                </div>

                <!-- File Uploads -->
                <div>
                    <h3
                        style="color: white; margin-bottom: 1.5rem; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 0.5rem;">
                        <i class="fas fa-database" style="color: var(--h-secondary); margin-right: 8px;"></i> Media Assets
                    </h3>

                    <div class="form-group mb-4">
                        <label class="h-label">Overwrite Video Stream</label>
                        <div
                            style="border: 2px dashed rgba(255,255,255,0.1); padding: 1.5rem; text-align: center; border-radius: 12px; background: rgba(0,0,0,0.2); transition: 0.3s;">
                            <i class="fas fa-upload" style="font-size: 1.5rem; color: #64748B; margin-bottom: 1rem;"></i>
                            <input type="file" name="video_file" id="videoFile" accept="video/*"
                                style="width: 100%; color: #94A3B8;">

                            <hr style="border-color: rgba(255,255,255,0.05); margin: 15px 0;">

                            <label class="h-label" style="text-align: left; margin-bottom: 0.5rem; display: block;">Current
                                Stream Preview:</label>
                            <div
                                style="border-radius: 8px; overflow: hidden; background: #000; margin-bottom: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">
                                <video id="adminPlayer" playsinline controls style="width: 100%;">
                                    <source src="{{ url($recording->video_url) }}" type="video/mp4">
                                </video>
                            </div>
                            <div style="text-align: right;">
                                <a href="{{ url($recording->video_url) }}" target="_blank"
                                    style="font-size: 0.75rem; color: var(--h-primary); text-decoration: none;">
                                    <i class="fas fa-external-link-alt"></i> Direct Access
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="h-label">Update Visual Cover</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="h-input"
                            style="padding: 0.5rem; margin-bottom: 1rem;">
                        @if($recording->thumbnail_url)
                            <div
                                style="position: relative; width: 100%; height: 120px; border-radius: 8px; overflow: hidden; border: 1px solid var(--h-border);">
                                <img src="{{ asset($recording->thumbnail_url) }}" alt="Current Thumbnail"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                                <div
                                    style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); color: white; padding: 4px 8px; font-size: 0.7rem; font-family: 'JetBrains Mono';">
                                    CURRENT ASSET
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div id="progressContainer"
                style="display: none; margin-top: 2rem; background: rgba(0,0,0,0.3); border-radius: 8px; overflow: hidden; padding: 4px; border: 1px solid rgba(255,255,255,0.05);">
                <div style="display: flex; justify-content: space-between; margin-bottom: 5px; padding: 0 10px;">
                    <span style="font-size: 0.75rem; color: var(--h-primary); font-family: 'JetBrains Mono';">UPLOADING
                        PATCH...</span>
                    <span id="progressText"
                        style="font-size: 0.75rem; color: white; font-family: 'JetBrains Mono';">0%</span>
                </div>
                <div style="height: 6px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden;">
                    <div id="progressBar"
                        style="width: 0%; height: 100%; background: var(--h-primary); transition: width 0.3s; box-shadow: 0 0 10px var(--h-primary);">
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; border-top: 1px solid var(--h-border); padding-top: 1.5rem; text-align: right;">
                <button type="submit" class="btn-primary-h" id="updateBtn">
                    <i class="fas fa-save"></i> Commit Updates
                </button>
            </div>
        </form>
    </div>

    <!-- Scripts & Styles -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        :root {
            --plyr-color-main: #6366F1;
            /* Matches --h-primary */
            --plyr-video-background: #0F172A;
            --plyr-menu-background: rgba(15, 23, 42, 0.9);
            --plyr-menu-color: #fff;
        }

        .plyr--full-ui input[type=range] {
            color: var(--plyr-color-main);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power4.out"
            });

            // Initialize Plyr
            const player = new Plyr('#adminPlayer');
        });

        document.getElementById('updateForm').addEventListener('submit', function (e) {
            // Only use AJAX if a file is selected for upload to show progress
            const videoInput = document.getElementById('videoFile');

            // Should also check if file input has files, otherwise standard submit is fine
            // But if specific UX for progress is needed even for small updates (like thumbs), can use axios always.
            // For now, let's stick to the logic: if big file, show progress.
            if (videoInput.files.length === 0) {
                // Return to let standard submission happen if no video file
                // But wait, if we want consistency, maybe just use axios always? 
                // Let's keep original logic but style the loading state if standard submit happens
                const btn = document.getElementById('updateBtn');
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                return;
            }

            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressContainer = document.getElementById('progressContainer');
            const updateBtn = document.getElementById('updateBtn');

            progressContainer.style.display = 'block';
            gsap.fromTo(progressContainer, { height: 0, opacity: 0 }, { height: 'auto', opacity: 1, duration: 0.5 });

            updateBtn.disabled = true;
            updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> TRANSMITTING PATCH...';

            axios.post(form.action, formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                onUploadProgress: function (progressEvent) {
                    const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progressBar.style.width = percentCompleted + '%';
                    progressText.innerText = percentCompleted + '% COMPLETE';
                }
            })
                .then(function (response) {
                    progressText.innerText = 'PATCH COMPLETE. RELOADING...';
                    progressBar.style.backgroundColor = '#10B981';
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.lms.recordings') }}";
                    }, 1000);
                })
                .catch(function (error) {
                    console.error(error);
                    progressContainer.style.display = 'none';
                    updateBtn.disabled = false;
                    updateBtn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> RETRY COMMIT';
                    alert('Update Protocol Failed: ' + (error.response?.data?.message || error.message));
                });
        });
    </script>
@endsection