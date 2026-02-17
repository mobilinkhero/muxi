<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\P2PPool;
use App\Models\P2PTransaction;

class P2PController extends Controller
{
    /**
     * Admin Dashboard for P2P Management.
     */
    public function index()
    {
        $usdtPool = P2PPool::updateOrCreate(['asset' => 'USDT']);
        $pkrPool = P2PPool::updateOrCreate(['asset' => 'PKR']);

        $pendingTransactions = P2PTransaction::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $history = P2PTransaction::where('status', '!=', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total_volume_buy' => P2PTransaction::where('type', 'buy')->where('status', 'completed')->sum('amount_asset'),
            'total_volume_sell' => P2PTransaction::where('type', 'sell')->where('status', 'completed')->sum('amount_asset'),
            'total_pending' => $pendingTransactions->count(),
        ];

        return view('admin.p2p.index', compact('usdtPool', 'pkrPool', 'pendingTransactions', 'history', 'stats'));
    }

    /**
     * Update Rates, Balances and Wallet Details.
     */
    public function updateRates(Request $request)
    {
        $request->validate([
            'buy_rate' => 'nullable|numeric',
            'sell_rate' => 'nullable|numeric',
            'balance' => 'nullable|numeric',
            'usdt_wallet' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'account_title' => 'nullable|string',
            'account_no' => 'nullable|string',
            'iban' => 'nullable|string',
            'usdt_network' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        // Update USDT Pool (If rate data is present)
        if ($request->has('buy_rate') || $request->has('balance')) {
            $updateData = [];
            if ($request->has('buy_rate'))
                $updateData['buy_rate'] = $request->buy_rate;
            if ($request->has('sell_rate'))
                $updateData['sell_rate'] = $request->sell_rate;
            if ($request->has('balance'))
                $updateData['balance'] = $request->balance;
            if ($request->has('is_active'))
                $updateData['is_active'] = $request->is_active;

            if (!empty($updateData)) {
                P2PPool::where('asset', 'USDT')->update($updateData);
            }
        }

        // Update Receiving Endpoints (Structured Data)
        if ($request->has('bank_name')) {
            $pkrDetails = "Bank: " . $request->bank_name . "\nTitle: " . $request->account_title . "\nA/C: " . $request->account_no . "\nIBAN: " . ($request->iban ?? 'N/A');
            P2PPool::where('asset', 'PKR')->update([
                'wallet_details' => $pkrDetails,
            ]);
        }

        if ($request->has('usdt_wallet')) {
            $usdtDetails = "Network: " . ($request->usdt_network ?? 'TRC20') . "\nAddress: " . $request->usdt_wallet;
            P2PPool::where('asset', 'USDT')->update([
                'wallet_details' => $usdtDetails,
            ]);
        }

        return back()->with('success', 'Exchange parameters synchronized successfully.');
    }

    /**
     * Process Transaction (Approve/Reject).
     */
    public function process(Request $request, $id)
    {
        $transaction = P2PTransaction::findOrFail($id);
        $pool = P2PPool::where('asset', 'USDT')->first();

        if ($request->action === 'approve') {
            // Adjust Pool Balance
            if ($transaction->type === 'buy') {
                // User bought USDT -> Pool loses USDT
                $pool->decrement('balance', $transaction->amount_asset);
            } else {
                // User sold USDT -> Pool gains USDT
                $pool->increment('balance', $transaction->amount_asset);
            }

            $transaction->update([
                'status' => 'completed',
                'admin_notes' => $request->admin_notes
            ]);

            return back()->with('success', 'Transaction approved and balance updated.');
        } elseif ($request->action === 'reject') {
            $transaction->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes
            ]);

            return back()->with('success', 'Transaction rejected.');
        }

        return back()->with('error', 'Invalid action.');
    }
}
