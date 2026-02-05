<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServerCategory;
use App\Models\ServerComponent;
use App\Models\ServerConfiguration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminServerBuilderController extends Controller
{
    // ==================== CATEGORIES ====================

    /**
     * Get all categories (including inactive)
     */
    public function getCategoriesAdmin()
    {
        try {
            $categories = ServerCategory::orderBy('sort_order')->get();

            return response()->json([
                'success' => true,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to load categories',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Create a new category
     */
    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:server_categories,slug',
            'description' => 'nullable|string',
            'required' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $category = ServerCategory::create($request->all());

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Category created successfully',
                    'category' => $category,
                ],
                201,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to create category',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Update a category
     */
    public function updateCategory(Request $request, $id)
    {
        $category = ServerCategory::find($id);

        if (!$category) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Category not found',
                ],
                404,
            );
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:server_categories,slug,' . $id,
            'description' => 'nullable|string',
            'required' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $category->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'category' => $category,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update category',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Delete a category
     */
    public function deleteCategory($id)
    {
        try {
            $category = ServerCategory::find($id);

            if (!$category) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Category not found',
                    ],
                    404,
                );
            }

            // Check if category has components
            if ($category->components()->count() > 0) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Cannot delete category with existing components. Please delete or reassign components first.',
                    ],
                    400,
                );
            }

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to delete category',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    // ==================== COMPONENTS ====================

    /**
     * Get all components (including inactive)
     */
    public function getComponentsAdmin()
    {
        try {
            $components = ServerComponent::with('category')->orderBy('category_id')->orderBy('sort_order')->get();

            return response()->json([
                'success' => true,
                'components' => $components,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to load components',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Create a new component
     */
    public function storeComponent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:server_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'in_stock' => 'boolean',
            'specifications' => 'nullable|array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $component = ServerComponent::create($request->all());

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Component created successfully',
                    'component' => $component,
                ],
                201,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to create component',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Update a component
     */
    public function updateComponent(Request $request, $id)
    {
        $component = ServerComponent::find($id);

        if (!$component) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Component not found',
                ],
                404,
            );
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:server_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'in_stock' => 'boolean',
            'specifications' => 'nullable|array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $component->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Component updated successfully',
                'component' => $component,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update component',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Delete a component
     */
    public function deleteComponent($id)
    {
        try {
            $component = ServerComponent::find($id);

            if (!$component) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Component not found',
                    ],
                    404,
                );
            }

            $component->delete();

            return response()->json([
                'success' => true,
                'message' => 'Component deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to delete component',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    // ==================== CONFIGURATIONS ====================

    /**
     * Get all configurations
     */
    public function getConfigurationsAdmin()
    {
        try {
            $configurations = ServerConfiguration::orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'configurations' => $configurations,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to load configurations',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Get a specific configuration with details
     */
    public function getConfigurationAdmin($id)
    {
        try {
            $configuration = ServerConfiguration::with('items.category', 'items.component')->findOrFail($id);

            return response()->json([
                'success' => true,
                'configuration' => $configuration,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Configuration not found',
                ],
                404,
            );
        }
    }

    /**
     * Update configuration status
     */
    public function updateConfigurationStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,reviewed,quoted,approved,rejected,completed',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid status',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $configuration = ServerConfiguration::findOrFail($id);
            $configuration->status = $request->status;
            $configuration->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'configuration' => $configuration,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update status',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Delete a configuration
     */
    public function deleteConfiguration($id)
    {
        try {
            $configuration = ServerConfiguration::findOrFail($id);
            $configuration->delete();

            return response()->json([
                'success' => true,
                'message' => 'Configuration deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to delete configuration',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    // ==================== BULK OPERATIONS ====================

    /**
     * Bulk update component status
     */
    public function bulkUpdateComponents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'component_ids' => 'required|array',
            'component_ids.*' => 'exists:server_components,id',
            'action' => 'required|in:activate,deactivate,in_stock,out_of_stock,delete',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        try {
            $componentIds = $request->component_ids;
            $action = $request->action;

            switch ($action) {
                case 'activate':
                    ServerComponent::whereIn('id', $componentIds)->update(['is_active' => true]);
                    break;
                case 'deactivate':
                    ServerComponent::whereIn('id', $componentIds)->update(['is_active' => false]);
                    break;
                case 'in_stock':
                    ServerComponent::whereIn('id', $componentIds)->update(['in_stock' => true]);
                    break;
                case 'out_of_stock':
                    ServerComponent::whereIn('id', $componentIds)->update(['in_stock' => false]);
                    break;
                case 'delete':
                    ServerComponent::whereIn('id', $componentIds)->delete();
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => 'Bulk operation completed successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Bulk operation failed',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    // ==================== STATISTICS ====================

    /**
     * Get dashboard statistics
     */
    public function getStatistics()
    {
        try {
            $stats = [
                'total_categories' => ServerCategory::count(),
                'active_categories' => ServerCategory::where('is_active', true)->count(),
                'total_components' => ServerComponent::count(),
                'active_components' => ServerComponent::where('is_active', true)->count(),
                'in_stock_components' => ServerComponent::where('in_stock', true)->count(),
                'total_configurations' => ServerConfiguration::count(),
                'pending_configurations' => ServerConfiguration::where('status', 'pending')->count(),
                'completed_configurations' => ServerConfiguration::where('status', 'completed')->count(),
                'total_revenue' => ServerConfiguration::where('status', 'completed')->sum('total_price'),
                'pending_revenue' => ServerConfiguration::whereIn('status', ['pending', 'reviewed', 'quoted', 'approved'])->sum('total_price'),
            ];

            return response()->json([
                'success' => true,
                'statistics' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to load statistics',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
