<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePick;
use Illuminate\Http\Request;

class ServicePickController extends Controller
{
    public function index()
    {
        $items = ServicePick::orderBy('order')->get();
        return view('admin.service-pick.index', compact('items'));
    }

    public function create()
    {
        return view('admin.service-pick.form', ['item' => new ServicePick()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'icon' => 'required',
            'description' => 'required',
            'order' => 'nullable|integer',
        ]);

        ServicePick::create($data);

        return redirect()->route('service-pick.index')->with('success', 'Created successfully');
    }

    public function edit(ServicePick $servicePick)
    {
        return view('admin.service-pick.form', ['item' => $servicePick]);
    }

    public function update(Request $request, ServicePick $servicePick)
    {
        $data = $request->validate([
            'title' => 'required',
            'icon' => 'required',
            'description' => 'required',
            'order' => 'nullable|integer',
        ]);

        $servicePick->update($data);

        return redirect()->route('service-pick.index')->with('success', 'Updated successfully');
    }

    public function destroy(ServicePick $servicePick)
    {
        $servicePick->delete();
        return back()->with('success', 'Deleted successfully');
    }
}
