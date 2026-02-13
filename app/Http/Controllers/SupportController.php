<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Logic to send email would go here.
        // Mail::to('admin@gsmtradinglab.com')->send(new ContactFormMail($request->all()));

        return back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
    }

    public function help()
    {
        return view('support.help');
    }
}
