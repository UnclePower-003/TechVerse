<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactHeroController extends Controller
{
    public function index()
    {
        $heroes = ContactHero::latest()->get();
        return view('admin.contact-hero.index', compact('heroes'));
    }

    public function create()
    {
        $hero = null;
        return view('admin.contact-hero.form', compact('hero'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image_mobile' => 'required|image',
            'image_tablet' => 'required|image',
            'image_desktop' => 'required|image',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['image_mobile', 'image_tablet', 'image_desktop'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('contact-hero', 'public');
            }
        }

        $data['is_active'] = $data['is_active'] ?? true;

        ContactHero::create($data);

        return redirect()->route('contact-hero.index')->with('success', 'Contact hero added');
    }

    public function edit(ContactHero $contactHero)
    {
        $hero = $contactHero;
        return view('admin.contact-hero.form', compact('hero'));
    }

    public function update(Request $request, ContactHero $contactHero)
    {
        $data = $request->validate([
            'image_mobile' => 'nullable|image',
            'image_tablet' => 'nullable|image',
            'image_desktop' => 'nullable|image',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['image_mobile', 'image_tablet', 'image_desktop'] as $field) {
            if ($request->hasFile($field)) {
                if ($contactHero->$field) {
                    Storage::disk('public')->delete($contactHero->$field);
                }
                $data[$field] = $request->file($field)->store('contact-hero', 'public');
            }
        }

        $data['is_active'] = $data['is_active'] ?? true;

        $contactHero->update($data);

        return redirect()->route('contact-hero.index')->with('success', 'Contact hero updated');
    }

    public function destroy(ContactHero $contactHero)
    {
        foreach (['image_mobile', 'image_tablet', 'image_desktop'] as $field) {
            if ($contactHero->$field) {
                Storage::disk('public')->delete($contactHero->$field);
            }
        }

        $contactHero->delete();
        return back()->with('success', 'Contact hero deleted');
    }
}
