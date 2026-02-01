<?php

// app/Http/Controllers/Admin/AboutExpertiseController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutExpertise;
use Illuminate\Http\Request;

class AboutExpertiseController extends Controller
{
    public function index()
    {
        $expertises = AboutExpertise::latest()->get();
        return view('admin.about-expertise.index', compact('expertises'));
    }

    public function create()
    {
        $expertise = null;
        return view('admin.about-expertise.form', compact('expertise'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.label' => 'required_with:items|string',
            'items.*.icon' => 'required_with:items|string',
            'is_active' => 'nullable|boolean',
        ]);

        AboutExpertise::create($data);

        return redirect()->route('about-expertise.index')->with('success', 'Expertise section created.');
    }

    public function edit(AboutExpertise $aboutExpertise)
    {
        $expertise = $aboutExpertise;
        return view('admin.about-expertise.form', compact('expertise'));
    }

    public function update(Request $request, AboutExpertise $aboutExpertise)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.label' => 'required_with:items|string',
            'items.*.icon' => 'required_with:items|string',
            'is_active' => 'nullable|boolean',
        ]);

        $aboutExpertise->update($data);

        return redirect()->route('about-expertise.index')->with('success', 'Expertise section updated.');
    }

    public function destroy(AboutExpertise $aboutExpertise)
    {
        $aboutExpertise->delete();
        return back()->with('success', 'Expertise section deleted.');
    }
}
