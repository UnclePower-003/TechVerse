@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-edit mr-2 text-primary"></i> Edit Project
                </h1>
                <p class="text-sm text-gray-500 mt-1">Update your project details below.</p>
            </div>
            <a href="{{ route('projects.index') }}"
                class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data"
                class="p-8 space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Title --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Project Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}"
                            class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all @error('title') border-red-500 @else border-gray-200 @enderror"
                            placeholder="Enter project name">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subtitle & Badge --}}
                    <div>
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $project->subtitle) }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all"
                            placeholder="Brief catchy line">
                    </div>
                    <div>
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Badge</label>
                        <input type="text" name="badge" value="{{ old('badge', $project->badge) }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all"
                            placeholder="e.g. Featured, New">
                    </div>

                    {{-- Image with Preview --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Project Image <span
                                class="text-red-500">*</span></label>
                        <div class="flex flex-col items-center justify-center w-full">
                            <label id="image-label"
                                class="flex flex-col w-full h-48 border-2 border-dashed @error('image') border-red-400 bg-red-50 @else border-gray-200 @enderror hover:bg-gray-50 hover:border-primary transition-colors rounded-xl cursor-pointer overflow-hidden relative">
                                <div id="upload-placeholder"
                                    class="flex flex-col items-center justify-center pt-12 @if ($project->image) hidden @endif">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                    <p class="text-sm text-gray-500">Click to upload project cover</p>
                                </div>
                                <img id="image-preview"
                                    src="{{ $project->image ? asset('storage/' . $project->image) : '#' }}" alt="Preview"
                                    class="absolute inset-0 w-full h-full object-cover @if (!$project->image) hidden @endif">
                                <input type="file" name="image" id="image-input" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Overview --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Overview <span
                                class="text-red-500">*</span></label>
                        <textarea name="overview" rows="3"
                            class="w-full px-4 py-3 border @error('overview') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all"
                            placeholder="Describe the project goal...">{{ old('overview', $project->overview) }}</textarea>
                        @error('overview')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Specifications --}}
                    <div
                        class="md:col-span-2 bg-gray-50 p-6 rounded-2xl border @error('project_specifications*') border-red-300 @else border-gray-100 @enderror">
                        <label class="block mb-4 font-bold text-gray-800 text-base">Project Specifications <span
                                class="text-red-500">*</span></label>
                        <div id="specifications-wrapper" class="space-y-3">
                            @php $specs = old('project_specifications', $project->project_specifications ?? [[]]); @endphp
                            @foreach ($specs as $index => $spec)
                                <div class="flex gap-3">
                                    <input type="text" name="project_specifications[{{ $index }}][title]"
                                        value="{{ $spec['title'] ?? '' }}" placeholder="Label"
                                        class="flex-1 px-4 py-2 border border-gray-200 rounded-lg outline-none focus:border-primary">
                                    <input type="text" name="project_specifications[{{ $index }}][description]"
                                        value="{{ $spec['description'] ?? '' }}" placeholder="Value"
                                        class="flex-1 px-4 py-2 border border-gray-200 rounded-lg outline-none focus:border-primary">
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-spec-btn"
                            class="mt-4 inline-flex items-center text-sm font-bold text-primary hover:underline">
                            <i class="fas fa-plus-circle mr-1"></i> Add Specification
                        </button>
                    </div>

                    {{-- Completion --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Completion Status <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="completion" value="{{ old('completion', $project->completion) }}"
                            class="w-full px-4 py-3 border @error('completion') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all"
                            placeholder="e.g. Completed Dec 2024">
                        @error('completion')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Key Features --}}
                    <div
                        class="md:col-span-2 bg-gray-50 p-6 rounded-2xl border @error('key_features*') border-red-300 @else border-gray-100 @enderror">
                        <label class="block mb-4 font-bold text-gray-800 text-base">Key Features <span
                                class="text-red-500">*</span></label>
                        <div id="features-wrapper" class="space-y-3">
                            @php $features = old('key_features', $project->key_features ?? ['']); @endphp
                            @foreach ($features as $index => $feature)
                                <input type="text" name="key_features[{{ $index }}]"
                                    value="{{ $feature }}" placeholder="Enter a feature..."
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none focus:border-primary">
                            @endforeach
                        </div>
                        <button type="button" id="add-feature-btn"
                            class="mt-4 inline-flex items-center text-sm font-bold text-primary hover:underline">
                            <i class="fas fa-plus-circle mr-1"></i> Add Feature
                        </button>
                    </div>

                    {{-- Technical Details --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Technical Details <span
                                class="text-red-500">*</span></label>
                        <textarea name="technical_details" rows="3"
                            class="w-full px-4 py-3 border @error('technical_details') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all">{{ old('technical_details', $project->technical_details) }}</textarea>
                        @error('technical_details')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Quote --}}
                    <div>
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Testimonial Quote</label>
                        <textarea name="quote" rows="2"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all">{{ old('quote', $project->quote) }}</textarea>
                    </div>
                    <div>
                        <label class="block mb-2 font-bold text-gray-700 text-sm uppercase">Quote Author</label>
                        <input type="text" name="quote_author"
                            value="{{ old('quote_author', $project->quote_author) }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary outline-none transition-all"
                            placeholder="Name and Position">
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="pt-6 border-t border-gray-100 flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-primary text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-[#266eb1] transition-all transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Update Project
                    </button>
                    <button type="reset"
                        class="px-8 py-4 bg-gray-100 text-gray-500 rounded-xl font-bold hover:bg-gray-200 transition-all">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image Preview Logic
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const uploadPlaceholder = document.getElementById('upload-placeholder');

        imageInput.onchange = evt => {
            const [file] = imageInput.files;
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.classList.remove('hidden');
                uploadPlaceholder.classList.add('hidden');
            }
        }

        const inputClasses = "flex-1 px-4 py-2 border border-gray-200 rounded-lg outline-none focus:border-primary";

        // Specifications
        let specIndex = {{ count($specs) }};
        document.getElementById('add-spec-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('specifications-wrapper');
            const div = document.createElement('div');
            div.className = "flex gap-3 animate-fadeIn";
            div.innerHTML = `
            <input type="text" name="project_specifications[${specIndex}][title]" placeholder="Label" class="${inputClasses}">
            <input type="text" name="project_specifications[${specIndex}][description]" placeholder="Value" class="${inputClasses}">
        `;
            wrapper.appendChild(div);
            specIndex++;
        });

        // Key Features
        let featureIndex = {{ count($features) }};
        document.getElementById('add-feature-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('features-wrapper');
            const div = document.createElement('div');
            div.className = "flex gap-3 animate-fadeIn";
            div.innerHTML =
                `<input type="text" name="key_features[${featureIndex}]" placeholder="Enter a feature..." class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none focus:border-primary">`;
            wrapper.appendChild(div);
            featureIndex++;
        });
    </script>
@endsection
