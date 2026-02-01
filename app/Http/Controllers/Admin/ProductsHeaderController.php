<?php

// app/Http/Controllers/Admin/ProductsHeaderController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsHeader;
use Illuminate\Http\Request;

class ProductsHeaderController extends Controller
{
    public function index()
    {
        $headers = ProductsHeader::latest()->get();
        return view('admin.products-header.index', compact('headers'));
    }

    public function create()
    {
        $header = null;
        return view('admin.products-header.form', compact('header'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        ProductsHeader::create($data);

        return redirect()->route('products-header.index')->with('success', 'Products header created.');
    }

    public function edit(ProductsHeader $productsHeader)
    {
        $header = $productsHeader;
        return view('admin.products-header.form', compact('header'));
    }

    public function update(Request $request, ProductsHeader $productsHeader)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $productsHeader->update($data);

        return redirect()->route('products-header.index')->with('success', 'Products header updated.');
    }

    public function destroy(ProductsHeader $productsHeader)
    {
        $productsHeader->delete();

        return back()->with('success', 'Products header deleted.');
    }
}
