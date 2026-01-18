<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePartner;
use Illuminate\Http\Request;

class HomePartnerController extends Controller
{
    public function index()
    {
        $partners = HomePartner::orderBy('id', 'asc')->get();
        return view('admin.home-partners.index', compact('partners'));
    }

    public function create()
    {
        $partner = null;
        return view('admin.home-partners.form', compact('partner'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'name' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        HomePartner::create($data);

        return redirect()->route('home-partners.index')->with('success', 'Partner added');
    }

    public function edit(HomePartner $homePartner)
    {
        $partner = $homePartner;
        return view('admin.home-partners.form', compact('partner'));
    }

    public function update(Request $request, HomePartner $homePartner)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'name' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        $homePartner->update($data);

        return redirect()->route('home-partners.index')->with('success', 'Partner updated');
    }

    public function destroy(HomePartner $homePartner)
    {
        $homePartner->delete();
        return back()->with('success', 'Partner deleted');
    }
}
