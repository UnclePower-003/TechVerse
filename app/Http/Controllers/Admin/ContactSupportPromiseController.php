<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSupportPromise;
use Illuminate\Http\Request;

class ContactSupportPromiseController extends Controller
{
    public function index()
    {
        $promises = ContactSupportPromise::latest()->get();
        return view('admin.contact-support-promise.index', compact('promises'));
    }

    public function create()
    {
        $promise = null;
        return view('admin.contact-support-promise.form', compact('promise'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'promises' => 'required|array',
            'promises.*' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        ContactSupportPromise::create($data);

        return redirect()->route('contact-support-promise.index')->with('success', 'Support promises added');
    }

    public function edit(ContactSupportPromise $contactSupportPromise)
    {
        $promise = $contactSupportPromise;
        return view('admin.contact-support-promise.form', compact('promise'));
    }

    public function update(Request $request, ContactSupportPromise $contactSupportPromise)
    {
        $data = $request->validate([
            'promises' => 'required|array',
            'promises.*' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        $contactSupportPromise->update($data);

        return redirect()->route('contact-support-promise.index')->with('success', 'Support promises updated');
    }

    public function destroy(ContactSupportPromise $contactSupportPromise)
    {
        $contactSupportPromise->delete();
        return back()->with('success', 'Support promises deleted');
    }
}
