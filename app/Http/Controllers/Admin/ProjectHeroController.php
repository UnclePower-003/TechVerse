<?php

// app/Http/Controllers/Admin/ProjectHeroController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectHeroController extends Controller
{
    public function index()
    {
        $heroes = ProjectHero::latest()->get();
        return view('admin.project-hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.project-hero.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('project-hero', 'public');

        ProjectHero::create([
            'title' => $request->title,
            'image' => $path,
            'is_active' => $request->is_active ?? 0,
        ]);

        return redirect()->route('project-hero.index')->with('success', 'Hero created');
    }

    public function edit(ProjectHero $projectHero)
    {
        return view('admin.project-hero.form', compact('projectHero'));
    }

    public function update(Request $request, ProjectHero $projectHero)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($projectHero->image);
            $projectHero->image = $request->file('image')->store('project-hero', 'public');
        }

        $projectHero->update([
            'title' => $request->title,
            'is_active' => $request->is_active ?? 0,
        ]);

        return redirect()->route('project-hero.index')->with('success', 'Hero updated');
    }

    public function destroy(ProjectHero $projectHero)
    {
        Storage::disk('public')->delete($projectHero->image);
        $projectHero->delete();

        return back()->with('success', 'Hero deleted');
    }
}
