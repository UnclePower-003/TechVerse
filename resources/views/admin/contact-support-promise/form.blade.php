@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('contact-support-promise.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Support Promises</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-handshake mr-3 opacity-80"></i>
                    {{ $promise ? 'Edit Support Promises' : 'Create Support Promises' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Define the commitments and service guarantees your support team
                    offers.</p>
            </div>

            <div class="p-8">
                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Attention:</span>
                        </div>
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                    action="{{ $promise ? route('contact-support-promise.update', $promise) : route('contact-support-promise.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($promise)
                        @method('PUT')
                    @endif

                    {{-- Dynamic Promises List --}}
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Promise
                                List</label>
                            <button type="button" onclick="addPromise()"
                                class="text-xs bg-blue-50 text-primary px-4 py-2 rounded-lg font-bold hover:bg-primary hover:text-white transition-all flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>Add New Promise</span>
                            </button>
                        </div>

                        <div id="promises-container" class="space-y-3">
                            @php
                                $items = old('promises', $promise->promises ?? ['']);
                            @endphp

                            @foreach ($items as $i => $item)
                                <div class="promise-item flex items-center gap-3 animate-fadeIn">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 font-bold text-xs">
                                        {{ $i + 1 }}
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="promises[{{ $i }}]"
                                            value="{{ $item }}" placeholder="e.g. 24/7 Priority Email Support"
                                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm font-medium transition-all">
                                    </div>
                                    <button type="button" onclick="this.parentElement.remove()"
                                        class="p-2.5 text-red-400 hover:text-white hover:bg-red-500 rounded-xl transition-all"
                                        title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr class="border-gray-100 my-6">

                    {{-- Status and Footer --}}
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="flex items-center space-x-3">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $promise->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer">
                            <label for="isActive"
                                class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer">
                                Active Status
                            </label>
                        </div>

                        <div class="flex items-center space-x-3">
                            <a href="{{ route('contact-support-promise.index') }}"
                                class="px-6 py-2.5 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-8 py-2.5 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-blue-500 transition-all flex items-center space-x-2 text-sm">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $promise ? 'Update Changes' : 'Save Promises' }}</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addPromise() {
            const container = document.getElementById('promises-container');
            const index = container.children.length;
            const div = document.createElement('div');
            div.className = "promise-item flex items-center gap-3 animate-fadeIn";
            div.innerHTML = `
                <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 font-bold text-xs">
                    ${index + 1}
                </div>
                <div class="flex-1">
                    <input type="text" name="promises[${index}]" placeholder="Enter promise text..." 
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm font-medium transition-all">
                </div>
                <button type="button" onclick="this.parentElement.remove()" 
                    class="p-2.5 text-red-400 hover:text-white hover:bg-red-500 rounded-xl transition-all">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(div);
        }
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
