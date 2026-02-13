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
            'buy_rate' => 'required|numeric',
            'sell_rate' => 'required|numeric',
            'balance' => 'required|numeric', // USDT Balance
            'usdt_wallet' => 'nullable|string',
            'pkr_bank' => 'nullable|string',
        ]);

        // Update USDT Pool
        P2PPool::where('asset', 'USDT')->update([
            'buy_rate' => $request->buy_rate,
            'sell_rate' => $request->sell_rate,
            'balance' => $request->balance,
            'wallet_details' => $request->usdt_wallet, // Admin's TRC20 Address
        ]);

        // Update PKR Pool (Bank Details)
        P2PPool::where('asset', 'PKR')->update([
            'wallet_details' => $request->pkr_bank, // Admin's Bank Details
        ]);

        return back()->with('success', 'Exchange settings updated successfully.');
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
