<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultationRequest;

class ConsultationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'capital' => 'required|string',
        ]);

        \App\Models\ConsultationRequest::create($request->all());

        return back()->with('success', 'Consultation request received! We will contact you shortly.');
    }
}
