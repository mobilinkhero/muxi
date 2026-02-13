<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class SupportController extends Controller
{
    public function contact()
    {
        return view('support.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactMessage::create($request->all());

        return back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
    }

    public function help()
    {
        return view('support.help');
    }
}
