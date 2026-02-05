@extends('frontend.app')

@section('title', 'Server Builder | TechVerse')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        /* Utilities */
        .hidden-view {
            display: none !important;
        }

        .fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pulse animation for price */
        @keyframes pricePulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .price-updated {
            animation: pricePulse 0.3s ease-out;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Loading Spinner */
        .spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #10b981;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        .spinner-sm {
            width: 20px;
            height: 20px;
            border-width: 2px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Toast notification */
        .toast {
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
        }

        .toast.show {
            transform: translateX(0);
        }

        /* Sticky header */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Component card hover effect */
        .component-card {
            transition: all 0.3s ease;
        }

        .component-card:hover {
            transform: translateY(-2px);
        }

        /* Modal backdrop blur */
        .modal-backdrop {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        /* Progress bar */
        .progress-bar {
            transition: width 0.5s ease-out;
        }
    </style>
@endpush

@section('content')
    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-[100] space-y-2"></div>

    <!-- Main Container -->
    <main class="mt-10 pb-12 min-h-screen">

        <!-- Server Builder Welcome -->
        <section id="view-welcome" class="max-w-4xl mx-auto px-4 sm:px-6 fade-in">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-5xl md:text-6xl font-extrabold mb-4 tracking-tight text-slate-800">
                    Build your <span class="text-blue-600">Enterprise Server</span>
                </h2>
                <p class="text-slate-500 text-base sm:text-lg max-w-2xl mx-auto px-4">
                    Configure scalable infrastructure designed for 24/7 reliability and massive throughput.
                </p>
            </div>

            <div class="max-w-2xl mx-auto">
                <div onclick="initBuilder()"
                    class="group cursor-pointer bg-[#e5effa]/70 rounded-3xl shadow-xl hover:shadow-2xl hover:shadow-blue-600/10 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="aspect-video overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('imagess/buildupimages/server.png') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1558494949-efc5e66cd38f?auto=format&fit=crop&q=80&w=800'"
                            alt="Server"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#e5effa] via-transparent to-transparent opacity-90">
                        </div>
                    </div>
                    <div class="p-6 sm:p-8 relative -mt-[75px] ">
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-4">Enterprise Server</h3>
                        <p class="text-slate-500 text-sm sm:text-base mb-6 leading-relaxed">
                            Scalable infrastructure designed for 24/7 reliability and massive throughput.
                        </p>
                        <span
                            class="inline-flex items-center text-green-600 font-bold uppercase text-xs sm:text-sm tracking-widest group-hover:gap-3 transition-all">
                            Start Configuration
                            <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Component Builder View -->
        <section id="view-builder" class="hidden-view max-w-4xl mx-auto px-4 sm:px-6 fade-in">

            <!-- FIXED: Sticky Header with Total Price at TOP -->
            <div class="sticky-header bg-white/95 rounded-2xl shadow-lg mb-6 overflow-hidden">
                <!-- Progress Bar -->
                <div class="h-1 bg-slate-100">
                    <div id="progress-bar" class="progress-bar h-full bg-blue-600"
                        style="width: 0%"></div>
                </div>

                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <!-- Left: Title & Progress -->
                        <div class="flex items-center gap-4">
                            <div class="bg-slate-100 text-blue-700 p-3 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg sm:text-xl font-bold text-slate-800">Enterprise Server</h2>
                                <p id="progress-text" class="text-xs sm:text-sm text-slate-500">Select your components</p>
                            </div>
                        </div>

                        <!-- Center: Total Price (MOVED TO TOP) -->
                        <div class="flex-1 flex justify-center">
                            <div
                                class="bg-slate-100 rounded-2xl px-6 py-3 text-center">
                                <p class="text-[10px]  font-bold uppercase tracking-widest mb-1">Total Cost
                                </p>
                                <div class="flex items-center justify-center gap-2">
                                    <span id="total-price"
                                        class="text-2xl sm:text-3xl font-black text-black/50 transition-all">Rs 0</span>
                                </div>
                                <div id="selection-count" class="flex justify-center gap-1 mt-2"></div>
                            </div>
                        </div>

                        <!-- Right: Actions -->
                        <div class="flex items-center gap-3">
                            <button onclick="resetBuilder()"
                                class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 p-2 rounded-lg transition flex items-center gap-2"
                                title="Start Over">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span class="hidden sm:inline text-xs font-bold uppercase tracking-wider">Reset</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div class="text-center py-12" id="loading-indicator">
                <div class="spinner mx-auto mb-4"></div>
                <p class="text-slate-500">Loading server components...</p>
            </div>

            <!-- Component List -->
            <div id="component-list" class="space-y-3 mb-6"></div>

            <!-- Review Button (Fixed at bottom, simpler now) -->
            <div id="review-button-container" class="hidden-view sticky bottom-4 mt-6">
                <button id="review-btn" onclick="showReview()" disabled
                    class="w-full bg-blue-600 hover:bg-blue-800 text-white px-8 py-4 rounded-2xl font-bold transition-all  disabled:cursor-not-allowed uppercase tracking-widest text-sm  flex items-center justify-center gap-3">
                    <span id="review-btn-text">Select Required Components</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </section>

        <!-- Review View -->
        <section id="view-review" class="hidden-view max-w-4xl mx-auto px-4 sm:px-6 fade-in">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Review Header -->
                <div class="bg-blue-600 p-6 sm:p-8 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-green-100 text-xs uppercase tracking-widest font-bold mb-1">Configuration Review
                            </p>
                            <h2 class="text-2xl sm:text-3xl font-extrabold">Your Enterprise Server</h2>
                        </div>
                        <button onclick="backToBuilder()"
                            class="text-white/80 hover:text-white hover:bg-white/10 p-2 rounded-lg transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline text-sm font-bold">Edit</span>
                        </button>
                    </div>
                </div>

                <!-- Review Content -->
                <div class="p-6 sm:p-8">
                    <div id="summary-content"></div>
                </div>
            </div>
        </section>

        <!-- Component Selection Modal -->
        <div id="modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="modal-backdrop fixed inset-0 bg-slate-900/75 transition-opacity" onclick="closeModal()"></div>
                <div
                    class="inline-block w-full max-w-5xl p-0 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl">
                    <!-- Modal Header -->
                    <div
                        class="sticky top-0 bg-white border-b border-slate-100 px-6 py-4 flex justify-between items-center z-10">
                        <div>
                            <h3 id="modal-title" class="text-xl sm:text-2xl font-extrabold text-slate-800">Select
                                Component</h3>
                            <p id="modal-subtitle" class="text-sm text-slate-500 mt-1">Choose the best option for your
                                needs</p>
                        </div>
                        <button onclick="closeModal()"
                            class="text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div id="modal-options"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 max-h-[60vh] overflow-y-auto p-6">
                        <!-- Options will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        let selections = {};
        let categories = [];
        let currentModalCategory = null;
        const apiBaseUrl = "{{ route('api.server-builder.categories') }}".replace('/categories', '');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        // Initialize builder
        async function initBuilder() {
            document.getElementById('view-welcome').classList.add('hidden-view');
            document.getElementById('view-builder').classList.remove('hidden-view');

            await loadCategories();
        }

        // Load categories from API
        async function loadCategories() {
            try {
                const response = await fetch("{{ route('api.server-builder.categories') }}", {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (!response.ok) throw new Error('Failed to load categories');

                const data = await response.json();
                categories = data.categories || [];

                document.getElementById('loading-indicator').style.display = 'none';
                document.getElementById('review-button-container').classList.remove('hidden-view');
                renderComponentList();
                updateUI();
            } catch (error) {
                console.error('Error loading categories:', error);
                document.getElementById('loading-indicator').innerHTML = `
                    <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-red-600 font-semibold mb-4">Failed to load components</p>
                        <button onclick="loadCategories()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                            Try Again
                        </button>
                    </div>
                `;
            }
        }

        // Render component list
        function renderComponentList() {
            const container = document.getElementById('component-list');
            container.innerHTML = '';

            categories.forEach((category, index) => {
                const selected = selections[category.id];
                const div = document.createElement('div');
                div.className =
                    `component-card bg-white rounded-xl p-4 sm:p-5 shadow-md hover:shadow-xl cursor-pointer group border-2 transition-all ${selected ? '' : 'border-transparent hover:border-slate-200'}`;
                div.style.animationDelay = `${index * 0.05}s`;
                div.onclick = () => openModal(category.id);

                div.innerHTML = `
                    <div class="flex justify-between items-center gap-4">
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <!-- Icon/Image -->
                            <div class="flex-shrink-0">
                                ${selected 
                                    ? `<img src="${escapeHtml(selected.image_url)}" class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl object-cover border-2 border-blue-400 shadow-sm" onerror="this.src='https://via.placeholder.com/100?text=No+Image'" alt="${escapeHtml(selected.name)}">`
                                    : `<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-slate-100 flex items-center justify-center  transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400  transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </div>`
                                }
                            </div>
                            
                            <!-- Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    <h3 class="font-bold text-slate-800 text-sm sm:text-base">${escapeHtml(category.name)}</h3>
                                    ${category.required 
                                        ? '<span class="text-[9px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase flex-shrink-0">Required</span>' 
                                        : '<span class="text-[9px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-bold uppercase flex-shrink-0">Optional</span>'
                                    }
                                </div>
                                ${selected 
                                    ? `<p class="text-slate-700 font-medium text-sm truncate">${escapeHtml(selected.name)}</p>`
                                    : `<p class="text-slate-400 text-sm">Click to select</p>`
                                }
                            </div>
                        </div>
                        
                        <!-- Price & Arrow -->
                        <div class="flex items-center gap-3 flex-shrink-0">
                            ${selected 
                                ? `<span class=" font-mono font-bold text-sm sm:text-base">Rs ${Number(selected.price).toLocaleString()}</span>`
                                : ''
                            }
                            <div class="bg-slate-100  p-2 rounded-lg transition">
                                <svg class="w-4 h-4 text-slate-400 g0 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        // Update all UI elements
        function updateUI() {
            updateProgressDots();
            updateTotal();
            updateProgressBar();
        }

        // Update progress dots
        function updateProgressDots() {
            const dotContainer = document.getElementById('selection-count');
            dotContainer.innerHTML = '';

            categories.forEach(cat => {
                const dot = document.createElement('div');
                const isSelected = !!selections[cat.id];
                const isRequired = cat.required;

                dot.className = `h-2 rounded-full transition-all duration-300 ${
                    isSelected 
                        ? 'bg-blue-600 w-5' 
                        : isRequired 
                            ? 'bg-red-300 w-2' 
                            : 'bg-slate-300 w-2'
                }`;
                dot.title = `${cat.name}: ${isSelected ? 'Selected' : 'Not selected'}`;
                dotContainer.appendChild(dot);
            });
        }

        // Update progress bar
        function updateProgressBar() {
            const totalCategories = categories.length;
            const selectedCount = Object.keys(selections).length;
            const percentage = totalCategories > 0 ? (selectedCount / totalCategories) * 100 : 0;

            document.getElementById('progress-bar').style.width = `${percentage}%`;
            document.getElementById('progress-text').textContent =
                `${selectedCount} of ${totalCategories} components selected`;
        }

        // Update total price
        function updateTotal() {
            const total = Object.values(selections).reduce((sum, item) => sum + Number(item.price), 0);
            const priceElement = document.getElementById('total-price');

            priceElement.textContent = `Rs ${total.toLocaleString()}`;
            priceElement.classList.add('price-updated');
            setTimeout(() => priceElement.classList.remove('price-updated'), 300);

            const requiredCategories = categories.filter(cat => cat.required);
            const requiredSelected = requiredCategories.filter(cat => selections[cat.id]).length;
            const allRequiredSelected = requiredSelected >= requiredCategories.length;

            const btn = document.getElementById('review-btn');
            const btnText = document.getElementById('review-btn-text');

            btn.disabled = !allRequiredSelected;

            if (allRequiredSelected) {
                btnText.textContent = 'Review Configuration';
            } else {
                btnText.textContent = `Select ${requiredCategories.length - requiredSelected} more required`;
            }
        }

        // Open modal
        async function openModal(categoryId) {
            currentModalCategory = categoryId;
            const category = categories.find(c => c.id === categoryId);

            document.getElementById('modal-title').textContent = `Select ${category.name}`;
            document.getElementById('modal-subtitle').textContent = category.description ||
                'Choose the best option for your needs';

            const optionsContainer = document.getElementById('modal-options');
            optionsContainer.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <div class="spinner mx-auto mb-4"></div>
                    <p class="text-slate-500">Loading options...</p>
                </div>
            `;

            document.getElementById('modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            try {
                const response = await fetch(`${apiBaseUrl}/components/${categoryId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (!response.ok) throw new Error('Failed to load components');

                const data = await response.json();
                displayOptions(categoryId, data.components || []);
            } catch (error) {
                console.error('Error loading components:', error);
                optionsContainer.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-red-500 font-semibold">Failed to load options</p>
                        <button onclick="openModal(${categoryId})" class="mt-4  font-semibold">Try Again</button>
                    </div>
                `;
            }
        }

        // Display component options in modal
        function displayOptions(categoryId, components) {
            const optionsContainer = document.getElementById('modal-options');

            if (components.length === 0) {
                optionsContainer.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-slate-500">No components available</p>
                    </div>
                `;
                return;
            }

            optionsContainer.innerHTML = '';

            components.forEach(component => {
                const isSelected = selections[categoryId]?.id === component.id;
                const isOutOfStock = !component.in_stock;

                const card = document.createElement('div');
                card.className = `group relative bg-white border-2 cursor-pointer transition-all duration-300 hover:shadow-xl rounded-xl overflow-hidden ${
                    isSelected 
                        ? 'ring-2 border-blue-600' 
                        : isOutOfStock 
                            ? 'border-slate-300 border-2 opacity-60' 
                            : 'border-slate-200 hover:border-blue-600'
                }`;

                if (!isOutOfStock) {
                    card.onclick = () => selectPart(categoryId, component);
                }

                card.innerHTML = `
                    <div class="aspect-[3/2] relative overflow-hidden bg-slate-100">
                        <img src="${escapeHtml(component.image_url)}" 
                            class="w-full h-full object-cover transition-transform duration-500 ${isOutOfStock ? '' : 'group-hover:scale-105'}" 
                            onerror="this.src='https://via.placeholder.com/400x250?text=No+Image'"
                            alt="${escapeHtml(component.name)}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        
                        <!-- Stock Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider ${
                                component.in_stock 
                                    ? 'bg-blue-600 text-white' 
                                    : 'bg-red-500 text-white'
                            }">
                                ${component.in_stock ? 'In Stock' : 'Out of Stock'}
                            </span>
                        </div>
                        
                        <!-- Selected Check -->
                        ${isSelected ? `
                                <div class="absolute top-3 right-3 bg-blue-600 text-white rounded-full p-1.5 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            ` : ''}
                        
                        <!-- Price -->
                        <div class="absolute bottom-3 right-3">
                            <span class="font-mono font-bold text-lg text-white bg-black/50 backdrop-blur-sm px-3 py-1 rounded-lg">
                                Rs ${Number(component.price).toLocaleString()}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4 ${isSelected ? 'bg-green-50' : 'bg-white'}">
                        <h4 class="font-bold text-slate-800 text-sm sm:text-base line-clamp-2 ${!isOutOfStock ? 'group-hover:text-blue-600' : ''} transition-colors mb-1">
                            ${escapeHtml(component.name)}
                        </h4>
                        ${component.description 
                            ? `<p class="text-xs text-slate-500 line-clamp-2">${escapeHtml(component.description)}</p>` 
                            : ''
                        }
                    </div>
                `;
                optionsContainer.appendChild(card);
            });
        }

        // Close modal
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            document.body.style.overflow = '';
            currentModalCategory = null;
        }

        // Select a component
        function selectPart(categoryId, component) {
            selections[categoryId] = component;
            renderComponentList();
            updateUI();
            closeModal();
            showToast(`${component.name} selected`, 'success');
        }

        // Show review
        function showReview() {
            document.getElementById('view-builder').classList.add('hidden-view');
            document.getElementById('view-review').classList.remove('hidden-view');

            const summary = document.getElementById('summary-content');
            const total = Object.values(selections).reduce((sum, item) => sum + Number(item.price), 0);

            let componentsHtml = '';
            Object.entries(selections).forEach(([key, component]) => {
                const cat = categories.find(c => c.id == key);
                componentsHtml += `
                    <div class="flex justify-between items-center py-4 border-b border-slate-100 last:border-0">
                        <div class="flex items-center gap-4">
                            <img src="${escapeHtml(component.image_url)}" 
                                class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl object-cover border border-slate-200 shadow-sm" 
                                onerror="this.src='https://via.placeholder.com/100?text=No+Image'"
                                alt="${escapeHtml(component.name)}">
                            <div>
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-widest">${escapeHtml(cat?.name || 'Unknown')}</p>
                                <p class="font-bold text-slate-800 text-sm sm:text-base">${escapeHtml(component.name)}</p>
                            </div>
                        </div>
                        <p class="font-mono text-slate-700 font-bold text-sm sm:text-base">Rs ${Number(component.price).toLocaleString()}</p>
                    </div>
                `;
            });

            summary.innerHTML = `
                <!-- Selected Components -->
                <div class="mb-8">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Selected Components</h3>
                    ${componentsHtml}
                </div>

                <!-- Total -->
                <div class="bg-blue-300/20  rounded-2xl p-6 mb-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-widest">Total Investment</p>
                            <span class="text-3xl sm:text-4xl font-black text-blue-600">Rs ${total.toLocaleString()}</span>
                        </div>
                        <div class="text-center sm:text-right">
                            <p class="text-xs text-slate-500">${Object.keys(selections).length} components selected</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Your Details</h3>
                    <form id="checkout-form" onsubmit="handleCheckout(event)">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Full Name *</label>
                                <input type="text" name="customer_name" placeholder="John Doe" required 
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Email *</label>
                                <input type="email" name="customer_email" placeholder="john@example.com" required 
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Phone *</label>
                                <input type="tel" name="customer_phone" placeholder="+977 98XXXXXXXX" required 
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Company</label>
                                <input type="text" name="company_name" placeholder="Optional" 
                                    class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Additional Notes</label>
                            <textarea name="notes" placeholder="Any special requirements or questions..." rows="3" 
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition resize-none"></textarea>
                        </div>
                        <button type="submit" id="submit-btn"
                            class="w-full bg-blue-600 hover:bg-blue-800 text-white px-8 py-4 rounded-xl font-bold transition-all shadow-xl uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                            <span id="submit-btn-text">Submit Configuration</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            `;

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Handle form submission
        async function handleCheckout(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const customerData = Object.fromEntries(formData);

            const submitBtn = document.getElementById('submit-btn');
            const submitBtnText = document.getElementById('submit-btn-text');
            const originalText = submitBtnText.textContent;

            submitBtn.disabled = true;
            submitBtnText.innerHTML = '<div class="spinner spinner-sm mx-auto"></div>';

            try {
                const response = await fetch("{{ route('api.server-builder.submit') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        selections: selections,
                        customer: customerData,
                        total: Object.values(selections).reduce((sum, item) => sum + Number(item.price),
                            0)
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    showToast('Configuration submitted successfully! Our team will contact you soon.', 'success');
                    setTimeout(() => resetBuilder(), 1500);
                } else {
                    throw new Error(result.message || 'Failed to submit configuration');
                }
            } catch (error) {
                console.error('Error submitting configuration:', error);
                showToast(error.message || 'Failed to submit. Please try again.', 'error');
                submitBtn.disabled = false;
                submitBtnText.textContent = originalText;
            }
        }

        // Back to builder
        function backToBuilder() {
            document.getElementById('view-review').classList.add('hidden-view');
            document.getElementById('view-builder').classList.remove('hidden-view');
        }

        // Reset builder
        function resetBuilder() {
            selections = {};
            document.getElementById('view-builder').classList.add('hidden-view');
            document.getElementById('view-review').classList.add('hidden-view');
            document.getElementById('view-welcome').classList.remove('hidden-view');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show toast notification
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');

            const colors = {
                success: 'bg-blue-600',
                error: 'bg-red-500',
                info: 'bg-blue-500',
                warning: 'bg-yellow-500'
            };

            const icons = {
                success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />',
                error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />',
                info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />'
            };

            const toast = document.createElement('div');
            toast.className =
                `toast ${colors[type]} text-white px-4 py-3 rounded-xl shadow-2xl flex items-center gap-3 max-w-sm`;
            toast.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    ${icons[type]}
                </svg>
                <span class="text-sm font-medium flex-1">${escapeHtml(message)}</span>
                <button onclick="this.parentElement.remove()" class="hover:opacity-75 transition flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

            container.appendChild(toast);

            requestAnimationFrame(() => toast.classList.add('show'));

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endpush
