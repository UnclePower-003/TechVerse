<?php

// app/Http/Controllers/Admin/AboutHeroController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutHeroController extends Controller
{
    public function index()
    {
        $heroes = AboutHero::latest()->get();
        return view('admin.about-hero.index', compact('heroes'));
    }

    public function create()
    {
        $hero = null;
        return view('admin.about-hero.form', compact('hero'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mobile_image' => 'nullable|image|max:2048',
            'tablet_image' => 'nullable|image|max:2048',
            'desktop_image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('about-hero', 'public');
            }
        }

        AboutHero::create($data);

        return redirect()->route('about-hero.index')->with('success', 'About Hero created.');
    }

    public function edit(AboutHero $aboutHero)
    {
        $hero = $aboutHero;
        return view('admin.about-hero.form', compact('hero'));
    }

    public function update(Request $request, AboutHero $aboutHero)
    {
        $data = $request->validate([
            'mobile_image' => 'nullable|image|max:2048',
            'tablet_image' => 'nullable|image|max:2048',
            'desktop_image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($aboutHero->$field) {
                    Storage::disk('public')->delete($aboutHero->$field);
                }
                $data[$field] = $request->file($field)->store('about-hero', 'public');
            }
        }

        $aboutHero->update($data);

        return redirect()->route('about-hero.index')->with('success', 'About Hero updated.');
    }

    public function destroy(AboutHero $aboutHero)
    {
        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($aboutHero->$field) {
                Storage::disk('public')->delete($aboutHero->$field);
            }
        }

        $aboutHero->delete();

        return back()->with('success', 'About Hero deleted.');
    }
}
