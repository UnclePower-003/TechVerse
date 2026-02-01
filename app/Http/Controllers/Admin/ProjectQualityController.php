<?php

// app/Http/Controllers/Admin/ProjectQualityController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectQuality;
use Illuminate\Http\Request;

class ProjectQualityController extends Controller
{
    public function index()
    {
        $qualities = ProjectQuality::latest()->get();
        return view('admin.project-quality.index', compact('qualities'));
    }

    public function create()
    {
        $quality = null;
        return view('admin.project-quality.form', compact('quality'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'delay' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        ProjectQuality::create($data);

        return redirect()->route('project-quality.index')->with('success', 'Project Quality created.');
    }

    public function edit(ProjectQuality $projectQuality)
    {
        $quality = $projectQuality;
        return view('admin.project-quality.form', compact('quality'));
    }

    public function update(Request $request, ProjectQuality $projectQuality)
    {
        $data = $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'delay' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $projectQuality->update($data);

        return redirect()->route('project-quality.index')->with('success', 'Project Quality updated.');
    }

    public function destroy(ProjectQuality $projectQuality)
    {
        $projectQuality->delete();
        return back()->with('success', 'Project Quality deleted.');
    }
}
