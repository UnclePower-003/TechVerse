@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('contact-info.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Contact Info</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-address-book mr-3 opacity-80"></i>
                    {{ $info ? 'Edit Contact Info' : 'Create New Contact Info' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Add or update multiple contact details like office locations,
                    emails, or phone numbers.</p>
            </div>

            <div class="p-8">
                {{-- Display Errors --}}
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Please correct the following:</span>
                        </div>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                    action="{{ $info ? route('contact-info.update', $info) : route('contact-info.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($info)
                        @method('PUT')
                    @endif

                    {{-- Items Section --}}
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Contact
                                Items</label>
                            <button type="button" onclick="addItem()"
                                class="text-xs bg-blue-50 text-primary px-3 py-1.5 rounded-lg font-bold hover:bg-primary hover:text-white transition-all flex items-center space-x-1">
                                <i class="fas fa-plus"></i>
                                <span>Add New Row</span>
                            </button>
                        </div>

                        <div id="items-container" class="space-y-4">
                            @php
                                $items = old(
                                    'items',
                                    $info->items ?? [['icon' => '', 'title' => '', 'description' => '']],
                                );
                            @endphp

                            @foreach ($items as $i => $item)
                                <div
                                    class="item flex flex-col md:flex-row gap-3 p-4 bg-gray-50 rounded-2xl border border-gray-100 relative group transition-all hover:border-blue-200">
                                    <div class="flex-1">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Icon Class</label>
                                        <input type="text" name="items[{{ $i }}][icon]"
                                            placeholder="fas fa-phone" value="{{ $item['icon'] ?? '' }}"
                                            class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm">
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Title</label>
                                        <input type="text" name="items[{{ $i }}][title]"
                                            placeholder="Phone Number" value="{{ $item['title'] ?? '' }}"
                                            class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm font-semibold">
                                    </div>
                                    <div class="flex-[2]">
                                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Description /
                                            Value</label>
                                        <input type="text" name="items[{{ $i }}][description]"
                                            placeholder="+1 234 567 890" value="{{ $item['description'] ?? '' }}"
                                            class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm">
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" onclick="this.parentElement.parentElement.remove()"
                                            class="p-2.5 text-red-400 hover:text-white hover:bg-red-500 rounded-xl transition-all mb-0.5"
                                            title="Remove Item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Active Status Toggle --}}
                    <div class="flex items-center space-x-3">
                        <input type="hidden" name="is_active" value="0">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $info->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        </div>
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                            Mark as Active
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('contact-info.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $info ? 'Update' : 'Save' }} Info</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addItem() {
            let container = document.getElementById('items-container');
            let index = container.children.length;
            let div = document.createElement('div');
            div.className =
                "item flex flex-col md:flex-row gap-3 p-4 bg-gray-50 rounded-2xl border border-gray-100 relative group transition-all hover:border-blue-200 animate-fadeIn";
            div.innerHTML = `
                <div class="flex-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Icon Class</label>
                    <input type="text" name="items[${index}][icon]" placeholder="fas fa-map-marker-alt" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm">
                </div>
                <div class="flex-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Title</label>
                    <input type="text" name="items[${index}][title]" placeholder="Office Address" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm font-semibold">
                </div>
                <div class="flex-[2]">
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Description / Value</label>
                    <input type="text" name="items[${index}][description]" placeholder="123 Main St, New York" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm">
                </div>
                <div class="flex items-end">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" 
                        class="p-2.5 text-red-400 hover:text-white hover:bg-red-500 rounded-xl transition-all mb-0.5">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
        }
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
