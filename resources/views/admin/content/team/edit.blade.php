@extends('layouts.admin')

@section('title', 'Edit Team Member')
@section('header', 'Edit Team Member')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <style>
        .cropper-container {
            max-height: 500px;
        }

        #cropModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .modal-content {
            background: var(--dark-light);
            padding: 1.5rem;
            border-radius: var(--radius-md);
            max-width: 600px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <h3 style="color: var(--white); margin-bottom: 1.5rem;">Edit: {{ $member->name }}</h3>
        <form action="{{ route('admin.content.team.update', $member->id) }}" method="POST" enctype="multipart/form-data"
            id="teamForm">
            @csrf
            <input type="hidden" name="cropped_image" id="cropped_image">

            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name', $member->name) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Role</label>
                <input type="text" name="role" class="form-input" required value="{{ old('role', $member->role) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Bio (Optional)</label>
                <textarea name="bio" class="form-input" rows="3">{{ old('bio', $member->bio) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Profile Image</label>
                <div id="imagePreviewContainer"
                    style="margin-bottom: 1rem; {{ $member->image_url ? '' : 'display: none;' }}">
                    <img id="imagePreview" src="{{ $member->image_url ? asset($member->image_url) : '' }}"
                        style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary);">
                    <p style="color: #10B981; font-size: 0.8rem; margin-top: 0.5rem;" id="cropSuccessMsg"
                        style="display: none;">✓ Image ready to upload</p>
                </div>
                <input type="file" id="imageInput" class="form-input" accept="image/*">
                <small style="color: var(--gray);">Recommended: Square crop (1:1). Current images will be replaced upon
                    saving.</small>
            </div>

            <div style="margin-top: 1.5rem; margin-bottom: 1rem;">
                <h4 style="color: var(--white); margin-bottom: 1rem;">Social Profiles</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" class="form-input"
                            value="{{ old('linkedin_url', $member->linkedin_url) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Twitter / X URL</label>
                        <input type="url" name="twitter_url" class="form-input"
                            value="{{ old('twitter_url', $member->twitter_url) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" name="facebook_url" class="form-input"
                            value="{{ old('facebook_url', $member->facebook_url) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" name="instagram_url" class="form-input"
                            value="{{ old('instagram_url', $member->instagram_url) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Threads URL</label>
                        <input type="url" name="threads_url" class="form-input"
                            value="{{ old('threads_url', $member->threads_url) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">YouTube URL</label>
                        <input type="url" name="youtube_url" class="form-input"
                            value="{{ old('youtube_url', $member->youtube_url) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">TikTok URL</label>
                        <input type="url" name="tiktok_url" class="form-input"
                            value="{{ old('tiktok_url', $member->tiktok_url) }}">
                    </div>
                </div>
            </div>

            <div class="form-check" style="margin-bottom: 1rem;">
                <input type="checkbox" name="is_active" value="1" id="is_active" {{ $member->is_active ? 'checked' : '' }}>
                <label for="is_active" style="color: white; margin-left: 0.5rem;">Active</label>
            </div>

            <div style="text-align: right; margin-top: 2rem;">
                <a href="{{ route('admin.content.team.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Member</button>
            </div>
        </form>
    </div>

    <!-- Crop Modal -->
    <div id="cropModal">
        <div class="modal-content">
            <h3 style="margin-bottom: 1rem; color: white;">Adjust Profile Photo</h3>
            <div style="width: 100%; margin-bottom: 1.5rem;">
                <img id="cropImage" src="" style="max-width: 100%; display: block;">
            </div>
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="button" class="btn btn-secondary" onclick="closeCropModal()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="applyCrop()">Crop & Use</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper;
        const imageInput = document.getElementById('imageInput');
        const cropImage = document.getElementById('cropImage');
        const cropModal = document.getElementById('cropModal');
        const croppedImageInput = document.getElementById('cropped_image');

        imageInput.addEventListener('change', function (e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    cropImage.src = event.target.result;
                    cropModal.style.display = 'flex';
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(cropImage, {
                        aspectRatio: 1,
                        viewMode: 2,
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        });

        function closeCropModal() {
            cropModal.style.display = 'none';
            imageInput.value = '';
            if (cropper) {
                cropper.destroy();
            }
        }

        function applyCrop() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 500,
                    height: 500,
                    imageSmoothingQuality: 'high'
                });
                
                const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
                croppedImageInput.value = dataUrl;
                
                // Show the preview to the user immediately
                if(document.getElementById('imagePreview')) {
                    document.getElementById('imagePreview').src = dataUrl;
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                }
                
                if(document.getElementById('cropSuccessMsg')) {
                    document.getElementById('cropSuccessMsg').style.display = 'block';
                }
                
                cropModal.style.display = 'none';
            }
        }
    </script>
@endsection