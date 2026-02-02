<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsHero;
use App\Models\ProductsHeader;
use App\Models\ContactInfo;
use App\Models\ProductRequirement;

class ProductsController extends Controller
{
    public function index()
    {
        $hero = ProductsHero::where('is_active', true)->latest()->first();

        $header = ProductsHeader::where('is_active', true)->latest()->first();

        $info = ContactInfo::where('is_active', true)->latest()->first();

        return view('frontend.pages.products', compact('hero', 'header', 'info'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone'     => 'required|string|max:30',
        'interest'  => 'required|string',
        'message'   => 'nullable|string',
    ]);

    ProductRequirement::create($validated);

    return response()->json([
        'status' => true,
        'message' => 'Your request has been submitted successfully!',
    ]);
}
}
