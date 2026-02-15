@extends('layouts.admin')

@section('title', 'Edit Recording')
@section('header', 'Edit Recording Details')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3>Edit: {{ $recording->title }}</h3>
            <a href="{{ route('admin.lms.recordings') }}" class="btn btn-secondary">
                &larr; Back to Library
            </a>
        </div>

        <form id="updateForm" action="{{ route('admin.lms.recordings.update', $recording->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Video Details -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Session Title</label>
                        <input type="text" name="title" class="form-input" value="{{ $recording->title }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input"
                            style="height: 150px;">{{ $recording->description }}</textarea>
                    </div>
                </div>

                <!-- File Uploads -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Replace Video File (Optional)</label>
                        <div
                            style="border: 2px dashed rgba(255,255,255,0.1); padding: 1.5rem; text-align: center; border-radius: 8px;">
                            <input type="file" name="video_file" id="videoFile" accept="video/*" style="width: 100%;">
                            <small
                                style="color: var(--primary); display: block; margin-top: 10px; font-weight: bold;">Unlimited
                                Size Upload</small>
                            <hr style="border-color: rgba(255,255,255,0.1); margin: 15px 0;">

                            <label class="form-label" style="text-align: left;">Current Video Preview:</label>
                            <div style="border-radius: 8px; overflow: hidden; background: #000; margin-bottom: 10px;">
                                <video id="adminPlayer" playsinline controls style="width: 100%;">
                                    <source src="{{ url($recording->video_url) }}" type="video/mp4">
                                </video>
                            </div>
                            <small style="color: var(--gray);">Direct Link: <a href="{{ url($recording->video_url) }}"
                                    target="_blank" style="color: var(--primary);">Open in Tab</a></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Update Thumbnail (Optional)</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="form-input"
                            style="padding: 0.5rem;">
                        @if($recording->thumbnail_url)
                            <div style="margin-top: 10px;">
                                <img src="{{ asset($recording->thumbnail_url) }}" alt="Current Thumbnail"
                                    style="width: 100px; height: auto; border-radius: 4px;">
                                <br>
                                <small style="color: var(--gray);">Current Thumbnail</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div id="progressContainer"
                style="display: none; margin-top: 1.5rem; background: rgba(255,255,255,0.1); border-radius: 8px; overflow: hidden;">
                <div id="progressBar" style="width: 0%; height: 20px; background: var(--primary); transition: width 0.3s;">
                </div>
                <div id="progressText" style="text-align: center; font-size: 0.8rem; padding: 5px; color: white;">0%
                    Uploaded</div>
            </div>

            <div
                style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem; text-align: right;">
                <button type="submit" class="btn btn-primary" id="updateBtn">Update Recording</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('updateForm').addEventListener('submit', function (e) {

            // Only use AJAX if a file is selected for upload to show progress
            const videoInput = document.getElementById('videoFile');
            if (videoInput.files.length === 0) {
                return; // Submit normally if no big file
            }

            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressContainer = document.getElementById('progressContainer');
            const updateBtn = document.getElementById('updateBtn');

            progressContainer.style.display = 'block';
            updateBtn.disabled = true;
            updateBtn.innerText = 'Uploading Updates...';

            axios.post(form.action, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: function (progressEvent) {
                    const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    progressBar.style.width = percentCompleted + '%';
                    progressText.innerText = percentCompleted + '% Uploaded (' + (progressEvent.loaded / (1024 * 1024)).toFixed(2) + 'MB / ' + (progressEvent.total / (1024 * 1024)).toFixed(2) + 'MB)';
                }
            })
                .then(function (response) {
                    window.location.href = "{{ route('admin.lms.recordings') }}";
                })
                .catch(function (error) {
                    console.error(error);
                    progressContainer.style.display = 'none';
                    updateBtn.disabled = false;
                    updateBtn.innerText = 'Update Recording';
                    alert('Update Failed: ' + (error.response?.data?.message || error.message));
                });
        });

        // Initialize Admin Plyr
        document.addEventListener('DOMContentLoaded', () => {
            const player = new Plyr('#adminPlayer');
        });
    </script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <style>
        :root {
            --plyr-color-main: #10B981;
        }
    </style>
@endsection