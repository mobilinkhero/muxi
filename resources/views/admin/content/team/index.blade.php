@extends('layouts.admin')

@section('title', 'Team Matrix - Admin')

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
        <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Team Matrix</h1>
        <p style="color: #94A3B8; margin-top: 0.5rem;">Managing public-facing operative profiles.</p>
    </div>
</div>

<div class="h-reveal" style="display: grid; grid-template-columns: 350px 1fr; gap: 2rem; align-items: start;">
    <!-- Add Member Form -->
    <div class="h-card">
        <h3
            style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-user-plus" style="color: var(--h-primary);"></i> Initialize Operative
        </h3>
        <form action="{{ route('admin.content.team.store') }}" method="POST" enctype="multipart/form-data"
            id="teamForm">
            @csrf
            <input type="hidden" name="cropped_image" id="cropped_image">

            <div class="form-group mb-3">
                <label class="h-label">Operative Name</label>
                <input type="text" name="name" class="h-input" required placeholder="Ex: Sarah Connor">
            </div>

            <div class="form-group mb-3">
                <label class="h-label">Designation / Role</label>
                <input type="text" name="role" class="h-input" required placeholder="Ex: Lead Strategist">
            </div>

            <div class="form-group mb-3">
                <label class="h-label">Dossier (Bio)</label>
                <textarea name="bio" class="h-input" rows="3" placeholder="Brief personnel summary..."></textarea>
            </div>

            <div class="form-group mb-3">
                <label class="h-label">Visual Identification</label>
                <div id="imagePreviewContainer"
                    style="margin-bottom: 1rem; display: none; text-align: center; padding: 1rem; border: 1px dashed var(--h-border); border-radius: 12px;">
                    <img id="imagePreview" src=""
                        style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid var(--h-primary); box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);">
                    <p style="color: #10B981; font-size: 0.7rem; margin-top: 0.5rem; font-weight: 800;">✓
                        BIOMETRIC_READY</p>
                </div>
                <label class="btn-primary-h"
                    style="background: rgba(255,255,255,0.05); color: #94A3B8; justify-content: center; cursor: pointer; border: 1px dashed var(--h-border);">
                    <i class="fas fa-upload"></i> Upload Source File
                    <input type="file" id="imageInput" accept="image/*" style="display: none;">
                </label>
            </div>

            <div class="form-group mb-3">
                <label class="h-label">Social Uplink (LinkedIn)</label>
                <input type="url" name="linkedin_url" class="h-input" placeholder="https://linkedin.com/in/...">
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Social Uplink (X)</label>
                <input type="url" name="twitter_url" class="h-input" placeholder="https://x.com/...">
            </div>

            <button type="submit" class="btn-primary-h" style="width: 100%; justify-content: center;">
                <i class="fas fa-check"></i> Authorize Entry
            </button>
        </form>
    </div>

    <!-- Members List -->
    <div class="h-card">
        <h3 style="color: white; margin-bottom: 2rem; font-size: 1.1rem;">Active Personnel</h3>
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Identity</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    @if($member->image_url)
                                        <img src="{{ asset($member->image_url) }}" alt="{{ $member->name }}"
                                            style="width: 45px; height: 45px; border-radius: 12px; object-fit: cover; border: 1px solid var(--h-border);">
                                    @else
                                        <div
                                            style="width: 45px; height: 45px; border-radius: 12px; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; color: #94A3B8; font-weight: 800;">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div style="font-weight: 800; color: white;">{{ $member->name }}</div>
                                </div>
                            </td>
                            <td style="color: #94A3B8; font-family: 'JetBrains Mono'; font-size: 0.85rem;">
                                {{ $member->role }}</td>
                            <td>
                                @if($member->is_active)
                                    <span class="status-pill"
                                        style="background: rgba(16, 185, 129, 0.1); color: #10B981;">ACTIVE</span>
                                @else
                                    <span class="status-pill"
                                        style="background: rgba(255, 255, 255, 0.05); color: #64748b;">INACTIVE</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('admin.content.team.edit', $member->id) }}" class="btn-primary-h"
                                        style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.content.team.delete', $member->id) }}" method="POST"
                                        onsubmit="return confirm('Confirm personnel removal?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-primary-h"
                                            style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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

                // Show the preview
                document.getElementById('imagePreview').src = dataUrl;
                document.getElementById('imagePreviewContainer').style.display = 'block';

                cropModal.style.display = 'none';
            }
        }
    </script>
@endsection