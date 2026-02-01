<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsHero;
use App\Models\ProductsHeader;

class ProductsController extends Controller
{
    public function index()
    {
        $hero = ProductsHero::where('is_active', true)->latest()->first();

        $header = ProductsHeader::where('is_active', true)->latest()->first();

        return view('frontend.pages.products', compact('hero', 'header'));
    }
}
