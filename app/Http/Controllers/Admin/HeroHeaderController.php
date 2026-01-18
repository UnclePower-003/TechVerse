<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroHeader;
use Illuminate\Http\Request;

class HeroHeaderController extends Controller
{
    public function index()
    {
        $headers = HeroHeader::latest()->get();
        return view('admin.hero-header.index', compact('headers'));
    }

    public function create()
    {
        $header = null;
        return view('admin.hero-header.form', compact('header'));
    }

    public function store(Request $request)
    {
        HeroHeader::create($request->all());
        return redirect()->route('hero-header.index')->with('success', 'Hero Header created');
    }

    public function edit(HeroHeader $heroHeader)
    {
        $header = $heroHeader;
        return view('admin.hero-header.form', compact('header'));
    }

    public function update(Request $request, HeroHeader $heroHeader)
    {
        $heroHeader->update($request->all());
        return redirect()->route('hero-header.index')->with('success', 'Hero Header updated');
    }

    public function destroy(HeroHeader $heroHeader)
    {
        $heroHeader->delete();
        return back()->with('success', 'Hero Header deleted');
    }
}
