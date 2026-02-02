<?php

// app/Http/Controllers/Admin/ProductRequirementController.php

// app/Http/Controllers/Admin/ProductRequirementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductRequirement;

class ProductRequirementController extends Controller
{
    public function index()
    {
        $submissions = ProductRequirement::latest()->paginate(10);
        return view('admin.product-requirements.index', compact('submissions'));
    }

    public function show(ProductRequirement $productRequirement)
    {
        return view('admin.product-requirements.show', compact('productRequirement'));
    }

    public function markRead(ProductRequirement $productRequirement)
    {
        $productRequirement->update(['is_read' => true]);
        return back();
    }

    public function markUnread(ProductRequirement $productRequirement)
    {
        $productRequirement->update(['is_read' => false]);
        return back();
    }

    public function destroy(ProductRequirement $productRequirement)
    {
        $productRequirement->delete();
        return redirect()
            ->route('product-requirements.index')
            ->with('success', 'Submission deleted successfully.');
    }
}
