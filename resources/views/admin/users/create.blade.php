@extends('admin.layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    {{-- Breadcrumb/Back Link --}}
    <div class="mb-6">
        <a href="{{ route('users.index') }}" class="text-sm text-black hover:text-[#266eb1] transition-colors flex items-center space-x-1 font-semibold">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to Admins</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        {{-- Form Header --}}
        <div class="bg-primary px-8 py-6">
            <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                <i class="fas fa-user-plus mr-3 opacity-80"></i> 
                Add New Admin
            </h1>
            <p class="text-indigo-100/80 text-sm mt-1">Register a new administrator and assign their system permissions.</p>
        </div>

        <div class="p-8">
            {{-- Display Errors --}}
            @if($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-bold">Please correct the following:</span>
                    </div>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Name --}}
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Full Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-user text-xs"></i>
                            </span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                required placeholder="Enter full name">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-envelope text-xs"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                required placeholder="email@example.com">
                        </div>
                    </div>
                </div>

                {{-- Role --}}
                <div class="space-y-1">
                    <label for="role" class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Access Level</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-shield-alt text-xs"></i>
                        </span>
                        <select id="role" name="role"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium appearance-none cursor-pointer">
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Standard Admin</option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-100"></div>
                    </div>
                    <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                        <span class="bg-white pr-4 text-primary">Security Credentials</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Password --}}
                    <div class="space-y-1">
                        <label for="password" class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock text-xs"></i>
                            </span>
                            <input type="password" id="password" name="password"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800"
                                required placeholder="Create password">
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Confirm Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-check-double text-xs"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800"
                                required placeholder="Confirm password">
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                    <a href="{{ route('users.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center space-x-2">
                        <span>Cancel</span>
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#266eb1] transition-all flex items-center space-x-2">
                        <i class="fas fa-user-plus text-sm"></i>
                        <span>Create Admin</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection