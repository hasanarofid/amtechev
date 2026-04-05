<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactNotification;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactInquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'comment' => 'required|string',
        ]);

        $inquiry = ContactInquiry::create($validated);

        try {
            Mail::to('info@amtechev.com')->send(new ContactNotification($inquiry));
        } catch (\Exception $e) {
            // Log the error but continue to save the inquiry
            \Log::error('SMTP Error: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }
}
