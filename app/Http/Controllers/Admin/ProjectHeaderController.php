<?php

// app/Http/Controllers/Admin/ProjectHeaderController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectHeader;
use Illuminate\Http\Request;

class ProjectHeaderController extends Controller
{
    public function index()
    {
        $headers = ProjectHeader::latest()->get();
        return view('admin.project-header.index', compact('headers'));
    }

    public function create()
    {
        $header = null;
        return view('admin.project-header.form', compact('header'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'small_title' => 'nullable|string',
            'main_title' => 'required|string',
            'description' => 'nullable|string',
            'badges' => 'nullable|array',
            'badges.*.icon' => 'required_with:badges|string',
            'badges.*.text' => 'required_with:badges|string',
            'badges.*.delay' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        ProjectHeader::create($data);

        return redirect()->route('project-header.index')->with('success', 'Project Header created.');
    }

    public function edit(ProjectHeader $projectHeader)
    {
        $header = $projectHeader;
        return view('admin.project-header.form', compact('header'));
    }

    public function update(Request $request, ProjectHeader $projectHeader)
    {
        $data = $request->validate([
            'small_title' => 'nullable|string',
            'main_title' => 'required|string',
            'description' => 'nullable|string',
            'badges' => 'nullable|array',
            'badges.*.icon' => 'required_with:badges|string',
            'badges.*.text' => 'required_with:badges|string',
            'badges.*.delay' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $projectHeader->update($data);

        return redirect()->route('project-header.index')->with('success', 'Project Header updated.');
    }

    public function destroy(ProjectHeader $projectHeader)
    {
        $projectHeader->delete();
        return back()->with('success', 'Project Header deleted.');
    }
}
