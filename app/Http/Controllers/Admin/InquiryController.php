<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ConsultationRequest;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.inquiries.messages', compact('messages'));
    }

    public function consultations()
    {
        $consultations = ConsultationRequest::latest()->paginate(20);
        return view('admin.inquiries.consultations', compact('consultations'));
    }

    public function destroyMessage($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return back()->with('success', 'Message deleted.');
    }

    public function destroyConsultation($id)
    {
        ConsultationRequest::findOrFail($id)->delete();
        return back()->with('success', 'Consultation request deleted.');
    }
}
