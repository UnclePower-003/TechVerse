<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceList;
use Illuminate\Http\Request;

class ServiceListController extends Controller
{
    public function index()
    {
        $services = ServiceList::orderBy('id', 'asc')->get();
        return view('admin.service-list.index', compact('services'));
    }

    public function create()
    {
        $service = null;
        return view('admin.service-list.form', compact('service'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
            'animation_delay' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['tags'] = $data['tags'] ?? [];
        ServiceList::create($data);

        return redirect()->route('service-list.index')->with('success', 'Service created');
    }

    public function edit(ServiceList $serviceList)
    {
        $service = $serviceList;
        return view('admin.service-list.form', compact('service'));
    }

    public function update(Request $request, ServiceList $serviceList)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
            'animation_delay' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data['tags'] = $data['tags'] ?? [];
        $serviceList->update($data);

        return redirect()->route('service-list.index')->with('success', 'Service updated');
    }

    public function destroy(ServiceList $serviceList)
    {
        $serviceList->delete();
        return back()->with('success', 'Service deleted');
    }
}
