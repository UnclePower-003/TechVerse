<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $infos = ContactInfo::latest()->get();
        return view('admin.contact-info.index', compact('infos'));
    }

    public function create()
    {
        $info = null;
        return view('admin.contact-info.form', compact('info'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.icon' => 'required|string',
            'items.*.title' => 'required|string',
            'items.*.description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        ContactInfo::create($data);

        return redirect()->route('contact-info.index')->with('success', 'Contact info added');
    }

    public function edit(ContactInfo $contactInfo)
    {
        $info = $contactInfo;
        return view('admin.contact-info.form', compact('info'));
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.icon' => 'required|string',
            'items.*.title' => 'required|string',
            'items.*.description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        $contactInfo->update($data);

        return redirect()->route('contact-info.index')->with('success', 'Contact info updated');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();
        return back()->with('success', 'Contact info deleted');
    }
}
