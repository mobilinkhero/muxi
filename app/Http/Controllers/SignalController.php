<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Signal;

class SignalController extends Controller
{
    // Admin: List all signals
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $signals = Signal::orderBy('created_at', 'desc')->get();
        return view('admin.signals.index', compact('signals'));
    }

    // Admin: Show create form
    public function create()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        return view('admin.signals.create');
    }

    // Admin: Store new signal
    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return abort(403);
        }

        $request->validate([
            'symbol' => 'required|string|uppercase',
            'type' => 'required|in:BUY,SELL',
            'entry_price' => 'required|string',
            'stop_loss' => 'required|string',
            'take_profit_1' => 'required|string',
        ]);

        $data = $request->all();
        $data['status'] = 'active'; // Default to active

        Signal::create($data);

        return redirect()->route('admin.signals.index')->with('success', 'Signal posted successfully!');
    }

    // Admin: Show edit form
    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        $signal = Signal::findOrFail($id);
        return view('admin.signals.edit', compact('signal'));
    }

    // Admin: Update signal
    public function update(Request $request, $id)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return abort(403);
        }

        $request->validate([
            'symbol' => 'required|string|uppercase',
            'status' => 'required|in:active,closed,cancelled',
            'result' => 'nullable|in:profit,loss,breakeven',
        ]);

        $signal = Signal::findOrFail($id);
        $signal->update($request->all());

        return redirect()->route('admin.signals.index')->with('success', 'Signal updated successfully!');
    }

    // Admin: Delete signal
    public function destroy($id)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return abort(403);
        }

        Signal::destroy($id);
        return back()->with('success', 'Signal deleted.');
    }
}
