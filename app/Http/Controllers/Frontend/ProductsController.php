<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsHero;
use App\Models\ProductsHeader;
use App\Models\ContactInfo;
use App\Models\ProductRequirement;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $hero = ProductsHero::where('is_active', true)->latest()->first();

        $header = ProductsHeader::where('is_active', true)->latest()->first();

        $info = ContactInfo::where('is_active', true)->latest()->first();

        $categories = Category::withCount('products')->get();

        $products = Product::with('category')
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'category' => $product->category->slug,
                    'model' => $product->model,
                    'title' => $product->title,
                    'price' => $product->price,
                    'image' => asset($product->image),
                    'badge' => [
                        'text' => $product->badge_text,
                        'color' => $product->badge_color,
                    ],
                    'specs' => $product->specs ?? [],
                ];
            });

        return view('frontend.pages.products', compact('hero', 'header', 'info', 'categories', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'interest' => 'required|string',
            'message' => 'nullable|string',
        ]);

        ProductRequirement::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Your request has been submitted successfully!',
        ]);
    }
}
