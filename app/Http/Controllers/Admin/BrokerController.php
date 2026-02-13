<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broker;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brokers = Broker::all();
        return view('admin.brokers.index', compact('brokers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brokers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'referral_link' => 'required|url',
            'logo_path' => 'nullable|string', // Assuming direct link for now
            'description' => 'nullable|string',
            'is_recommended' => 'boolean',
        ]);

        Broker::create($validated);

        return redirect()->route('admin.brokers.index')
            ->with('success', 'Broker added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Broker $broker)
    {
        return view('admin.brokers.edit', compact('broker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Broker $broker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'referral_link' => 'required|url',
            'logo_path' => 'nullable|string',
            'description' => 'nullable|string',
            'is_recommended' => 'boolean',
        ]);

        // Handle checkbox unchecked
        if (!$request->has('is_recommended')) {
            $validated['is_recommended'] = false;
        }

        $broker->update($validated);

        return redirect()->route('admin.brokers.index')
            ->with('success', 'Broker updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Broker $broker)
    {
        $broker->delete();

        return redirect()->route('admin.brokers.index')
            ->with('success', 'Broker deleted successfully.');
    }
}
