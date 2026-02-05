@extends('admin.layouts.app')

{{-- FIXED: Changed from @push('style') to @push('styles') --}}
@push('styles')
    <style>
        .tab-active {
            border-bottom: 3px solid #2E86DE;
            color: #2E86DE;
        }

        .modal {
            display: none;
        }

        .modal.active {
            display: flex;
        }

        .spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #2E86DE;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .table-hover tbody tr:hover {
            background-color: #f9fafb;
        }

        /* FIXED: Add components grid styles */
        .components-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .components-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .components-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .components-grid.hidden {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-server mr-2 text-primary"></i> Server Builder Admin
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage server components and configurations</p>
            </div>
        </div>

        {{-- Tabs Navigation --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button onclick="switchTab('categories')" id="tab-categories"
                        class="tab-active py-4 px-1 font-semibold text-sm border-b-3 transition">
                        Categories
                    </button>
                    <button onclick="switchTab('components')" id="tab-components"
                        class="py-4 px-1 font-semibold text-sm text-gray-500 hover:text-gray-700 border-b-3 border-transparent transition">
                        Components
                    </button>
                    <button onclick="switchTab('configurations')" id="tab-configurations"
                        class="py-4 px-1 font-semibold text-sm text-gray-500 hover:text-gray-700 border-b-3 border-transparent transition">
                        Configurations
                    </button>
                </nav>
            </div>
        </div>

        {{-- Categories Tab --}}
        <div id="content-categories" class="tab-content">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Component Categories</h2>
                    <button onclick="openCategoryModal()"
                        class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 transition shadow-lg shadow-blue-100 transform active:scale-95">
                        <i class="fas fa-plus"></i>
                        Add Category
                    </button>
                </div>
                <div class="p-6">
                    <div id="categories-loading" class="text-center py-12">
                        <div class="spinner mx-auto mb-4"></div>
                        <p class="text-gray-500">Loading categories...</p>
                    </div>
                    <div id="categories-table" class="hidden overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 table-hover">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Required</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Sort Order</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="categories-tbody" class="bg-white divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                    {{-- Empty state --}}
                    <div id="categories-empty" class="hidden text-center py-12">
                        <i class="fas fa-folder-open text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No categories found. Add your first category!</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Components Tab --}}
        <div id="content-components" class="tab-content hidden">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200">
                <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Server Components</h2>
                        <p class="text-sm text-gray-500 mt-1">Manage all server hardware components</p>
                    </div>
                    <div class="flex gap-3 w-full sm:w-auto">
                        <select id="filter-category" onchange="filterComponents()"
                            class="flex-1 sm:flex-none border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200">
                            <option value="">All Categories</option>
                        </select>
                        <button onclick="openComponentModal()"
                            class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 transition shadow-lg shadow-blue-100 transform active:scale-95 whitespace-nowrap">
                            <i class="fas fa-plus"></i>
                            Add Component
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div id="components-loading" class="text-center py-12">
                        <div class="spinner mx-auto mb-4"></div>
                        <p class="text-gray-500">Loading components...</p>
                    </div>
                    {{-- FIXED: Changed from grid classes to custom class --}}
                    <div id="components-grid" class="components-grid hidden"></div>
                    {{-- Empty state --}}
                    <div id="components-empty" class="hidden text-center py-12">
                        <i class="fas fa-microchip text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No components found. Add your first component!</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Configurations Tab --}}
        <div id="content-configurations" class="tab-content hidden">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Customer Configurations</h2>
                    <p class="text-sm text-gray-500 mt-1">View and manage submitted server configurations</p>
                </div>
                <div class="p-6">
                    <div id="configurations-loading" class="text-center py-12">
                        <div class="spinner mx-auto mb-4"></div>
                        <p class="text-gray-500">Loading configurations...</p>
                    </div>
                    <div id="configurations-table" class="hidden overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 table-hover">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contact</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="configurations-tbody" class="bg-white divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                    {{-- Empty state --}}
                    <div id="configurations-empty" class="hidden text-center py-12">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No configurations submitted yet.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Category Modal --}}
        <div id="category-modal" class="modal fixed inset-0 z-50 overflow-y-auto items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 my-8">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 id="category-modal-title" class="text-xl font-bold text-gray-800">Add Category</h3>
                    <button type="button" onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="category-form" onsubmit="saveCategory(event)">
                    <div class="p-6 space-y-4">
                        <input type="hidden" id="category-id">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Name <span class="text-red-500">*</span></label>
                            <input type="text" id="category-name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Slug <span class="text-red-500">*</span></label>
                            <input type="text" id="category-slug" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                            <p class="text-xs text-gray-400 mt-1">URL-friendly identifier (e.g., processor, ram)</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Description</label>
                            <textarea id="category-description" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Sort Order</label>
                            <input type="number" id="category-sort" value="0"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                        </div>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="category-required" class="w-4 h-4 text-primary rounded focus:ring-blue-200">
                                <span class="text-sm font-semibold text-gray-700">Required</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="category-active" checked class="w-4 h-4 text-primary rounded focus:ring-blue-200">
                                <span class="text-sm font-semibold text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" onclick="closeCategoryModal()"
                            class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button type="submit" id="category-submit-btn"
                            class="px-8 py-3 rounded-xl bg-primary text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all transform active:scale-95">
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Component Modal --}}
        <div id="component-modal" class="modal fixed inset-0 z-50 overflow-y-auto items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 my-8">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 id="component-modal-title" class="text-xl font-bold text-gray-800">Add Component</h3>
                    <button type="button" onclick="closeComponentModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="component-form" onsubmit="saveComponent(event)">
                    <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                        <input type="hidden" id="component-id">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Category <span class="text-red-500">*</span></label>
                                <select id="component-category" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Price (Rs) <span class="text-red-500">*</span></label>
                                <input type="number" id="component-price" step="0.01" min="0" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Name <span class="text-red-500">*</span></label>
                            <input type="text" id="component-name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Description</label>
                            <textarea id="component-description" rows="2"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Image URL</label>
                            <input type="url" id="component-image"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                            <p class="text-xs text-gray-400 mt-1">Full URL to the component image</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Specifications (JSON)</label>
                            <textarea id="component-specs" rows="4" placeholder='{"cores": 16, "threads": 32}'
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary font-mono text-sm"></textarea>
                            <p class="text-xs text-gray-400 mt-1">Valid JSON format for technical specifications</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Sort Order</label>
                            <input type="number" id="component-sort" value="0"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-primary">
                        </div>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="component-stock" checked class="w-4 h-4 text-primary rounded focus:ring-blue-200">
                                <span class="text-sm font-semibold text-gray-700">In Stock</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" id="component-active" checked class="w-4 h-4 text-primary rounded focus:ring-blue-200">
                                <span class="text-sm font-semibold text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" onclick="closeComponentModal()"
                            class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button type="submit" id="component-submit-btn"
                            class="px-8 py-3 rounded-xl bg-primary text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all transform active:scale-95">
                            Save Component
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Configuration Detail Modal --}}
        <div id="config-modal" class="modal fixed inset-0 z-50 overflow-y-auto items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 my-8">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Configuration Details</h3>
                    <button onclick="closeConfigModal()" class="text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="config-detail" class="p-6 max-h-[70vh] overflow-y-auto"></div>
            </div>
        </div>

        {{-- Status Update Modal --}}
        <div id="status-modal" class="modal fixed inset-0 z-50 overflow-y-auto items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Update Status</h3>
                    <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="status-form" onsubmit="submitStatusUpdate(event)">
                    <input type="hidden" id="status-config-id">
                    <div class="p-6">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest mb-2">Select Status</label>
                        <select id="status-select" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200">
                            <option value="pending">Pending</option>
                            <option value="reviewed">Reviewed</option>
                            <option value="quoted">Quoted</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" onclick="closeStatusModal()"
                            class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-8 py-3 rounded-xl bg-primary text-white font-bold hover:bg-blue-700 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const API_BASE = "{{ route('api.admin.server-builder.categories.index') }}".replace('/categories', '');
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

        let categories = [];
        let components = [];
        let configurations = [];

        // FIXED: Store data separately for edit functions
        let categoriesMap = {};
        let componentsMap = {};

        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
            
            // Auto-generate slug from name
            document.getElementById('category-name').addEventListener('input', function(e) {
                const slugInput = document.getElementById('category-slug');
                if (!document.getElementById('category-id').value) {
                    slugInput.value = e.target.value
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/(^-|-$)/g, '');
                }
            });
        });

        function switchTab(tab) {
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                btn.classList.remove('tab-active', 'text-primary');
                btn.classList.add('text-gray-500');
            });
            document.getElementById(`tab-${tab}`).classList.add('tab-active', 'text-primary');
            document.getElementById(`tab-${tab}`).classList.remove('text-gray-500');

            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            document.getElementById(`content-${tab}`).classList.remove('hidden');

            if (tab === 'components' && components.length === 0) loadComponents();
            else if (tab === 'configurations' && configurations.length === 0) loadConfigurations();
        }

        // FIXED: Better error handling and response parsing
        async function apiRequest(url, options = {}) {
            try {
                const response = await fetch(url, {
                    ...options,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        ...options.headers
                    }
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || `HTTP error! status: ${response.status}`);
                }
                
                return data;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }

        async function loadCategories() {
            try {
                const data = await apiRequest(`${API_BASE}/categories`);
                categories = data.categories || [];
                
                // Store in map for easy lookup
                categoriesMap = {};
                categories.forEach(cat => categoriesMap[cat.id] = cat);
                
                renderCategories();
                populateCategorySelects();
            } catch (error) {
                showNotification('Failed to load categories', 'error');
                document.getElementById('categories-loading').classList.add('hidden');
            }
        }

        function renderCategories() {
            const tbody = document.getElementById('categories-tbody');
            const loading = document.getElementById('categories-loading');
            const table = document.getElementById('categories-table');
            const empty = document.getElementById('categories-empty');
            
            loading.classList.add('hidden');
            
            if (categories.length === 0) {
                table.classList.add('hidden');
                empty.classList.remove('hidden');
                return;
            }
            
            empty.classList.add('hidden');
            table.classList.remove('hidden');
            
            // FIXED: Using data attributes instead of inline JSON
            tbody.innerHTML = categories.map(cat => `
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-semibold text-gray-800">${escapeHtml(cat.name)}</div>
                        ${cat.description ? `<div class="text-xs text-gray-500">${escapeHtml(cat.description)}</div>` : ''}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">${escapeHtml(cat.slug)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${cat.required ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'}">
                            ${cat.required ? 'Required' : 'Optional'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${cat.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
                            ${cat.is_active ? 'Active' : 'Inactive'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${cat.sort_order}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button onclick="editCategory(${cat.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </button>
                        <button onclick="deleteCategory(${cat.id})" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // FIXED: Helper function to escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function openCategoryModal(category = null) {
            document.getElementById('category-modal-title').textContent = category ? 'Edit Category' : 'Add Category';
            document.getElementById('category-form').reset();
            document.getElementById('category-id').value = '';
            
            if (category) {
                document.getElementById('category-id').value = category.id;
                document.getElementById('category-name').value = category.name;
                document.getElementById('category-slug').value = category.slug;
                document.getElementById('category-description').value = category.description || '';
                document.getElementById('category-sort').value = category.sort_order;
                document.getElementById('category-required').checked = category.required;
                document.getElementById('category-active').checked = category.is_active;
            } else {
                document.getElementById('category-active').checked = true;
                document.getElementById('category-required').checked = false;
            }

            document.getElementById('category-modal').classList.add('active');
        }

        function closeCategoryModal() {
            document.getElementById('category-modal').classList.remove('active');
        }

        async function saveCategory(event) {
            event.preventDefault();
            
            const submitBtn = document.getElementById('category-submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitBtn.disabled = true;
            
            const id = document.getElementById('category-id').value;
            const data = {
                name: document.getElementById('category-name').value.trim(),
                slug: document.getElementById('category-slug').value.trim(),
                description: document.getElementById('category-description').value.trim(),
                sort_order: parseInt(document.getElementById('category-sort').value) || 0,
                required: document.getElementById('category-required').checked,
                is_active: document.getElementById('category-active').checked
            };

            try {
                const url = id ? `${API_BASE}/categories/${id}` : `${API_BASE}/categories`;
                const method = id ? 'PUT' : 'POST';

                await apiRequest(url, {
                    method: method,
                    body: JSON.stringify(data)
                });
                
                closeCategoryModal();
                loadCategories();
                showNotification('Category saved successfully!', 'success');
            } catch (error) {
                showNotification(error.message || 'Failed to save category', 'error');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        }

        // FIXED: Using ID lookup instead of inline JSON
        function editCategory(id) {
            const category = categoriesMap[id];
            if (category) {
                openCategoryModal(category);
            }
        }

        async function deleteCategory(id) {
            if (!confirm('Are you sure you want to delete this category? This will also delete all associated components.')) return;

            try {
                await apiRequest(`${API_BASE}/categories/${id}`, {
                    method: 'DELETE'
                });
                
                loadCategories();
                showNotification('Category deleted successfully!', 'success');
            } catch (error) {
                showNotification(error.message || 'Failed to delete category', 'error');
            }
        }

        async function loadComponents() {
            try {
                document.getElementById('components-loading').classList.remove('hidden');
                document.getElementById('components-grid').classList.add('hidden');
                document.getElementById('components-empty').classList.add('hidden');

                const data = await apiRequest(`${API_BASE}/components`);
                components = data.components || [];
                
                // Store in map for easy lookup
                componentsMap = {};
                components.forEach(comp => componentsMap[comp.id] = comp);
                
                renderComponents();
            } catch (error) {
                showNotification('Failed to load components', 'error');
                document.getElementById('components-loading').classList.add('hidden');
            }
        }

        function renderComponents(filtered = null) {
            const grid = document.getElementById('components-grid');
            const loading = document.getElementById('components-loading');
            const empty = document.getElementById('components-empty');
            const items = filtered || components;
            
            loading.classList.add('hidden');
            
            if (items.length === 0) {
                grid.classList.add('hidden');
                empty.classList.remove('hidden');
                return;
            }
            
            empty.classList.add('hidden');
            grid.classList.remove('hidden');
            
            grid.innerHTML = items.map(comp => {
                const category = categoriesMap[comp.category_id];
                return `
                <div class="bg-white border-2 border-gray-200 rounded-2xl overflow-hidden hover:shadow-xl transition-all">
                    <div class="aspect-video bg-gray-100 relative">
                        <img src="${comp.image_url || 'https://via.placeholder.com/400x300?text=No+Image'}" 
                            class="w-full h-full object-cover" 
                            onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'"
                            alt="${escapeHtml(comp.name)}">
                        <div class="absolute top-2 right-2 flex gap-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${comp.in_stock ? 'bg-green-500' : 'bg-red-500'} text-white">
                                ${comp.in_stock ? 'In Stock' : 'Out'}
                            </span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${comp.is_active ? 'bg-blue-500' : 'bg-gray-500'} text-white">
                                ${comp.is_active ? 'Active' : 'Inactive'}
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-xs text-gray-500 uppercase font-bold mb-1">${category ? escapeHtml(category.name) : 'Unknown'}</div>
                        <h3 class="font-bold text-gray-800 text-sm mb-2 line-clamp-2">${escapeHtml(comp.name)}</h3>
                        <p class="text-xs text-gray-600 mb-3 line-clamp-2">${escapeHtml(comp.description) || 'No description'}</p>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-lg font-bold text-primary">Rs ${Number(comp.price).toLocaleString()}</span>
                            <span class="text-xs text-gray-500">Sort: ${comp.sort_order}</span>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="editComponent(${comp.id})" 
                                class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-xl text-xs font-semibold hover:bg-blue-700 transition">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <button onclick="deleteComponent(${comp.id})" 
                                class="flex-1 px-3 py-2 bg-red-600 text-white rounded-xl text-xs font-semibold hover:bg-red-700 transition">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </div>
                    </div>
                </div>
            `}).join('');
        }

        function filterComponents() {
            const categoryId = document.getElementById('filter-category').value;
            if (categoryId) {
                const filtered = components.filter(c => c.category_id == categoryId);
                renderComponents(filtered);
            } else {
                renderComponents();
            }
        }

        function populateCategorySelects() {
            const selects = [document.getElementById('component-category'), document.getElementById('filter-category')];
            
            selects.forEach(select => {
                if (!select) return;
                
                const isFilter = select.id === 'filter-category';
                select.innerHTML = isFilter ? '<option value="">All Categories</option>' : '<option value="">Select Category</option>';
                
                categories.forEach(cat => {
                    if (cat.is_active || !isFilter) {
                        select.innerHTML += `<option value="${cat.id}">${escapeHtml(cat.name)}</option>`;
                    }
                });
            });
        }

        function openComponentModal(component = null) {
            document.getElementById('component-modal-title').textContent = component ? 'Edit Component' : 'Add Component';
            document.getElementById('component-form').reset();
            document.getElementById('component-id').value = '';
            
            if (component) {
                document.getElementById('component-id').value = component.id;
                document.getElementById('component-category').value = component.category_id;
                document.getElementById('component-name').value = component.name;
                document.getElementById('component-description').value = component.description || '';
                document.getElementById('component-price').value = component.price;
                document.getElementById('component-image').value = component.image_url || '';
                document.getElementById('component-specs').value = component.specifications ? JSON.stringify(component.specifications, null, 2) : '';
                document.getElementById('component-sort').value = component.sort_order;
                document.getElementById('component-stock').checked = component.in_stock;
                document.getElementById('component-active').checked = component.is_active;
            } else {
                document.getElementById('component-stock').checked = true;
                document.getElementById('component-active').checked = true;
            }

            document.getElementById('component-modal').classList.add('active');
        }

        function closeComponentModal() {
            document.getElementById('component-modal').classList.remove('active');
        }

        async function saveComponent(event) {
            event.preventDefault();
            
            const submitBtn = document.getElementById('component-submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            submitBtn.disabled = true;
            
            const id = document.getElementById('component-id').value;
            
            let specifications = null;
            const specsText = document.getElementById('component-specs').value.trim();
            if (specsText) {
                try {
                    specifications = JSON.parse(specsText);
                } catch (e) {
                    showNotification('Invalid JSON format for specifications', 'error');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    return;
                }
            }

            const data = {
                category_id: parseInt(document.getElementById('component-category').value),
                name: document.getElementById('component-name').value.trim(),
                description: document.getElementById('component-description').value.trim(),
                price: parseFloat(document.getElementById('component-price').value),
                image_url: document.getElementById('component-image').value.trim(),
                specifications: specifications,
                sort_order: parseInt(document.getElementById('component-sort').value) || 0,
                in_stock: document.getElementById('component-stock').checked,
                is_active: document.getElementById('component-active').checked
            };

            try {
                const url = id ? `${API_BASE}/components/${id}` : `${API_BASE}/components`;
                const method = id ? 'PUT' : 'POST';

                await apiRequest(url, {
                    method: method,
                    body: JSON.stringify(data)
                });
                
                closeComponentModal();
                loadComponents();
                showNotification('Component saved successfully!', 'success');
            } catch (error) {
                showNotification(error.message || 'Failed to save component', 'error');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        }

        // FIXED: Using ID lookup instead of inline JSON
        function editComponent(id) {
            const component = componentsMap[id];
            if (component) {
                openComponentModal(component);
            }
        }

        async function deleteComponent(id) {
            if (!confirm('Are you sure you want to delete this component?')) return;

            try {
                await apiRequest(`${API_BASE}/components/${id}`, {
                    method: 'DELETE'
                });
                
                loadComponents();
                showNotification('Component deleted successfully!', 'success');
            } catch (error) {
                showNotification(error.message || 'Failed to delete component', 'error');
            }
        }

        async function loadConfigurations() {
            try {
                const data = await apiRequest(`${API_BASE}/configurations`);
                configurations = data.configurations || [];
                renderConfigurations();
            } catch (error) {
                showNotification('Failed to load configurations', 'error');
                document.getElementById('configurations-loading').classList.add('hidden');
            }
        }

        function renderConfigurations() {
            const tbody = document.getElementById('configurations-tbody');
            const loading = document.getElementById('configurations-loading');
            const table = document.getElementById('configurations-table');
            const empty = document.getElementById('configurations-empty');
            
            loading.classList.add('hidden');
            
            if (configurations.length === 0) {
                table.classList.add('hidden');
                empty.classList.remove('hidden');
                return;
            }
            
            empty.classList.add('hidden');
            table.classList.remove('hidden');
            
            tbody.innerHTML = configurations.map(config => `
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-600">#${config.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-semibold text-gray-800">${escapeHtml(config.customer_name)}</div>
                        ${config.company_name ? `<div class="text-xs text-gray-500">${escapeHtml(config.company_name)}</div>` : ''}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-600">${escapeHtml(config.customer_email)}</div>
                        <div class="text-xs text-gray-500">${escapeHtml(config.customer_phone)}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold text-primary">Rs ${Number(config.total_price).toLocaleString()}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full ${getStatusColor(config.status)}">
                            ${config.status.toUpperCase()}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        ${new Date(config.created_at).toLocaleDateString()}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button onclick="viewConfiguration(${config.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye mr-1"></i>View
                        </button>
                        <button onclick="openStatusModal(${config.id}, '${config.status}')" class="text-primary hover:text-blue-700">
                            <i class="fas fa-edit mr-1"></i>Status
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function getStatusColor(status) {
            const colors = {
                'pending': 'bg-yellow-100 text-yellow-800',
                'reviewed': 'bg-blue-100 text-blue-800',
                'quoted': 'bg-purple-100 text-purple-800',
                'approved': 'bg-green-100 text-green-800',
                'rejected': 'bg-red-100 text-red-800',
                'completed': 'bg-gray-100 text-gray-800'
            };
            return colors[status] || 'bg-gray-100 text-gray-800';
        }

        async function viewConfiguration(id) {
            try {
                const data = await apiRequest(`${API_BASE}/configurations/${id}`);
                displayConfigurationDetail(data.configuration);
            } catch (error) {
                showNotification('Failed to load configuration details', 'error');
            }
        }

        function displayConfigurationDetail(config) {
            const detail = document.getElementById('config-detail');
            const selections = typeof config.selections === 'string' ? JSON.parse(config.selections) : config.selections;
            
            detail.innerHTML = `
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4 pb-4 border-b">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Customer Name</p>
                            <p class="font-semibold">${escapeHtml(config.customer_name)}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Email</p>
                            <p class="font-semibold">${escapeHtml(config.customer_email)}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Phone</p>
                            <p class="font-semibold">${escapeHtml(config.customer_phone)}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Company</p>
                            <p class="font-semibold">${escapeHtml(config.company_name) || 'N/A'}</p>
                        </div>
                    </div>

                    ${config.notes ? `
                        <div class="pb-4 border-b">
                            <p class="text-xs text-gray-500 uppercase font-bold mb-2">Notes</p>
                            <p class="text-sm text-gray-700">${escapeHtml(config.notes)}</p>
                        </div>
                    ` : ''}

                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-4">Selected Components</p>
                        <div class="space-y-3">
                            ${Object.entries(selections).map(([key, component]) => `
                                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                                    <img src="${component.image_url || 'https://via.placeholder.com/100'}" 
                                        class="w-16 h-16 rounded-lg object-cover" 
                                        onerror="this.src='https://via.placeholder.com/100'"
                                        alt="${escapeHtml(component.name)}">
                                    <div class="flex-1">
                                        <p class="text-xs text-gray-500 uppercase font-bold">${getCategoryName(key)}</p>
                                        <p class="font-semibold text-gray-800">${escapeHtml(component.name)}</p>
                                    </div>
                                    <p class="font-mono font-bold text-primary">Rs ${Number(component.price).toLocaleString()}</p>
                                </div>
                            `).join('')}
                        </div>
                    </div>

                    <div class="pt-4 border-t flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Total Price</p>
                            <p class="text-2xl font-black text-primary">Rs ${Number(config.total_price).toLocaleString()}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Status</p>
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full ${getStatusColor(config.status)}">
                                ${config.status.toUpperCase()}
                            </span>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('config-modal').classList.add('active');
        }

        function getCategoryName(categoryId) {
            const category = categoriesMap[categoryId];
            return category ? escapeHtml(category.name) : 'Unknown';
        }

        function closeConfigModal() {
            document.getElementById('config-modal').classList.remove('active');
        }

        // FIXED: Replaced prompt with modal
        function openStatusModal(id, currentStatus) {
            document.getElementById('status-config-id').value = id;
            document.getElementById('status-select').value = currentStatus;
            document.getElementById('status-modal').classList.add('active');
        }

        function closeStatusModal() {
            document.getElementById('status-modal').classList.remove('active');
        }

        async function submitStatusUpdate(event) {
            event.preventDefault();
            
            const id = document.getElementById('status-config-id').value;
            const newStatus = document.getElementById('status-select').value;

            try {
                await apiRequest(`${API_BASE}/configurations/${id}/status`, {
                    method: 'PATCH',
                    body: JSON.stringify({ status: newStatus })
                });
                
                closeStatusModal();
                loadConfigurations();
                showNotification('Status updated successfully!', 'success');
            } catch (error) {
                showNotification(error.message || 'Failed to update status', 'error');
            }
        }

        // FIXED: Better notification system instead of alert()
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existing = document.querySelector('.notification-toast');
            if (existing) existing.remove();

            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500',
                warning: 'bg-yellow-500'
            };

            const icons = {
                success: 'fa-check-circle',
                error: 'fa-exclamation-circle',
                info: 'fa-info-circle',
                warning: 'fa-exclamation-triangle'
            };

            const notification = document.createElement('div');
            notification.className = `notification-toast fixed top-4 right-4 z-[100] ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 transform transition-all duration-300 translate-x-full`;
            notification.innerHTML = `
                <i class="fas ${icons[type]} text-xl"></i>
                <span class="font-semibold">${escapeHtml(message)}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 hover:opacity-75">
                    <i class="fas fa-times"></i>
                </button>
            `;

            document.body.appendChild(notification);
            
            // Animate in
            requestAnimationFrame(() => {
                notification.classList.remove('translate-x-full');
            });

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        // Close modals on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCategoryModal();
                closeComponentModal();
                closeConfigModal();
                closeStatusModal();
            }
        });

        // Close modals on backdrop click
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                }
            });
        });
    </script>
@endpush