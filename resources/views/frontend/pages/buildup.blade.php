@extends('frontend.app')

@section('content')
    <title>Server Builder | TechVerse</title>
    @push('style')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

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

            /* Scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }

            ::-webkit-scrollbar-track {
                background: #1f2937;
            }

            ::-webkit-scrollbar-thumb {
                background: #4b5563;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #6b7280;
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

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    @endpush

    <!-- Main Container -->
    <main class="mt-10 pb-12 min-h-screen">

        <!-- Server Builder Welcome -->
        <section id="view-welcome" class="max-w-4xl mx-auto px-4 sm:px-6 fade-in">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-5xl md:text-6xl font-extrabold mb-4 tracking-tight text-slate-800">
                    Build your <span class="text-green-600">Enterprise Server</span>
                </h2>
                <p class="text-slate-500 text-base sm:text-lg max-w-2xl mx-auto px-4">
                    Configure scalable infrastructure designed for 24/7 reliability and massive throughput.
                </p>
            </div>

            <div class="max-w-2xl mx-auto">
                <div onclick="initBuilder()"
                    class="group cursor-pointer bg-[#e5effa] rounded-3xl shadow-xl hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="aspect-[16/9] overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('imagess/buildupimages/server.png') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1558494949-efc5e66cd38f?auto=format&fit=crop&q=80&w=800'"
                            alt="Server" class="w-full h-full object-cover transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#e5effa] via-transparent to-transparent opacity-90">
                        </div>
                    </div>
                    <div class="p-6 sm:p-8 relative -mt-16">
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-2">Enterprise Server</h3>
                        <p class="text-slate-500 text-sm sm:text-base mb-6 leading-relaxed">Scalable infrastructure designed
                            for 24/7 reliability and massive throughput.</p>
                        <span
                            class="inline-flex items-center text-green-600 font-bold uppercase text-xs sm:text-sm tracking-widest group-hover:gap-2 transition-all">
                            Start Configuration
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Component Builder View -->
        <section id="view-builder" class="hidden-view max-w-4xl mx-auto px-4 sm:px-6 pb-40 fade-in">
            <div class="w-full py-4 flex justify-between text-center">
                <div class="flex justify-center items-center text-center">
                    <p class='bg-white text-green-600 py-1 px-4 rounded-full font-bold text-sm'>Enterprise Server</p>
                </div>
                <button onclick="resetBuilder()"
                    class="text-xs font-bold text-slate-200 bg-green-600 p-3 rounded-lg hover:bg-green-700 transition uppercase tracking-widest flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span class="hidden sm:inline">Start Over</span>
                </button>
            </div>

            <div class="text-center py-8" id="loading-indicator">
                <div class="spinner mx-auto mb-4"></div>
                <p class="text-slate-500">Loading server components...</p>
            </div>

            <div id="component-list" class="space-y-3"></div>
        </section>

        <!-- Review View -->
        <section id="view-review" class="hidden-view max-w-4xl mx-auto px-4 sm:px-6 fade-in">
            <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-10">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-800">Configuration Review</h2>
                    <button onclick="backToBuilder()"
                        class="text-slate-400 hover:text-slate-600 font-bold uppercase text-xs tracking-widest flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back
                    </button>
                </div>
                <div id="summary-content"></div>
            </div>
        </section>

        <!-- Component Selection Modal -->
        <div id="modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-slate-900 bg-opacity-75" onclick="closeModal()"></div>
                <div
                    class="inline-block w-full max-w-5xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl">
                    <div class="flex justify-between items-center mb-6">
                        <h3 id="modal-title" class="text-2xl font-extrabold text-slate-800">Select Component</h3>
                        <button onclick="closeModal()"
                            class="text-slate-400 hover:text-slate-600 transition text-3xl leading-none">&times;</button>
                    </div>
                    <div id="modal-options"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 max-h-[60vh] overflow-y-auto pr-2">
                        <!-- Options will be loaded here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Fixed Bottom Bar -->
        <div id="bottom-bar"
            class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 shadow-2xl p-4 transition-transform duration-300 z-40">
            <div class="max-w-4xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div id="selection-count" class="flex gap-1.5"></div>
                    <div class="text-left">
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Total Cost</p>
                        <span id="total-price" class="text-xl sm:text-2xl font-black text-green-600">Rs 0</span>
                    </div>
                </div>
                <button id="review-btn" onclick="showReview()" disabled
                    class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold transition disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-widest text-sm">
                    Select Components
                </button>
            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            let selections = {};
            let categories = [];
            const apiBaseUrl = "{{ route('api.server-builder.categories') }}".replace('/categories', '');

            async function initBuilder() {
                document.getElementById('view-welcome').classList.add('hidden-view');
                document.getElementById('view-builder').classList.remove('hidden-view');
                document.getElementById('bottom-bar').classList.remove('translate-y-full');

                await loadCategories();
            }

            async function loadCategories() {
                try {
                    const response = await fetch("{{ route('api.server-builder.categories') }}", {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to load categories');

                    const data = await response.json();
                    categories = data.categories;

                    document.getElementById('loading-indicator').style.display = 'none';
                    renderComponentList();
                } catch (error) {
                    console.error('Error loading categories:', error);
                    document.getElementById('loading-indicator').innerHTML = `
                        <p class="text-red-500">Failed to load components. Please try again.</p>
                        <button onclick="loadCategories()" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg">Retry</button>
                    `;
                }
            }

            function renderComponentList() {
                const container = document.getElementById('component-list');
                container.innerHTML = '';

                categories.forEach(category => {
                    const selected = selections[category.id];
                    const div = document.createElement('div');
                    div.className =
                        `bg-white rounded-xl p-4 sm:p-6 shadow-md hover:shadow-lg transition-all cursor-pointer group ${selected ? 'border-2 border-green-500' : 'border-2 border-transparent'}`;
                    div.onclick = () => openModal(category.id);

                    div.innerHTML = `
                        <div class="flex justify-between items-center">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="font-bold text-slate-800 text-sm sm:text-base">${category.name}</h3>
                                    ${category.required ? '<span class="text-[9px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Required</span>' : ''}
                                </div>
                                ${selected ? `
                                            <div class="flex items-center gap-3">
                                                <img src="${selected.image_url}" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                                                <div>
                                                    <p class="text-slate-800 font-semibold text-xs sm:text-sm">${selected.name}</p>
                                                    <p class="text-green-600 font-mono font-bold text-sm">Rs ${Number(selected.price).toLocaleString()}</p>
                                                </div>
                                            </div>
                                        ` : `
                                            <p class="text-slate-400 text-xs sm:text-sm">Click to select ${category.name.toLowerCase()}</p>
                                        `}
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-green-600 transition-colors flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    `;
                    container.appendChild(div);
                });

                updateProgressDots();
            }

            function updateProgressDots() {
                const dotContainer = document.getElementById('selection-count');
                dotContainer.innerHTML = '';

                categories.forEach(cat => {
                    const dot = document.createElement('div');
                    const isSelected = !!selections[cat.id];
                    dot.className =
                        `h-2 rounded-full transition-all duration-300 ${isSelected ? 'bg-green-500 w-6' : 'bg-slate-300 w-2'}`;
                    dotContainer.appendChild(dot);
                });
            }

            async function openModal(categoryId) {
                const category = categories.find(c => c.id === categoryId);
                document.getElementById('modal-title').innerText = `Select ${category.name}`;

                const optionsContainer = document.getElementById('modal-options');
                optionsContainer.innerHTML =
                    '<div class="col-span-full text-center py-8"><div class="spinner mx-auto"></div></div>';

                document.getElementById('modal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                try {
                    const response = await fetch(`${apiBaseUrl}/components/${categoryId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (!response.ok) throw new Error('Failed to load components');

                    const data = await response.json();
                    displayOptions(categoryId, data.components);
                } catch (error) {
                    console.error('Error loading components:', error);
                    optionsContainer.innerHTML =
                        '<div class="col-span-full text-center py-8 text-red-500">Failed to load options. Please try again.</div>';
                }
            }

            function displayOptions(categoryId, components) {
                const optionsContainer = document.getElementById('modal-options');
                optionsContainer.innerHTML = '';

                components.forEach(component => {
                    const isSelected = selections[categoryId] && selections[categoryId].id === component.id;

                    const card = document.createElement('div');
                    card.className =
                        `group relative h-auto bg-white border-2 cursor-pointer transition-all duration-300 hover:shadow-lg rounded-lg overflow-clip ${isSelected ? 'border-green-400' : 'border-slate-200'}`;
                    card.onclick = () => selectPart(categoryId, component);

                    card.innerHTML = `
                        <div class="aspect-[2/1] relative overflow-hidden">
                            <img src="${component.image_url}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-2 left-2 right-2 flex justify-between items-center">
                                <span class="text-[9px] font-bold bg-green-600 text-white px-2 py-0.5 rounded-full uppercase tracking-wider">
                                    ${component.in_stock ? 'In Stock' : 'Out of Stock'}
                                </span>
                                <span class="font-mono font-bold text-sm sm:text-base text-white">
                                    Rs ${Number(component.price).toLocaleString()}
                                </span>
                            </div>
                        </div>
                        <div class="p-3 sm:p-4 bg-[#e5effa]">
                            <h4 class="font-bold text-slate-800 text-xs sm:text-sm line-clamp-2 group-hover:text-green-600 transition-colors">
                                ${component.name}
                            </h4>
                            ${component.description ? `<p class="text-[10px] text-slate-400 mt-1 line-clamp-2">${component.description}</p>` : ''}
                        </div>
                        ${isSelected ? `
                                    <div class="absolute top-2 right-2 bg-green-600 text-white rounded-full p-1 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                ` : ''}
                    `;
                    optionsContainer.appendChild(card);
                });
            }

            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
                document.body.style.overflow = '';
            }

            function selectPart(categoryId, component) {
                selections[categoryId] = component;
                renderComponentList();
                updateTotal();
                closeModal();
            }

            function updateTotal() {
                const total = Object.values(selections).reduce((sum, item) => sum + Number(item.price), 0);
                document.getElementById('total-price').innerText = `Rs ${total.toLocaleString()}`;

                const requiredCategories = categories.filter(cat => cat.required);
                const requiredSelected = requiredCategories.filter(cat => selections[cat.id]).length;

                const btn = document.getElementById('review-btn');
                btn.disabled = requiredSelected < requiredCategories.length;
                btn.innerText = requiredSelected < requiredCategories.length ?
                    `Select ${requiredSelected}/${requiredCategories.length} Required` :
                    'Review Configuration';
            }

            function showReview() {
                document.getElementById('view-builder').classList.add('hidden-view');
                document.getElementById('view-review').classList.remove('hidden-view');
                document.getElementById('bottom-bar').classList.add('translate-y-full');

                const summary = document.getElementById('summary-content');
                summary.innerHTML = `
                    <div class="mb-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                        <span class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Server Specification</span>
                        <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest border border-green-100">Enterprise Server</span>
                    </div>
                `;

                Object.entries(selections).forEach(([key, component]) => {
                    const cat = categories.find(c => c.id == key);
                    summary.innerHTML += `
                        <div class="flex justify-between items-center py-3 border-b border-slate-50 last:border-0">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <img src="${component.image_url}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg object-cover border border-slate-200">
                                <div>
                                    <p class="text-[9px] text-slate-400 uppercase font-black tracking-widest">${cat.name}</p>
                                    <p class="font-bold text-slate-800 text-sm sm:text-base">${component.name}</p>
                                </div>
                            </div>
                            <p class="font-mono text-slate-600 font-bold text-sm sm:text-base">Rs ${Number(component.price).toLocaleString()}</p>
                        </div>
                    `;
                });

                const total = Object.values(selections).reduce((sum, item) => sum + Number(item.price), 0);
                summary.innerHTML += `
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                            <div class="text-center sm:text-left">
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Total Investment</p>
                                <span class="text-3xl font-black text-green-600 leading-none">Rs ${total.toLocaleString()}</span>
                            </div>
                        </div>
                        <form id="checkout-form" onsubmit="handleCheckout(event)">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <input type="text" name="customer_name" placeholder="Full Name" required class="px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                <input type="email" name="customer_email" placeholder="Email" required class="px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                <input type="tel" name="customer_phone" placeholder="Phone Number" required class="px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                <input type="text" name="company_name" placeholder="Company Name (Optional)" class="px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            <textarea name="notes" placeholder="Additional notes or requirements..." rows="3" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mb-4"></textarea>
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold transition shadow-xl shadow-green-500/20 uppercase tracking-widest text-sm">
                                Submit Configuration
                            </button>
                        </form>
                    </div>
                `;

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            async function handleCheckout(event) {
                event.preventDefault();

                const formData = new FormData(event.target);
                const customerData = Object.fromEntries(formData);

                const submitButton = event.target.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML =
                    '<div class="spinner mx-auto" style="width: 24px; height: 24px; border-width: 2px;"></div>';

                try {
                    const response = await fetch("{{ route('api.server-builder.submit') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
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
                        alert('Configuration submitted successfully! Our team will contact you soon.');
                        resetBuilder();
                    } else {
                        throw new Error(result.message || 'Failed to submit configuration');
                    }
                } catch (error) {
                    console.error('Error submitting configuration:', error);
                    alert('Failed to submit configuration. Please try again.');
                    submitButton.disabled = false;
                    submitButton.textContent = 'Submit Configuration';
                }
            }

            function backToBuilder() {
                document.getElementById('view-review').classList.add('hidden-view');
                document.getElementById('view-builder').classList.remove('hidden-view');
                document.getElementById('bottom-bar').classList.remove('translate-y-full');
            }

            function resetBuilder() {
                selections = {};
                document.getElementById('view-builder').classList.add('hidden-view');
                document.getElementById('view-review').classList.add('hidden-view');
                document.getElementById('view-welcome').classList.remove('hidden-view');
                document.getElementById('bottom-bar').classList.add('translate-y-full');
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        </script>
    @endpush
@endsection
