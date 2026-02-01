<?php

// app/Http/Controllers/Admin/ProductsHeroController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsHeroController extends Controller
{
    public function index()
    {
        $heroes = ProductsHero::latest()->get();
        return view('admin.products-hero.index', compact('heroes'));
    }

    public function create()
    {
        $hero = null;
        return view('admin.products-hero.form', compact('hero'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mobile_image' => 'nullable|image',
            'tablet_image' => 'nullable|image',
            'desktop_image' => 'nullable|image',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('products-hero', 'public');
            }
        }

        ProductsHero::create($data);

        return redirect()->route('products-hero.index')->with('success', 'Products Hero created.');
    }

    public function edit(ProductsHero $productsHero)
    {
        $hero = $productsHero;
        return view('admin.products-hero.form', compact('hero'));
    }

    public function update(Request $request, ProductsHero $productsHero)
    {
        $data = $request->validate([
            'mobile_image' => 'nullable|image',
            'tablet_image' => 'nullable|image',
            'desktop_image' => 'nullable|image',
            'is_active' => 'nullable|boolean',
        ]);

        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($productsHero->$field) {
                    Storage::disk('public')->delete($productsHero->$field);
                }
                $data[$field] = $request->file($field)->store('products-hero', 'public');
            }
        }

        $productsHero->update($data);

        return redirect()->route('products-hero.index')->with('success', 'Products Hero updated.');
    }

    public function destroy(ProductsHero $productsHero)
    {
        foreach (['mobile_image', 'tablet_image', 'desktop_image'] as $field) {
            if ($productsHero->$field) {
                Storage::disk('public')->delete($productsHero->$field);
            }
        }

        $productsHero->delete();
        return back()->with('success', 'Products Hero deleted.');
    }
}
