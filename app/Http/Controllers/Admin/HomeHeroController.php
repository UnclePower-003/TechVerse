<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeHeroController extends Controller
{
    public function index()
    {
        $heroes = HomeHero::latest()->get();
        return view('admin.home-hero.index', compact('heroes'));
    }

    public function create()
    {
        $hero = null;
        return view('admin.home-hero.form', compact('hero'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mobile_image' => 'nullable|image',
            'tablet_image' => 'nullable|image',
            'desktop_image' => 'nullable|image',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('home-hero', 'public');
            }
        }

        HomeHero::create($data);

        return redirect()->route('home-hero.index')->with('success', 'Home Hero created.');
    }

    public function edit(HomeHero $homeHero)
    {
        $hero = $homeHero;
        return view('admin.home-hero.form', compact('hero'));
    }

    public function update(Request $request, HomeHero $homeHero)
    {
        $data = $request->validate([
            'mobile_image' => 'nullable|image',
            'tablet_image' => 'nullable|image',
            'desktop_image' => 'nullable|image',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($homeHero->$field) {
                    Storage::disk('public')->delete($homeHero->$field);
                }
                $data[$field] = $request->file($field)->store('home-hero', 'public');
            }
        }

        $homeHero->update($data);

        return redirect()->route('home-hero.index')->with('success', 'Home Hero updated.');
    }

    public function destroy(HomeHero $homeHero)
    {
        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($homeHero->$field) {
                Storage::disk('public')->delete($homeHero->$field);
            }
        }

        $homeHero->delete();
        return back()->with('success', 'Home Hero deleted.');
    }
}
