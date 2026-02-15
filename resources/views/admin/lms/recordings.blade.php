@extends('layouts.admin')

@section('title', 'Class Recordings')
@section('header', 'Video Recordings Library')

@section('content')
    <div class="card">
        <h3 style="margin-bottom: 1.5rem;">Upload New Session</h3>
        <form id="uploadForm" action="{{ route('admin.lms.recordings.upload') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Video Details -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Session Title</label>
                        <input type="text" name="title" class="form-input"
                            placeholder="e.g. Risk Management Masterclass - Day 1" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description (Optional)</label>
                        <textarea name="description" class="form-input" style="height: 100px;"
                            placeholder="Brief summary of what was covered..."></textarea>
                    </div>
                </div>

                <!-- File Uploads -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Video File (MP4, MOV)</label>
                        <div
                            style="border: 2px dashed rgba(255,255,255,0.1); padding: 1.5rem; text-align: center; border-radius: 8px;">
                            <input type="file" name="video_file" id="videoFile" accept="video/*" required
                                style="width: 100%;">
                            <small
                                style="color: var(--primary); display: block; margin-top: 10px; font-weight: bold;">Unlimited
                                Size Upload</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Thumbnail Image (Optional)</label>
                        <input type="file" name="thumbnail_file" accept="image/*" class="form-input"
                            style="padding: 0.5rem;">
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

            <div style="margin-top: 1.5rem; text-align: right;">
                <button type="submit" class="btn btn-primary" id="uploadBtn">Start Upload</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressContainer = document.getElementById('progressContainer');
            const uploadBtn = document.getElementById('uploadBtn');

            progressContainer.style.display = 'block';
            uploadBtn.disabled = true;
            uploadBtn.innerText = 'Uploading... Please Wait';

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
                    progressText.innerText = 'Upload Complete! Processing...';
                    window.location.reload();
                })
                .catch(function (error) {
                    console.error(error);
                    progressContainer.style.display = 'none';
                    uploadBtn.disabled = false;
                    uploadBtn.innerText = 'Start Upload';
                    alert('Upload Failed: ' + (error.response?.data?.message || error.message));
                });
        });
    </script>

    <h3 style="margin: 2.5rem 0 1.5rem;">Published Recordings</h3>
    <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
        @forelse($recordings as $recording)
            <div class="card" style="padding: 0; overflow: hidden; position: relative;">
                @if($recording->thumbnail_url)
                    <div
                        style="height: 180px; background-image: url('{{ asset($recording->thumbnail_url) }}'); background-size: cover; background-position: center;">
                    </div>
                @else
                    <div
                        style="height: 180px; background: var(--dark-light); display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 3rem;">🎬</span>
                    </div>
                @endif

                <div style="padding: 1.25rem;">
                    <div style="font-weight: bold; font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--white);">
                        {{ $recording->title }}
                    </div>
                    <div style="color: var(--gray); font-size: 0.85rem; margin-bottom: 1rem; height: 40px; overflow: hidden;">
                        {{ \Illuminate\Support\Str::limit($recording->description, 80) }}
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
                        <span
                            style="font-size: 0.8rem; color: var(--gray);">{{ $recording->published_at->format('l, M d, Y') }}</span>

                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('admin.lms.recordings.edit', $recording->id) }}"
                                style="text-decoration: none; font-size: 0.85rem; color: var(--primary); display: flex; align-items: center; gap: 5px;">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('admin.lms.recordings.delete', $recording->id) }}" method="POST"
                                onsubmit="return confirm('Delete this recording permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.85rem; display: flex; align-items: center; gap: 5px;">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: var(--gray);">
                <div style="font-size: 2rem; margin-bottom: 1rem;">📹</div>
                No recordings uploaded yet.
            </div>
        @endforelse
    </div>
@endsection