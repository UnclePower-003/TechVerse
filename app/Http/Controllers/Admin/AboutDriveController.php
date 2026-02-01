<?php

// app/Http/Controllers/Admin/AboutDriveController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutDrive;
use Illuminate\Http\Request;

class AboutDriveController extends Controller
{
    public function index()
    {
        $drives = AboutDrive::latest()->get();
        return view('admin.about-drive.index', compact('drives'));
    }

    public function create()
    {
        $drive = null;
        return view('admin.about-drive.form', compact('drive'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'points' => 'nullable|array',
            'points.*' => 'required_with:points|string',
            'is_active' => 'nullable|boolean',
        ]);

        AboutDrive::create($data);

        return redirect()->route('about-drive.index')->with('success', 'About Drive created.');
    }

    public function edit(AboutDrive $aboutDrive)
    {
        $drive = $aboutDrive;
        return view('admin.about-drive.form', compact('drive'));
    }

    public function update(Request $request, AboutDrive $aboutDrive)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'points' => 'nullable|array',
            'points.*' => 'required_with:points|string',
            'is_active' => 'nullable|boolean',
        ]);

        $aboutDrive->update($data);

        return redirect()->route('about-drive.index')->with('success', 'About Drive updated.');
    }

    public function destroy(AboutDrive $aboutDrive)
    {
        $aboutDrive->delete();
        return back()->with('success', 'About Drive deleted.');
    }
}
