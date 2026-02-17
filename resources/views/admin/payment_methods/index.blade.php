@extends('layouts.admin')

@section('title', 'Payment Matrix')

@section('content')
    <div class="h-reveal">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2 style="margin: 0; font-weight: 900; font-size: 2rem; letter-spacing: -1px; color: white;">Payment Protocols</h2>
                <p style="color: #94A3B8; margin-top: 5px;">Manage liquidity gateways and collection nodes.</p>
            </div>
            <a href="{{ route('admin.payment-methods.create') }}" class="btn-primary-h">
                <i class="fas fa-plus"></i> New Protocol
            </a>
        </div>

        <div class="h-card">
            <div style="overflow-x: auto;">
                <table class="h-table">
                    <thead>
                        <tr>
                            <th>Identity</th>
                            <th>Protocol Details</th>
                            <th>Bank / Network</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentMethods as $method)
                            <tr>
                                <td style="display: flex; align-items: center; gap: 15px;">
                                    <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.03); border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--h-border);">
                                        @if($method->icon)
                                            <img src="{{ $method->icon }}" style="width: 24px; height: 24px; object-fit: contain;">
                                        @else
                                            <i class="fas fa-credit-card" style="color: var(--h-primary);"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 800; color: white; font-size: 1rem;">{{ $method->name }}</div>
                                        <div style="font-size: 0.7rem; color: #64748b; font-family: 'JetBrains Mono';">PID: #{{ $method->id }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #e2e8f0;">{{ $method->account_name }}</div>
                                    <div style="font-family: 'JetBrains Mono'; color: var(--h-primary); font-size: 0.85rem;">{{ $method->account_number }}</div>
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #94A3B8;">{{ $method->network ?? $method->bank_name }}</div>
                                </td>
                                <td>
                                    <span class="status-pill" 
                                          style="background: {{ $method->is_active ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; 
                                                 color: {{ $method->is_active ? '#10B981' : '#EF4444' }};">
                                        {{ $method->is_active ? 'Active' : 'Offline' }}
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <a href="{{ route('admin.payment-methods.edit', $method->id) }}" 
                                           class="btn-primary-h" style="padding: 8px 12px; font-size: 0.75rem; background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST"
                                              onsubmit="return confirm('Terminate this protocol?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-primary-h" 
                                                    style="padding: 8px 12px; font-size: 0.75rem; background: rgba(239, 68, 68, 0.1); color: #EF4444; border-color: rgba(239, 68, 68, 0.2);">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 5rem; color: #64748b;">
                                    <i class="fas fa-satellite-dish" style="font-size: 3rem; opacity: 0.2; margin-bottom: 1rem; display: block;"></i>
                                    No active protocols found in the matrix.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        gsap.to('.h-reveal', {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power4.out"
        });
    });
</script>
@endsection