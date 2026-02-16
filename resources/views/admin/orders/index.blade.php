@extends('layouts.admin')

@section('title', 'Order Stream - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Order Terminal</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing {{ $orders->total() }} incoming data streams</p>
        </div>

        <div class="filter-pill-cloud">
            <a href="{{ route('admin.orders.index') }}"
                class="f-pill {{ !request('status') ? 'active' : '' }}">ALL_NODES</a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
                class="f-pill {{ request('status') == 'pending' ? 'active alert' : '' }}">PENDING</a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}"
                class="f-pill {{ request('status') == 'completed' ? 'active success' : '' }}">COMPLETED</a>
            <a href="{{ route('admin.orders.index', ['status' => 'rejected']) }}"
                class="f-pill {{ request('status') == 'rejected' ? 'active danger' : '' }}">REJECTED</a>
        </div>
    </div>

    <div class="h-card h-reveal" style="padding: 1rem;">
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Identity</th>
                        <th>Objective</th>
                        <th>Payment Proof</th>
                        <th>Status</th>
                        <th>Protocols</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <div style="font-weight: 800; font-size: 1rem;">{{ $order->user->name }}</div>
                                <div style="font-size: 0.75rem; color: #94A3B8; font-family: 'JetBrains Mono';">
                                    {{ $order->user->email }}</div>
                                <div style="font-size: 0.7rem; color: var(--h-primary); margin-top: 4px;">ID: #{{ $order->id }}
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: white;">{{ $order->service_name }}</div>
                                <div style="font-size: 1.25rem; font-weight: 900; color: var(--h-primary); margin-top: 4px;">
                                    ${{ number_format($order->amount, 2) }}</div>
                                <div style="font-size: 0.75rem; color: #94A3B8;">Method: {{ $order->payment_method }}</div>
                            </td>
                            <td>
                                @if($order->payment_method === 'Verification')
                                    @php $verification = json_decode($order->notes, true); @endphp
                                    @if(is_array($verification))
                                        <div style="display: flex; gap: 8px;">
                                            @foreach(['cnicFront', 'cnicBack', 'profilePhoto'] as $key)
                                                @if(isset($verification[$key]))
                                                    <a href="{{ Storage::url($verification[$key]) }}" target="_blank" class="proof-frame">
                                                        <img src="{{ Storage::url($verification[$key]) }}" alt="doc">
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @elseif($order->screenshot_path)
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <a href="{{ Storage::url($order->screenshot_path) }}" target="_blank"
                                            class="proof-frame large">
                                            <img src="{{ Storage::url($order->screenshot_path) }}" alt="proof">
                                        </a>
                                        @if($order->transaction_id)
                                            <div style="font-size: 0.7rem; font-family: 'JetBrains Mono'; color: #64748B;">TX:
                                                {{ Str::limit($order->transaction_id, 10) }}</div>
                                        @endif
                                    </div>
                                @else
                                    <span style="font-size: 0.75rem; color: #475569;">NO_PROOF_FOUND</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-pill"
                                    style="background: {{ $order->status == 'pending' ? 'rgba(245, 158, 11, 0.1)' : ($order->status == 'completed' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)') }}; 
                                                     color: {{ $order->status == 'pending' ? '#F59E0B' : ($order->status == 'completed' ? '#10B981' : '#EF4444') }};">
                                    {{ strtoupper($order->status) }}
                                </span>
                                @if($order->status == 'rejected' && $order->rejection_reason)
                                    <div
                                        style="font-size: 0.7rem; color: #EF4444; margin-top: 6px; max-width: 150px; opacity: 0.8;">
                                        "{{ $order->rejection_reason }}"</div>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                        @csrf
                                        @if($order->status != 'completed')
                                            <button type="submit" name="status" value="completed" class="action-btn-h success">
                                                <i class="fas fa-check"></i>
                                                {{ $order->status == 'rejected' ? 'RE-VERIFY' : 'VERIFY' }}
                                            </button>
                                        @endif

                                        @if($order->status != 'rejected')
                                            <div id="rejection-block-{{ $order->id }}" style="margin-top: 4px;">
                                                <input type="text" name="rejection_reason" placeholder="Input error code..."
                                                    class="h-input-sm" id="reason-{{ $order->id }}"
                                                    style="display: none; margin-bottom: 4px;">
                                                <button type="button" onclick="toggleRejection({{ $order->id }})"
                                                    class="action-btn-h danger" id="rej-trigger-{{ $order->id }}">
                                                    <i class="fas fa-times"></i> REJECT
                                                </button>
                                                <button type="submit" name="status" value="rejected"
                                                    class="action-btn-h danger-fill" id="rej-confirm-{{ $order->id }}"
                                                    style="display: none;">
                                                    CONFIRM_REJECT
                                                </button>
                                            </div>
                                        @endif
                                    </form>

                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                        onsubmit="return confirm('PERMANENTLY_PURGE_DATA?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background: transparent; border: none; color: #475569; font-size: 0.65rem; cursor: pointer; text-decoration: underline;">
                                            PURGE_RECORD
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 5rem; color: #94A3B8;">ZERO_RESULTS_IN_SECTOR
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 2rem; border-top: 1px solid var(--h-border); padding-top: 1.5rem;">
            {{ $orders->links() }}
        </div>
    </div>

    <style>
        .filter-pill-cloud {
            display: flex;
            gap: 10px;
        }

        .f-pill {
            padding: 8px 20px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--h-border);
            color: #94A3B8;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.75rem;
            transition: 0.3s;
        }

        .f-pill:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .f-pill.active {
            background: var(--h-primary);
            color: white;
            border-color: var(--h-primary);
        }

        .f-pill.active.alert {
            background: #F59E0B;
            border-color: #F59E0B;
        }

        .f-pill.active.success {
            background: #10B981;
            border-color: #10B981;
        }

        .f-pill.active.danger {
            background: #EF4444;
            border-color: #EF4444;
        }

        .proof-frame {
            width: 45px;
            height: 30px;
            border-radius: 6px;
            overflow: hidden;
            display: block;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.3s;
        }

        .proof-frame.large {
            width: 80px;
            height: 50px;
        }

        .proof-frame:hover {
            transform: scale(1.1);
            border-color: var(--h-primary);
        }

        .proof-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .action-btn-h {
            width: 100%;
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid transparent;
            font-size: 0.7rem;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .action-btn-h.success {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            border-color: rgba(16, 185, 129, 0.2);
        }

        .action-btn-h.danger {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.2);
        }

        .action-btn-h.danger-fill {
            background: #EF4444;
            color: white;
        }

        .action-btn-h:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        .h-input-sm {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            padding: 6px 10px;
            color: white;
            font-size: 0.75rem;
        }

        .h-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .h-table tr {
            background: rgba(255, 255, 255, 0.02);
            transition: 0.3s;
        }

        .h-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .h-table td,
        .h-table th {
            padding: 1.5rem;
            text-align: left;
            vertical-align: middle;
        }

        .h-table th {
            font-size: 0.7rem;
            color: #94A3B8;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .h-table td:first-child {
            border-radius: 20px 0 0 20px;
        }

        .h-table td:last-child {
            border-radius: 0 20px 20px 0;
        }

        .status-pill {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.5px;
        }

        .h-reveal {
            opacity: 0;
            transform: translateY(20px);
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        function toggleRejection(id) {
            document.getElementById('rej-trigger-' + id).style.display = 'none';
            document.getElementById('reason-' + id).style.display = 'block';
            document.getElementById('reason-' + id).focus();
            document.getElementById('rej-confirm-' + id).style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.1,
                ease: "power4.out"
            });
        });
    </script>
@endsection