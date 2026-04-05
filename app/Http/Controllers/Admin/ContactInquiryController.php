<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToInquiry;

class ContactInquiryController extends Controller
{
    public function index()
    {
        $inquiries = ContactInquiry::latest()->get();
        return view('admin.contact-inquiries.index', compact('inquiries'));
    }

    public function show(ContactInquiry $contact_inquiry)
    {
        if ($contact_inquiry->status === 'pending') {
            $contact_inquiry->update(['status' => 'read']);
        }
        return view('admin.contact-inquiries.show', compact('contact_inquiry'));
    }

    public function reply(Request $request, ContactInquiry $contact_inquiry)
    {
        $validated = $request->validate([
            'reply_message' => 'required|string',
        ]);

        // Send Email
        Mail::to($contact_inquiry->email)->send(new ReplyToInquiry($contact_inquiry, $validated['reply_message']));

        // Update Database
        $contact_inquiry->update([
            'reply_content' => $validated['reply_message'],
            'replied_at' => now(),
            'status' => 'read', // Ensure it's marked as read
        ]);

        return redirect()->route('admin.contact-inquiries.show', $contact_inquiry)->with('success', 'Reply sent successfully!');
    }

    public function destroy(ContactInquiry $contact_inquiry)
    {
        $contact_inquiry->delete();
        return redirect()->route('admin.contact-inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
