@extends('layouts.admin')

@section('title', 'Feedback Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Feedback Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing student testimonials & ratings.</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Add Review Form -->
        <div class="h-card h-reveal">
            <h3
                style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
                <i class="fas fa-plus-circle" style="color: var(--h-primary);"></i> Initialize New Entry
            </h3>
            <form action="{{ route('admin.content.reviews.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="h-label">Student Identity</label>
                    <input type="text" name="name" class="h-input" required placeholder="Ali Hassan">
                </div>
                <div class="form-group">
                    <label class="h-label">Role / Market Specialization</label>
                    <input type="text" name="role" class="h-input" placeholder="e.g. Crypto Student">
                </div>
                <div class="form-group">
                    <label class="h-label">Performance Rating</label>
                    <select name="rating" class="h-input">
                        <option value="5">★★★★★ (Maximum)</option>
                        <option value="4">★★★★ (High)</option>
                        <option value="3">★★★ (Average)</option>
                        <option value="2">★★ (Sub-optimal)</option>
                        <option value="1">★ (Critical)</option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label class="h-label">Testimonial Content</label>
                    <textarea name="review" class="h-input" rows="4" required placeholder="Enter feedback text..."
                        style="font-family: 'JetBrains Mono'; line-height: 1.6;"></textarea>
                </div>

                <div
                    style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--h-border); padding-top: 1.5rem; margin-top: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                        <input type="checkbox" name="is_published" value="1" checked
                            style="width: 20px; height: 20px; accent-color: var(--h-primary);">
                        <div style="font-size: 0.8rem; color: #94A3B8; font-weight: 600;">IMMEDIATE BROADCAST</div>
                    </label>

                    <button type="submit" class="btn-primary-h" style="padding: 0.6rem 1.2rem;">
                        <i class="fas fa-save"></i> Submit
                    </button>
                </div>
            </form>
        </div>

        <!-- Reviews List -->
        <div class="h-card h-reveal">
            <h3
                style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
                <i class="fas fa-list-ul" style="color: var(--h-secondary);"></i> Active Testimonials
            </h3>
            <div style="overflow-x: auto;">
                <table class="h-table">
                    <thead>
                        <tr>
                            <th>Student Identity</th>
                            <th>Rating</th>
                            <th>Feedback Summary</th>
                            <th>Status</th>
                            <th>Directives</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>
                                    <div style="font-weight: 800; color: white;">{{ $review->name }}</div>
                                    <div style="font-size: 0.75rem; color: #64748B;">{{ $review->role }}</div>
                                </td>
                                <td style="color: #F59E0B; font-family: 'JetBrains Mono'; letter-spacing: 2px;">
                                    {{ str_repeat('★', $review->rating) }}<span
                                        style="color: #334155;">{{ str_repeat('★', 5 - $review->rating) }}</span>
                                </td>
                                <td>
                                    <div
                                        style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #94A3B8; font-style: italic;">
                                        "{{ $review->review }}"
                                    </div>
                                </td>
                                <td>
                                    @if($review->is_published)
                                        <span class="status-pill" style="background: rgba(16, 185, 129, 0.1); color: #10B981;">
                                            <i class="fas fa-check-circle" style="margin-right:4px;"></i> LIVE
                                        </span>
                                    @else
                                        <span class="status-pill" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B;">
                                            <i class="fas fa-pause-circle" style="margin-right:4px;"></i> DRAFT
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.content.reviews.delete', $review->id) }}" method="POST"
                                        onsubmit="return confirm('Purge this testimonial record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-primary-h"
                                            style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 3rem; color: #64748B;">
                                    <i class="fas fa-comment-slash"
                                        style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                    No feedback records found in the database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
@endsection