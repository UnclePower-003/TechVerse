<?php

// app/Http/Controllers/Admin/AboutHeaderController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHeader;
use Illuminate\Http\Request;

class AboutHeaderController extends Controller
{
    public function index()
    {
        $headers = AboutHeader::latest()->get();
        return view('admin.about-header.index', compact('headers'));
    }

    public function create()
    {
        $header = null;
        return view('admin.about-header.form', compact('header'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'badge_text' => 'nullable|string',
            'badge_icon' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        AboutHeader::create($data);

        return redirect()->route('about-header.index')->with('success', 'About Header created.');
    }

    public function edit(AboutHeader $aboutHeader)
    {
        $header = $aboutHeader;
        return view('admin.about-header.form', compact('header'));
    }

    public function update(Request $request, AboutHeader $aboutHeader)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'badge_text' => 'nullable|string',
            'badge_icon' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $aboutHeader->update($data);

        return redirect()->route('about-header.index')->with('success', 'About Header updated.');
    }

    public function destroy(AboutHeader $aboutHeader)
    {
        $aboutHeader->delete();
        return back()->with('success', 'About Header deleted.');
    }
}
