<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social-links.form', ['link' => new SocialLink()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'required',
            'url' => 'required|url',
            'hover_color' => 'required',
            'order' => 'nullable|integer',
        ]);

        SocialLink::create($data);

        return redirect()->route('social-links.index');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.form', ['link' => $socialLink]);
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $request->validate([
            'icon' => 'required',
            'url' => 'required|url',
            'hover_color' => 'required',
            'order' => 'nullable|integer',
        ]);

        $socialLink->update($data);

        return redirect()->route('social-links.index');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return back();
    }
}
