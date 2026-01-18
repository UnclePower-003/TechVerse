<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceHeader;
use Illuminate\Http\Request;

class ServiceHeaderController extends Controller
{
    public function index()
    {
        $headers = ServiceHeader::latest()->get();
        return view('admin.service-header.index', compact('headers'));
    }

    public function create()
    {
        $header = null;
        return view('admin.service-header.form', compact('header'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'badge_text' => 'nullable|string',
            'heading_main' => 'nullable|string',
            'heading_gradient' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*.icon' => 'nullable|string',
            'features.*.text' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if (isset($data['features'])) {
            $data['features'] = json_encode($data['features']);
        }

        ServiceHeader::create($data);

        return redirect()->route('service-header.index')->with('success', 'Service Header created');
    }

    public function edit(ServiceHeader $serviceHeader)
    {
        $header = $serviceHeader;
        return view('admin.service-header.form', compact('header'));
    }

    public function update(Request $request, ServiceHeader $serviceHeader)
    {
        $data = $request->validate([
            'badge_text' => 'nullable|string',
            'heading_main' => 'nullable|string',
            'heading_gradient' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*.icon' => 'nullable|string',
            'features.*.text' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if (isset($data['features'])) {
            $data['features'] = json_encode($data['features']);
        }

        $serviceHeader->update($data);

        return redirect()->route('service-header.index')->with('success', 'Service Header updated');
    }

    public function destroy(ServiceHeader $serviceHeader)
    {
        $serviceHeader->delete();
        return back()->with('success', 'Service Header deleted');
    }
}
