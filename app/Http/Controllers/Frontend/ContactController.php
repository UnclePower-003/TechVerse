<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactHero;
use App\Models\ContactHeader;
use App\Models\ContactInfo;
use App\Models\ContactSupportPromise;
use App\Models\ContactChoose;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $hero = ContactHero::where('is_active', true)->latest()->first();

        $header = ContactHeader::where('is_active', true)->latest()->first();

        $info = ContactInfo::where('is_active', true)->latest()->first();

        $promise = ContactSupportPromise::where('is_active', true)->latest()->first();

        $cards = ContactChoose::orderBy('order')->get();

        return view('frontend.pages.contact', compact('hero', 'header', 'info', 'promise', 'cards'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'required|email|max:255',
            'inquiry_type' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactSubmission::create($data);

        return back()->with('success', 'Your inquiry has been sent successfully!');
    }
}
