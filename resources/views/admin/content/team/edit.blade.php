@extends('layouts.admin')

@section('title', 'Modify Operative')

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
            backdrop-filter: blur(5px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .modal-content {
            background: #0f172a;
            padding: 2rem;
            border-radius: 24px;
            max-width: 600px;
            width: 100%;
            border: 1px solid var(--h-border);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
    </style>
@endsection

@section('content')
<div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
    <div>
        <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Modify Operative</h1>
        <p style="color: #94A3B8; margin-top: 0.5rem;">Editing credentials for: {{ $member->name }}</p>
    </div>
    <a href="{{ route('admin.content.team.index') }}" class="btn-primary-h"
        style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
        <i class="fas fa-arrow-left"></i> Return to Matrix
    </a>
</div>

<div class="h-reveal" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.content.team.update', $member->id) }}" method="POST" enctype="multipart/form-data"
        id="teamForm">
        @csrf
        <input type="hidden" name="cropped_image" id="cropped_image">

        <!-- Core Identity -->
        <div class="h-card">
            <h3
                style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
                <i class="fas fa-id-card" style="color: var(--h-primary);"></i> Core Identity
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label class="h-label">Operative Name</label>
                    <input type="text" name="name" class="h-input" required value="{{ old('name', $member->name) }}">
                </div>
                <div class="form-group">
                    <label class="h-label">Designation / Role</label>
                    <input type="text" name="role" class="h-input" required value="{{ old('role', $member->role) }}">
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Dossier (Bio)</label>
                <textarea name="bio" class="h-input" rows="4">{{ old('bio', $member->bio) }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Visual Identification</label>
                <div
                    style="display: flex; align-items: center; gap: 2rem; background: rgba(0,0,0,0.2); padding: 1.5rem; border-radius: 16px; border: 1px solid var(--h-border);">
                    <div id="imagePreviewContainer" style="{{ $member->image_url ? '' : 'display: none;' }}">
                        <img id="imagePreview" src="{{ $member->image_url ? asset($member->image_url) : '' }}"
                            style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid var(--h-primary); box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);">
                    </div>
                    <div style="flex: 1;">
                        <label class="btn-primary-h"
                            style="background: rgba(255,255,255,0.05); color: #94A3B8; justify-content: center; cursor: pointer; border: 1px dashed var(--h-border); width: 100%;">
                            <i class="fas fa-camera"></i> Update Biometric Image
                            <input type="file" id="imageInput" accept="image/*" style="display: none;">
                        </label>
                        <p style="color: #64748B; font-size: 0.75rem; margin-top: 0.5rem; text-align: center;">
                            Recommended aspect ratio 1:1</p>
                        <p style="color: #10B981; font-size: 0.75rem; margin-top: 0.3rem; text-align: center; display: none;"
                            id="cropSuccessMsg">✓ NEW_IMAGE_QUEUED</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Uplinks -->
        <div class="h-card">
            <h3
                style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
                <i class="fas fa-share-alt" style="color: var(--h-secondary);"></i> Social Uplinks
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="h-label">LinkedIn</label>
                    <input type="url" name="linkedin_url" class="h-input"
                        value="{{ old('linkedin_url', $member->linkedin_url) }}">
                </div>
                <div class="form-group">
                    <label class="h-label">X (Twitter)</label>
                    <input type="url" name="twitter_url" class="h-input"
                        value="{{ old('twitter_url', $member->twitter_url) }}">
                </div>
                <div class="form-group">
                    <label class="h-label">Facebook</label>
                    <input type="url" name="facebook_url" class="h-input"
                        value="{{ old('facebook_url', $member->facebook_url) }}">
                </div>
                <div class="form-group">
                    <label class="h-label">Instagram</label>
                    <input type="url" name="instagram_url" class="h-input"
                        value="{{ old('instagram_url', $member->instagram_url) }}">
                </div>
                <div class="form-group">
                    <label class="h-label">Threads</label>
                    <input type="url" name="threads_url" class="h-input"
                        value="{{ old('threads_url', $member->threads_url) }}">
                </div>
                <div class="form-group">
                    <label class="h-label">YouTube</label>
                    <input type="url" name="youtube_url" class="h-input"
                        value="{{ old('youtube_url', $member->youtube_url) }}">
                </div>
                <div class="form-group">
                    <label class="h-label">TikTok</label>
                    <input type="url" name="tiktok_url" class="h-input"
                        value="{{ old('tiktok_url', $member->tiktok_url) }}">
                </div>
            </div>
        </div>

        <!-- Status & Actions -->
        <div class="h-card" style="display: flex; justify-content: space-between; align-items: center;">
            <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}
                    style="width: 20px; height: 20px; accent-color: var(--h-primary);">
                <div>
                    <div style="font-weight: 800; color: white;">ACTIVE STATUS</div>
                    <div style="font-size: 0.75rem; color: #94A3B8;">Operative is visible in public matrix</div>
                </div>
            </label>

            <button type="submit" class="btn-primary-h">
                <i class="fas fa-save"></i> Save Configuration
            </button>
        </div>
    </form>
</div>

<!-- Crop Modal -->
<div id="cropModal">
    <div class="modal-content">
        <h3 style="margin-bottom: 1.5rem; color: white; font-weight: 900; font-size: 1.5rem;">Adjust ID Photo</h3>
        <div style="width: 100%; margin-bottom: 2rem; background: black; border-radius: 12px; overflow: hidden;">
            <img id="cropImage" src="" style="max-width: 100%; display: block;">
        </div>
        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <button type="button" class="btn-primary-h" onclick="closeCropModal()"
                style="background: transparent; border: 1px solid var(--h-border); color: #94A3B8;">Cancel</button>
            <button type="button" class="btn-primary-h" onclick="applyCrop()">
                <i class="fas fa-crop-alt"></i> Confirm Crop
            </button>
        </div>
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
                if (document.getElementById('imagePreview')) {
                    document.getElementById('imagePreview').src = dataUrl;
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                }

                if (document.getElementById('cropSuccessMsg')) {
                    document.getElementById('cropSuccessMsg').style.display = 'block';
                }

                cropModal.style.display = 'none';
            }
        }
    </script>
@endsection