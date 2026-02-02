<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added');
    }

    // app/Http/Controllers/Admin/CategoryController.php

    public function edit($id)
    {
        // Fetch the category by ID
        $category = Category::findOrFail($id);

        // Return the edit view with category data
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
{
    $category = Category::findOrFail($id);

    // Optional: check if category has products
    if ($category->products()->count() > 0) {
        return redirect()->route('categories.index')
            ->with('error', 'Cannot delete category with existing products.');
    }

    $category->delete();

    return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully.');
}
}
