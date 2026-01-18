<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeStat;
use Illuminate\Http\Request;

class HomeStatController extends Controller
{
    public function index()
    {
        $stats = HomeStat::orderBy('position')->get();
        return view('admin.home-stat.index', compact('stats'));
    }

    public function edit(HomeStat $homeStat)
    {
        $stat = $homeStat;
        return view('admin.home-stat.form', compact('stat'));
    }

    public function update(Request $request, HomeStat $homeStat)
    {
        $homeStat->update($request->only(['quantity', 'title', 'description']));

        return redirect()->route('home-stat.index')->with('success', 'Stat updated');
    }
}
