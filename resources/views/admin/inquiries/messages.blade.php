@extends('layouts.admin')

@section('title', 'Comms Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Comms Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Incoming messages & support tickets.</p>
        </div>
    </div>

    <div class="h-card h-reveal">
        <h3 style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-envelope" style="color: var(--h-accent);"></i> Active Transmissions: {{ $messages->total() }}
        </h3>

        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Msg ID</th>
                        <th>Sender Identity</th>
                        <th>Contact / Email</th>
                        <th>Subject</th>
                        <th>Message Content</th>
                        <th>Timestamp</th>
                        <th>Directives</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr>
                            <td style="color: #64748b; font-family: 'JetBrains Mono';">#{{ $message->id }}</td>
                            <td style="color: white; font-weight: 800;">
                                {{ $message->name }}
                            </td>
                            <td>{{ $message->email }}</td>
                            <td>
                                <span style="font-weight: 600; color: #E2E8F0;">{{ $message->subject }}</span>
                            </td>
                            <td>
                                <div
                                    style="max-width: 400px; font-size: 0.85rem; color: #94A3B8; line-height: 1.5; background: rgba(0,0,0,0.2); padding: 0.5rem; border-radius: 8px;">
                                    {{ $message->message }}
                                </div>
                            </td>
                            <td style="color: #64748b; font-family: 'JetBrains Mono'; font-size: 0.8rem;">
                                {{ $message->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <button onclick="window.location.href='mailto:{{ $message->email }}'" class="btn-primary-h"
                                        style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                        <i class="fas fa-reply"></i>
                                    </button>
                                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST"
                                        onsubmit="return confirm('Purge this message?')">
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
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 3rem; color: #64748B;">
                                <i class="fas fa-satellite-dish"
                                    style="font-size: 2rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                No incoming transmissions detected.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 1rem;">
            {{ $messages->links() }}
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