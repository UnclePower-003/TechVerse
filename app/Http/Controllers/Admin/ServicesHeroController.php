<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesHeroController extends Controller
{
    public function index()
    {
        $heroes = ServicesHero::latest()->get();
        return view('admin.services-hero.index', compact('heroes'));
    }

    public function create()
    {
        $hero = null;
        return view('admin.services-hero.form', compact('hero'));
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
                $data[$field] = $request->file($field)->store('services-hero', 'public');
            }
        }

        ServicesHero::create($data);
        return redirect()->route('services-hero.index')->with('success', 'Hero created.');
    }

    public function edit(ServicesHero $servicesHero)
    {
        $hero = $servicesHero;
        return view('admin.services-hero.form', compact('hero'));
    }

    public function update(Request $request, ServicesHero $servicesHero)
    {
        $data = $request->validate([
            'mobile_image' => 'nullable|image',
            'tablet_image' => 'nullable|image',
            'desktop_image' => 'nullable|image',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($servicesHero->$field) {
                    Storage::disk('public')->delete($servicesHero->$field);
                }
                $data[$field] = $request->file($field)->store('services-hero', 'public');
            }
        }

        $servicesHero->update($data);
        return redirect()->route('services-hero.index')->with('success', 'Hero updated.');
    }

    public function destroy(ServicesHero $servicesHero)
    {
        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($servicesHero->$field) {
                Storage::disk('public')->delete($servicesHero->$field);
            }
        }
        $servicesHero->delete();
        return back()->with('success', 'Hero deleted.');
    }
}
