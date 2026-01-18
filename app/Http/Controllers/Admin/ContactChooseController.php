<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactChoose;
use Illuminate\Http\Request;

class ContactChooseController extends Controller
{
    public function index()
    {
        $cards = ContactChoose::orderBy('order')->get();
        return view('admin.contact-choose.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.contact-choose.form', ['card' => new ContactChoose()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        ContactChoose::create($data);

        return redirect()->route('contact-choose.index')->with('success', 'Card created successfully.');
    }

    public function edit(ContactChoose $contactChoose)
    {
        return view('admin.contact-choose.form', ['card' => $contactChoose]);
    }

    public function update(Request $request, ContactChoose $contactChoose)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $contactChoose->update($data);

        return redirect()->route('contact-choose.index')->with('success', 'Card updated successfully.');
    }

    public function destroy(ContactChoose $contactChoose)
    {
        $contactChoose->delete();
        return redirect()->route('contact-choose.index')->with('success', 'Card deleted successfully.');
    }
}
