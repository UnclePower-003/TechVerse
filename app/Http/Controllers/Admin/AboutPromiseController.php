<?php

// app/Http/Controllers/Admin/AboutPromiseController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPromise;
use Illuminate\Http\Request;

class AboutPromiseController extends Controller
{
    public function index()
    {
        $promises = AboutPromise::orderBy('is_active')->get();
        return view('admin.about-promise.index', compact('promises'));
    }

    public function create()
    {
        $promise = null;
        return view('admin.about-promise.form', compact('promise'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        AboutPromise::create($data);

        return redirect()->route('about-promise.index')->with('success', 'Promise created.');
    }

    public function edit(AboutPromise $aboutPromise)
    {
        $promise = $aboutPromise;
        return view('admin.about-promise.form', compact('promise'));
    }

    public function update(Request $request, AboutPromise $aboutPromise)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $aboutPromise->update($data);

        return redirect()->route('about-promise.index')->with('success', 'Promise updated.');
    }

    public function destroy(AboutPromise $aboutPromise)
    {
        $aboutPromise->delete();
        return back()->with('success', 'Promise deleted.');
    }
}
