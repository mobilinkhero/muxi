<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\P2PPool;
use App\Models\P2PTransaction;
use Illuminate\Support\Facades\Auth;

class P2PController extends Controller
{
    /**
     * Display the P2P Dashboard for Users.
     */
    public function index()
    {
        $pools = P2PPool::get()->keyBy('asset');

        // P2P Portal Global Switch (via USDT pool)
        if (!($pools['USDT']->is_active ?? false)) {
            return redirect()->route('dashboard')->with('error', 'P2P Exchange Node is currently offline for maintenance.');
        }
        $transactions = P2PTransaction::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('dashboard.p2p.index', compact('pools', 'transactions'));
    }

    /**
     * Store a new P2P Transaction request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:buy,sell',
            'amount_asset' => 'required|numeric|min:5',
            'proof_image' => 'nullable|image|max:2048', // Required for buy, processed below
            'user_payment_details' => 'nullable|string', // Required for sell
        ]);

        $pool = P2PPool::where('asset', 'USDT')->firstOrFail();

        // Calculate rates based on type
        // If User Buys, they pay Fiat at Sell Rate. (Admin Sells)
        // If User Sells, they get Fiat at Buy Rate. (Admin Buys)

        $rate = match ($request->type) {
            'buy' => $pool->sell_rate,  // User buys at Admin's Sell Rate
            'sell' => $pool->buy_rate,  // User sells at Admin's Buy Rate
        };

        $fiatAmount = $request->amount_asset * $rate;
        $proofPath = null;

        if ($request->type === 'buy') {
            if (!$request->hasFile('proof_image')) {
                return back()->with('error', 'Payment proof is required for buy orders.');
            }
            $proofPath = $request->file('proof_image')->store('p2p-proofs', 'public');
        }

        if ($request->type === 'sell') {
            $request->validate([
                'bank_name' => 'required|string',
                'account_title' => 'required|string',
                'account_no' => 'required|string',
                'iban' => 'nullable|string',
            ]);

            $paymentDetails = "Bank: " . $request->bank_name . "\n" .
                "Title: " . $request->account_title . "\n" .
                "A/C: " . $request->account_no . "\n" .
                "IBAN: " . ($request->iban ?? 'N/A');
        }

        P2PTransaction::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'asset' => 'USDT',
            'fiat_currency' => 'PKR',
            'amount_asset' => $request->amount_asset,
            'amount_fiat' => $fiatAmount,
            'rate' => $rate,
            'status' => 'pending',
            'proof_image' => $proofPath,
            'user_payment_details' => $paymentDetails ?? null,
        ]);

        return back()->with('success', 'Order submitted successfully! Please wait for admin approval.');
    }
}
