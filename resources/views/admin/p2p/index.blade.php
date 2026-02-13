@extends('layouts.admin')

@section('title', 'P2P Management')
@section('header', 'P2P Exchange Management')

@section('content')
    <div class="row">
        <!-- P2P Statistics -->
        <div class="col-md-12 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-header border-bottom border-light">
                    <h5 class="mb-0">Exchange Statistics (Lifetime)</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 border-end border-light">
                            <h3 class="text-success">{{ number_format($stats['total_volume_buy'], 2) }} USDT</h3>
                            <p class="text-muted">Total Purchased by Users</p>
                        </div>
                        <div class="col-md-4 border-end border-light">
                            <h3 class="text-danger">{{ number_format($stats['total_volume_sell'], 2) }} USDT</h3>
                            <p class="text-muted">Total Sold by Users</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-warning">{{ $stats['total_pending'] }}</h3>
                            <p class="text-muted">Pending Requests</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Rates & Balance -->
        <div class="col-md-4">
            <div class="card mb-4 bg-dark text-white">
                <div class="card-header border-bottom border-light">
                    <h5 class="mb-0">Manage Rates & Balance</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.p2p.rates') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label text-white-50">Current Pool Balance (USDT)</label>
                            <input type="number" step="0.01" name="balance" value="{{ $usdtPool->balance }}"
                                class="form-control bg-secondary text-white border-0">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-success">We Sell At (User Buys)</label>
                            <input type="number" step="0.01" name="sell_rate" value="{{ $usdtPool->sell_rate }}"
                                class="form-control bg-secondary text-white border-0">
                            <small class="text-muted">Rate users pay to buy 1 USDT</small>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-danger">We Buy At (User Sells)</label>
                            <input type="number" step="0.01" name="buy_rate" value="{{ $usdtPool->buy_rate }}"
                                class="form-control bg-secondary text-white border-0">
                            <small class="text-muted">Rate users get when selling 1 USDT</small>
                        </div>

                        <hr class="border-secondary my-4">
                        <h6 class="text-white mb-3">Deposit/Withdrawal Accounts</h6>

                        <div class="form-group mb-3">
                            <label class="form-label text-info">Our Bank Account (For Deposits)</label>
                            <textarea name="pkr_bank" rows="3" class="form-control bg-secondary text-white border-0"
                                placeholder="Bank Name, Account Number, Title">{{ $pkrPool->wallet_details }}</textarea>
                            <small class="text-muted">Shown to users wanting to BUY USDT (Deposit PKR)</small>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-warning">Our USDT Address (For Withdrawals)</label>
                            <textarea name="usdt_wallet" rows="2" class="form-control bg-secondary text-white border-0"
                                placeholder="TRC20 Address">{{ $usdtPool->wallet_details }}</textarea>
                            <small class="text-muted">Shown to users wanting to SELL USDT (Deposit USDT)</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Settings</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Pending Transactions -->
        <div class="col-md-8">
            <div class="card bg-dark text-white mb-4">
                <div class="card-header border-bottom border-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pending Requests</h5>
                    <span class="badge bg-warning text-dark">{{ $pendingTransactions->count() }} Pending</span>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Fiat</th>
                                <th>Proof/Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingTransactions as $tx)
                                <tr>
                                    <td>
                                        <div>{{ $tx->user->name }}</div>
                                        <small class="text-muted">{{ $tx->user->email }}</small>
                                    </td>
                                    <td>
                                        <span class="badge {{ $tx->type == 'buy' ? 'bg-success' : 'bg-danger' }}">
                                            {{ strtoupper($tx->type) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($tx->amount_asset, 2) }} USDT</td>
                                    <td>{{ number_format($tx->amount_fiat, 2) }} PKR</td>
                                    <td>
                                        @if($tx->type == 'buy' && $tx->proof_image)
                                            <a href="{{ Storage::url($tx->proof_image) }}" target="_blank"
                                                class="btn btn-sm btn-info">View Proof</a>
                                        @elseif($tx->type == 'sell')
                                            <button class="btn btn-sm btn-secondary"
                                                onclick="alert('{{ str_replace(array("\r", "\n"), " ", $tx->user_payment_details) }}')">View
                                                Details</button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.p2p.process', $tx->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('Approve this transaction?')">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.p2p.process', $tx->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Reject this transaction?')">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No pending transactions.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- History -->
            <div class="card bg-dark text-white">
                <div class="card-header border-bottom border-light">
                    <h5 class="mb-0">Transaction History</h5>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $tx)
                                <tr>
                                    <td>#{{ $tx->id }}</td>
                                    <td>{{ $tx->user->name }}</td>
                                    <td>
                                        <span class="text-{{ $tx->type == 'buy' ? 'success' : 'danger' }}">
                                            {{ ucfirst($tx->type) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($tx->amount_asset, 2) }} USDT</td>
                                    <td>
                                        <span class="badge {{ $tx->status == 'completed' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($tx->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $tx->created_at->format('M d, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-3">
                        {{ $history->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection