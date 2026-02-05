<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServerCategory;
use App\Models\ServerComponent;
use App\Models\ServerConfiguration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ServerBuilderController extends Controller
{
    /**
     * Get all server component categories
     */
    public function getCategories()
    {
        try {
            $categories = ServerCategory::where('is_active', true)->orderBy('sort_order')->select('id', 'name', 'slug', 'required', 'description')->get();

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
     * Get components for a specific category
     */
    public function getComponents($categoryId)
    {
        try {
            $components = ServerComponent::where('category_id', $categoryId)->where('is_active', true)->orderBy('sort_order')->select('id', 'name', 'description', 'price', 'image_url', 'in_stock', 'specifications')->get();

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
     * Submit server configuration
     */
    public function submitConfiguration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selections' => 'required|array',
            'customer.customer_name' => 'required|string|max:255',
            'customer.customer_email' => 'required|email|max:255',
            'customer.customer_phone' => 'required|string|max:20',
            'customer.company_name' => 'nullable|string|max:255',
            'customer.notes' => 'nullable|string',
            'total' => 'required|numeric|min:0',
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
            DB::beginTransaction();

            // Create configuration record
            $configuration = ServerConfiguration::create([
                'customer_name' => $request->customer['customer_name'],
                'customer_email' => $request->customer['customer_email'],
                'customer_phone' => $request->customer['customer_phone'],
                'company_name' => $request->customer['company_name'] ?? null,
                'notes' => $request->customer['notes'] ?? null,
                'selections' => json_encode($request->selections),
                'total_price' => $request->total,
                'status' => 'pending',
            ]);

            // You can also create individual line items if needed
            foreach ($request->selections as $categoryId => $component) {
                $configuration->items()->create([
                    'category_id' => $categoryId,
                    'component_id' => $component['id'],
                    'component_name' => $component['name'],
                    'price' => $component['price'],
                ]);
            }

            DB::commit();

            // Send notification email (optional)
            // Mail::to($configuration->customer_email)->send(new ConfigurationReceived($configuration));
            // Mail::to(config('mail.admin_email'))->send(new NewConfigurationAlert($configuration));

            return response()->json([
                'success' => true,
                'message' => 'Configuration submitted successfully',
                'configuration_id' => $configuration->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to submit configuration',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Get a specific configuration (for admin or customer review)
     */
    public function getConfiguration($id)
    {
        try {
            $configuration = ServerConfiguration::with('items')->findOrFail($id);

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
}
