<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Show form to create a new project
    public function create()
    {
        return view('admin.projects.create');
    }

    // Store a new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'badge' => 'nullable|string|max:50',
            'overview' => 'required|string',
            'project_specifications' => 'required|array',
            'project_specifications.*.title' => 'required|string|max:255',
            'project_specifications.*.description' => 'required|string',
            'completion' => 'required|string|max:255',
            'key_features' => 'required|array',
            'key_features.*' => 'required|string|max:255',
            'technical_details' => 'required|string',
            'quote' => 'nullable|string',
            'quote_author' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('projects.create')->with('success', 'Project added successfully!');
    }

    // INDEX - List all projects
    public function index()
    {
        $projects = Project::orderBy('id', 'asc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    // SHOW - Display a single project
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    // EDIT - Show edit form
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    // UPDATE - Update project
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'badge' => 'nullable|string|max:50',
            'overview' => 'required|string',
            'project_specifications' => 'required|array',
            'project_specifications.*.title' => 'required|string|max:255',
            'project_specifications.*.description' => 'required|string',
            'completion' => 'required|string|max:255',
            'key_features' => 'required|array',
            'key_features.*' => 'required|string|max:255',
            'technical_details' => 'required|string',
            'quote' => 'nullable|string',
            'quote_author' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('projects.edit', $project)->with('success', 'Project updated successfully!');
    }

    // DESTROY - Delete project
    public function destroy(Project $project)
    {
        // Delete image
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}
