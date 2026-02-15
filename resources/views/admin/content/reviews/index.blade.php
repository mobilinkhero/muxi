@extends('layouts.admin')

@section('title', 'Manage Reviews')
@section('header', 'Student Reviews')

@section('content')
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Add Review Form -->
        <div class="card">
            <h3>Add New Review</h3>
            <form action="{{ route('admin.content.reviews.store') }}" method="POST" style="margin-top: 1.5rem;">
                @csrf
                <div class="form-group">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="name" class="form-input" required placeholder="Ali Hassan">
                </div>
                <div class="form-group">
                    <label class="form-label">Role/Market (Optional)</label>
                    <input type="text" name="role" class="form-input" placeholder="Crypto Student">
                </div>
                <div class="form-group">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-input">
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Review Text</label>
                    <textarea name="review" class="form-input" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="is_published" value="1" checked>
                        <span>Publish immediately</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Add Review</button>
            </form>
        </div>

        <!-- Reviews List -->
        <div class="card">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid rgba(255,255,255,0.1); text-align: left;">
                            <th style="padding: 1rem;">Student</th>
                            <th style="padding: 1rem;">Rating</th>
                            <th style="padding: 1rem;">Review</th>
                            <th style="padding: 1rem;">Status</th>
                            <th style="padding: 1rem;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="padding: 1rem;">
                                    <strong>{{ $review->name }}</strong><br>
                                    <small style="color: var(--gray);">{{ $review->role }}</small>
                                </td>
                                <td style="padding: 1rem; color: #F59E0B;">
                                    {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                </td>
                                <td style="padding: 1rem;">
                                    <div
                                        style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $review->review }}
                                    </div>
                                </td>
                                <td style="padding: 1rem;">
                                    <span
                                        style="padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem; background: {{ $review->is_published ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; color: {{ $review->is_published ? '#10B981' : '#ef4444' }};">
                                        {{ $review->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td style="padding: 1rem;">
                                    <form action="{{ route('admin.content.reviews.delete', $review->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background: none; border: none; color: #ef4444; cursor: pointer;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 2rem; text-align: center; color: var(--gray);">No reviews found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection