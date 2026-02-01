<?php

// app/Http/Controllers/Admin/AboutHighlightController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHighlight;
use Illuminate\Http\Request;

class AboutHighlightController extends Controller
{
    public function index()
    {
        $highlights = AboutHighlight::orderBy('id','asc')->get();
        return view('admin.about-highlight.index', compact('highlights'));
    }

    public function create()
    {
        $highlight = null;
        return view('admin.about-highlight.form', compact('highlight'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        AboutHighlight::create($data);

        return redirect()->route('about-highlight.index')->with('success', 'Highlight created.');
    }

    public function edit(AboutHighlight $aboutHighlight)
    {
        $highlight = $aboutHighlight;
        return view('admin.about-highlight.form', compact('highlight'));
    }

    public function update(Request $request, AboutHighlight $aboutHighlight)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $aboutHighlight->update($data);

        return redirect()->route('about-highlight.index')->with('success', 'Highlight updated.');
    }

    public function destroy(AboutHighlight $aboutHighlight)
    {
        $aboutHighlight->delete();
        return back()->with('success', 'Highlight deleted.');
    }
}
