@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-boxes mr-2 text-primary"></i> Products
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage your inventory, pricing, and product categories.</p>
            </div>


            <div class="flex items-center gap-3">
                {{-- Add Product (Secondary Style) --}}
                {{-- Add Category (Primary Style) --}}
                <a href="{{ route('categories.index') }}"
                    class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    <span>View Category</span>
                </a>

                <a href="{{ route('products.create') }}"
                    class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Add Product</span>
                </a>

            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Table Section (Card Layout) --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-24">Image</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Product Info</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Price</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Image --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset($product->image) }}"
                                        class="w-12 h-12 rounded-lg object-cover border border-gray-200 shadow-sm">
                                </td>

                                {{-- Title & Model --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $product->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $product->model }}</div>
                                </td>

                                {{-- Category --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded border border-gray-200">
                                        {{ $product->category->name ?? '—' }}
                                    </span>
                                </td>

                                {{-- Price --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-primary">
                                        {{ $product->price }}
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="p-2 text-[#266eb1] hover:bg-blue-50 rounded-lg transition-all"
                                            title="Edit Product">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all"
                                                title="Delete Product">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-box-open text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No products found.</p>
                                        <a href="{{ route('products.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">
                                            Create your first product
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
