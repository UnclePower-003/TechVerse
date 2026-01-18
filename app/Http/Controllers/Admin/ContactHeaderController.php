<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactHeader;
use Illuminate\Http\Request;

class ContactHeaderController extends Controller
{
    public function index()
    {
        $headers = ContactHeader::latest()->get();
        return view('admin.contact-header.index', compact('headers'));
    }

    public function create()
    {
        $header = null;
        return view('admin.contact-header.form', compact('header'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        ContactHeader::create($data);

        return redirect()->route('contact-header.index')->with('success', 'Contact header added');
    }

    public function edit(ContactHeader $contactHeader)
    {
        $header = $contactHeader;
        return view('admin.contact-header.form', compact('header'));
    }

    public function update(Request $request, ContactHeader $contactHeader)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        $contactHeader->update($data);

        return redirect()->route('contact-header.index')->with('success', 'Contact header updated');
    }

    public function destroy(ContactHeader $contactHeader)
    {
        $contactHeader->delete();
        return back()->with('success', 'Contact header deleted');
    }
}
