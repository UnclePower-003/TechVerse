<?php

// app/Http/Controllers/Admin/ContactSubmissionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::latest()->get();
        return view('admin.contact-submission.index', compact('submissions'));
    }

    public function show(ContactSubmission $contactSubmission)
    {
        return view('admin.contact-submission.show', compact('contactSubmission'));
    }

    public function destroy(ContactSubmission $contactSubmission)
    {
        $contactSubmission->delete();

        return redirect()->route('contact-submission.index')->with('success', 'Submission deleted.');
    }

    public function markRead(ContactSubmission $contactSubmission)
    {
        $contactSubmission->update([
            'is_read' => true,
        ]);

        return back()->with('success', 'Marked as read.');
    }

    public function markUnread(ContactSubmission $contactSubmission)
    {
        $contactSubmission->update([
            'is_read' => false,
        ]);

        return back()->with('success', 'Marked as unread.');
    }
}
