@extends('layouts.admin')

@section('title', 'Compose Brief - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Compose Brief</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Drafting new intelligence article.</p>
        </div>
        <a href="{{ route('admin.content.blog.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Return to Matrix
        </a>
    </div>

    <div class="h-reveal" style="max-width: 900px; margin: 0 auto;">
        <form action="{{ route('admin.content.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="h-card">
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">Subject / Title</label>
                        <input type="text" name="title" class="h-input" required placeholder="Enter post title..."
                            onkeyup="generateSlug(this.value)">
                    </div>

                    <div class="form-group">
                        <label class="h-label">Slug Identifier (URL)</label>
                        <input type="text" name="slug" id="slug" class="h-input" required placeholder="post-url-slug"
                            readonly style="background: rgba(0,0,0,0.3); color: #64748B; cursor: not-allowed;">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Visual Asset (Key Image)</label>
                    <label class="btn-primary-h"
                        style="background: rgba(255,255,255,0.05); color: #94A3B8; justify-content: center; cursor: pointer; border: 1px dashed var(--h-border); width: 100%;">
                        <i class="fas fa-upload"></i> Upload Cover Image
                        <input type="file" name="image" accept="image/*" style="display: none;"
                            onchange="document.getElementById('fileName').innerText = this.files[0].name">
                    </label>
                    <div id="fileName" style="margin-top: 0.5rem; font-size: 0.8rem; color: #10B981; text-align: center;">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Briefing Content (HTML Supported)</label>
                    <textarea name="content" class="h-input" rows="15" required
                        placeholder="&lt;p&gt;Write your intelligence report here...&lt;/p&gt;"
                        style="font-family: 'JetBrains Mono'; line-height: 1.6;"></textarea>
                    <div style="display: flex; justify-content: space-between; margin-top: 0.5rem;">
                        <small style="color: #64748B;">Supports standard HTML tags for formatting.</small>
                    </div>
                </div>

                <div
                    style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--h-border); padding-top: 1.5rem; margin-top: 2rem;">
                    <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                        <input type="checkbox" name="is_published" value="1" id="is_published" checked
                            style="width: 20px; height: 20px; accent-color: var(--h-primary);">
                        <div>
                            <div style="font-weight: 800; color: white;">IMMEDIATE BROADCAST</div>
                            <div style="font-size: 0.75rem; color: #94A3B8;">Publish to public channels upon save</div>
                        </div>
                    </label>

                    <button type="submit" class="btn-primary-h">
                        <i class="fas fa-paper-plane"></i> Deploy Briefing
                    </button>
                </div>
            </div>
        </form>
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

        function generateSlug(text) {
            const slug = text.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        }
    </script>
@endsection