@extends('layouts.admin')

@section('title', 'Manage Team')
@section('header', 'Team Management')

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
    <div class="card">
        <h3 style="color: var(--white); margin-bottom: 1.5rem;">Add Team Member</h3>
        <form action="{{ route('admin.content.team.store') }}" method="POST" enctype="multipart/form-data" id="teamForm">
            @csrf
            <input type="hidden" name="cropped_image" id="cropped_image">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-input" required placeholder="John Doe">
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <input type="text" name="role" class="form-input" required placeholder="Senior Analyst">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Bio (Optional)</label>
                <textarea name="bio" class="form-input" rows="3" placeholder="Brief description..."></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Profile Image</label>
                    <input type="file" id="imageInput" class="form-input" accept="image/*">
                    <small style="color: var(--gray);">Recommended: Square crop (1:1)</small>
                </div>
                <div class="form-group">
                    <label class="form-label">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-input" placeholder="https://linkedin.com/in/...">
                </div>
                <div class="form-group">
                    <label class="form-label">Twitter URL</label>
                    <input type="url" name="twitter_url" class="form-input" placeholder="https://twitter.com/...">
                </div>
            </div>

            <div style="text-align: right; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">Add Member</button>
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

    <div class="card">
        <h3 style="color: var(--white); margin-bottom: 1rem;">Current Team Members</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>
                            @if($member->image_url)
                                <img src="{{ asset($member->image_url) }}" alt="{{ $member->name }}"
                                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div
                                    style="width: 40px; height: 40px; border-radius: 50%; background: var(--dark-light); display: flex; align-items: center; justify-content: center; color: var(--gray);">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                            @endif
                        </td>
                        <td style="color: white; font-weight: bold;">{{ $member->name }}</td>
                        <td>{{ $member->role }}</td>
                        <td>
                            @if($member->is_active)
                                <span style="color: #10B981;">Active</span>
                            @else
                                <span style="color: var(--gray);">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('admin.content.team.edit', $member->id) }}"
                                    class="btn btn-sm btn-secondary">Edit</a>
                                <form action="{{ route('admin.content.team.delete', $member->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        style="background: #ef4444; color: white;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

        imageInput.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(event) {
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
                    width: 400,
                    height: 400,
                });
                croppedImageInput.value = canvas.toDataURL('image/jpeg');
                cropModal.style.display = 'none';

                // Show a small preview or change the input background to indicate success
                imageInput.parentElement.style.border = '2px solid #10B981';
            }
        }
    </script>
@endsection