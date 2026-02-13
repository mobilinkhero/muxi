@extends('layouts.admin')

@section('title', 'Manage Orders')
@section('header', 'Order Management')

@section('content')
    <div class="card">
        <div style="margin-bottom: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: center; justify-content: space-between;">
            <!-- Filters -->
            <div style="display: flex; gap: 0.5rem;">
                <a href="{{ route('admin.orders.index') }}" 
                   class="btn btn-sm {{ !request('status') ? 'btn-primary' : 'btn-secondary' }}" 
                   style="{{ !request('status') ? '' : 'background: transparent; border: 1px solid var(--gray); color: var(--gray-light);' }}">
                    All
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
                   class="btn btn-sm {{ request('status') == 'pending' ? 'btn-primary' : 'btn-secondary' }}"
                   style="{{ request('status') == 'pending' ? 'background: #F59E0B; border-color: #F59E0B;' : 'background: transparent; border: 1px solid var(--gray); color: var(--gray-light);' }}">
                    Pending
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" 
                   class="btn btn-sm {{ request('status') == 'completed' ? 'btn-primary' : 'btn-secondary' }}"
                   style="{{ request('status') == 'completed' ? 'background: #10B981; border-color: #10B981;' : 'background: transparent; border: 1px solid var(--gray); color: var(--gray-light);' }}">
                    Completed
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'rejected']) }}" 
                   class="btn btn-sm {{ request('status') == 'rejected' ? 'btn-primary' : 'btn-secondary' }}"
                   style="{{ request('status') == 'rejected' ? 'background: #EF4444; border-color: #EF4444;' : 'background: transparent; border: 1px solid var(--gray); color: var(--gray-light);' }}">
                    Rejected
                </a>
            </div>
            
            <!-- Search (Optional for future) -->
            <div>
                <form action="{{ route('admin.orders.index') }}" method="GET" style="display: flex; gap: 0.5rem;">
                    <input type="text" name="search" placeholder="Search Order ID..." class="form-input" style="padding: 0.4rem;" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                </form>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: rgba(255,255,255,0.05);">
                        <th style="padding: 1rem; text-align: left; color: var(--gray-light);">Order ID</th>
                        <th style="padding: 1rem; text-align: left; color: var(--gray-light);">Student Info</th>
                        <th style="padding: 1rem; text-align: left; color: var(--gray-light);">Order Details</th>
                        <th style="padding: 1rem; text-align: left; color: var(--gray-light);">Payment Proof</th>
                        <th style="padding: 1rem; text-align: left; color: var(--gray-light);">Status</th>
                        <th style="padding: 1rem; text-align: left; color: var(--gray-light);">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s; vertical-align: middle;">
                            <td style="padding: 1rem;">#{{ $order->id }}</td>
                            <td style="padding: 1rem;">
                                <div style="font-weight: bold; color: var(--white);">{{ $order->user->name }}</div>
                                <div style="font-size: 0.85rem; color: var(--gray);">{{ $order->user->email }}</div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="color: var(--primary-light);">{{ $order->service_name }}</div>
                                <div style="font-size: 1.1rem; font-weight: bold; margin-top: 0.25rem;">
                                    ${{ number_format($order->amount, 2) }}
                                </div>
                                <div style="font-size: 0.85rem; color: var(--gray);">Via: {{ $order->payment_method }}</div>
                            </td>
                            <td style="padding: 1rem;">
                                @if($order->payment_method === 'Verification' && $order->service_name === 'Premium Access (Pay Later) Verification')
                                    @php
                                        $verification = json_decode($order->notes, true);
                                    @endphp
                                    @if(is_array($verification))
                                        <div style="font-size: 0.85rem; color: var(--gray-light); margin-bottom: 0.5rem;">
                                            <div><strong>CNIC:</strong> {{ $verification['cnic_number'] ?? 'N/A' }}</div>
                                            <div><strong>Mobile:</strong> {{ $verification['mobile'] ?? 'N/A' }}</div>
                                        </div>
                                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                            @foreach(['cnicFront', 'cnicBack', 'profilePhoto'] as $key)
                                                @if(isset($verification[$key]))
                                                    <a href="{{ Storage::url($verification[$key]) }}" target="_blank" 
                                                       style="display: block; width: 60px; height: 40px; overflow: hidden; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);"
                                                       title="{{ ucfirst(preg_replace('/(?<!^)[A-Z]/', ' $0', $key)) }}">
                                                        <img src="{{ Storage::url($verification[$key]) }}" alt="{{ $key }}" 
                                                             style="width: 100%; height: 100%; object-fit: cover;">
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <span style="color: var(--gray);">Invalid Data</span>
                                    @endif
                                @elseif($order->screenshot_path)
                                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                        <a href="{{ Storage::url($order->screenshot_path) }}" target="_blank" 
                                           style="display: block; width: 100px; height: 60px; overflow: hidden; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">
                                            <img src="{{ Storage::url($order->screenshot_path) }}" alt="Proof" 
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                        @if($order->transaction_id)
                                            <div style="font-size: 0.8rem; font-family: monospace; color: var(--gray);">
                                                TXID: {{ Str::limit($order->transaction_id, 15) }}
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span style="color: var(--gray);">No Proof Uploaded</span>
                                @endif
                            </td>
                            <td style="padding: 1rem;">
                                @if($order->status == 'pending')
                                    <span style="background: rgba(245, 158, 11, 0.2); color: #F59E0B; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.85rem;">Pending Review</span>
                                @elseif($order->status == 'completed')
                                    <span style="background: rgba(16, 185, 129, 0.2); color: #10B981; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.85rem;">Approved</span>
                                @else
                                    <span style="background: rgba(239, 68, 68, 0.2); color: #EF4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.85rem;">Rejected</span>
                                @endif
                            </td>
                            <td style="padding: 1rem;">
                                <form action="{{ route('admin.order.update', $order->id) }}" method="POST"
                                    style="display: flex; flex-direction: column; gap: 0.5rem;">
                                    @csrf
                                    
                                    <!-- Approve Button: Show if Pending or Rejected -->
                                    @if($order->status != 'completed')
                                        <button type="submit" name="status" value="completed" 
                                                class="btn btn-sm" 
                                                style="background: #10B981; color: white; border: none; width: 100%; text-align: center; font-weight: 500;">
                                            {{ $order->status == 'rejected' ? 'Re-Approve' : 'Approve' }}
                                        </button>
                                    @endif
                                    
                                    <!-- Reject Button: Show if Pending or Completed -->
                                    @if($order->status != 'rejected')
                                        <div style="margin-top: {{ $order->status == 'completed' ? '0' : '0.5rem' }};">
                                            <input type="text" name="rejection_reason" placeholder="Reason for rejection..." 
                                                style="width: 100%; padding: 0.25rem 0.5rem; background: var(--dark); border: 1px solid rgba(239, 68, 68, 0.3); color: var(--white); font-size: 0.8rem; border-radius: 4px; margin-bottom: 0.4rem; display: none;"
                                                id="reason-input-{{ $order->id }}">
                                                
                                            <button type="button" onclick="showRejectionInput({{ $order->id }})" 
                                                    id="reject-btn-{{ $order->id }}"
                                                    class="btn btn-sm" 
                                                    style="background: rgba(239, 68, 68, 0.1); color: #EF4444; border: 1px solid #EF4444; width: 100%; text-align: center; font-weight: 500;">
                                                Reject
                                            </button>

                                            <button type="submit" name="status" value="rejected" 
                                                    id="confirm-reject-btn-{{ $order->id }}"
                                                    class="btn btn-sm" 
                                                    style="background: #EF4444; color: white; border: none; width: 100%; text-align: center; display: none; font-weight: 500;">
                                                Confirm Reject
                                            </button>
                                        </div>
                                    @endif
                                </form>

                                @if($order->status == 'rejected' && $order->rejection_reason)
                                    <div style="margin-top: 0.5rem; font-size: 0.75rem; color: #EF4444; background: rgba(239, 68, 68, 0.1); padding: 0.5rem; border-radius: 4px;">
                                        <strong>Reason:</strong> {{ $order->rejection_reason }}
                                    </div>
                                @endif

                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" 
                                    onsubmit="return confirm('⚠️ Warning: This will permanently delete this order from the database. This action cannot be undone. Continue?')"
                                    style="margin-top: 0.5rem;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" 
                                            style="background: transparent; color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); width: 100%; font-size: 0.75rem; padding: 0.15rem 0.5rem;">
                                        🗑️ Delete Permanently
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--gray);">No orders found matching your criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 1.5rem;">
            {{ $orders->links() }}
        </div>
    </div>
@section('scripts')
<script>
    function showRejectionInput(id) {
        document.getElementById('reject-btn-' + id).style.display = 'none';
        
        const input = document.getElementById('reason-input-' + id);
        input.style.display = 'block';
        input.focus();
        
        document.getElementById('confirm-reject-btn-' + id).style.display = 'block';
    }
</script>
@endsection
