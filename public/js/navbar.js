
    // ================================================
    // NAVBAR & INTERACTIVE ELEMENTS LOGIC
    // ================================================

    document.addEventListener('DOMContentLoaded', () => {
        // ====== 1. SMART SCROLL BEHAVIOR ======
        const navbar = document.getElementById('navbar');
        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {   
            const currentScrollY = window.scrollY;
            
            // Add/remove scrolled class for styling
            if (currentScrollY > 50) {
                navbar.classList.add('nav-scrolled');
            } else {
                navbar.classList.remove('nav-scrolled');
            }

            // Hide/show navbar on scroll direction change
            if (currentScrollY > lastScrollY && currentScrollY > 100) {
                navbar.classList.add('nav-hidden');
                navbar.classList.remove('nav-visible');
            } else {
                navbar.classList.remove('nav-hidden');
                navbar.classList.add('nav-visible');
            }
            
            lastScrollY = currentScrollY;
        });

        // ====== 2. MOBILE MENU TOGGLE ======
        const hamburger = document.getElementById('hamburger');
        const offCanvasMenu = document.getElementById('offCanvasMenu');
        const closeBtn = document.getElementById('closeBtn');
        const overlay = document.getElementById('overlay');

        // Open Mobile Menu
        function openMobileMenu() {
            offCanvasMenu.classList.remove('translate-x-full');
            offCanvasMenu.classList.add('translate-x-0');
            overlay.classList.remove('opacity-0', 'invisible');
            overlay.classList.add('opacity-100', 'visible');
            hamburger.classList.add('active');
            document.body.classList.add('overflow-hidden');
            hamburger.setAttribute('aria-expanded', 'true');
        }

        // Close Mobile Menu
        function closeMobileMenu() {
            offCanvasMenu.classList.add('translate-x-full');
            offCanvasMenu.classList.remove('translate-x-0');
            overlay.classList.add('opacity-0', 'invisible');
            overlay.classList.remove('opacity-100', 'visible');
            hamburger.classList.remove('active');
            document.body.classList.remove('overflow-hidden');
            hamburger.setAttribute('aria-expanded', 'false');
        }

        // Event Listeners
        hamburger.addEventListener('click', () => {
            offCanvasMenu.classList.contains('translate-x-full') 
                ? openMobileMenu() 
                : closeMobileMenu();
        });

        closeBtn.addEventListener('click', closeMobileMenu);
        overlay.addEventListener('click', closeMobileMenu);

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !offCanvasMenu.classList.contains('translate-x-full')) {
                closeMobileMenu();
            }
        });

        // Close on resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) closeMobileMenu();
        });

        // ====== 3. DESKTOP PRODUCTS DROPDOWN ======
        const productTrigger = document.getElementById('product-trigger');
        const megaMenu = document.getElementById('mega-menu');

        function toggleMegaMenu() {
            megaMenu.classList.toggle('active');
            productTrigger.querySelector('i').classList.toggle('rotate-180');
        }

        // Desktop hover/click handling
        productTrigger.addEventListener('mouseenter', () => megaMenu.classList.add('active'));
        productTrigger.addEventListener('mouseleave', () => megaMenu.classList.remove('active'));
        megaMenu.addEventListener('mouseenter', () => megaMenu.classList.add('active'));
        megaMenu.addEventListener('mouseleave', () => megaMenu.classList.remove('active'));
        productTrigger.addEventListener('click', toggleMegaMenu);

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!productTrigger.contains(e.target) && !megaMenu.contains(e.target)) {
                megaMenu.classList.remove('active');
                productTrigger.querySelector('i').classList.remove('rotate-180');
            }
        });

        // ====== 4. MOBILE PRODUCTS SUBMENU ======
        const mobileProductBtn = document.getElementById('mobile-product-btn');
        const mobileProductMenu = document.getElementById('mobile-product-menu');
        const mobileChevron = document.getElementById('mobile-chevron');

        mobileProductBtn.addEventListener('click', () => {
            mobileProductMenu.classList.toggle('active');
            mobileChevron.classList.toggle('rotate-180');
        });
    });
