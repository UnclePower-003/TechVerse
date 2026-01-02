document.addEventListener("DOMContentLoaded", () => {
    const mobileToggle = document.getElementById("mobile-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const burgerIcon = document.getElementById("burger-icon");
    const closeIcon = document.getElementById("close-icon");
    const body = document.body;

    // 1. Handle Main Mobile Menu Toggle
    mobileToggle.addEventListener("click", () => {
        const isHidden = mobileMenu.classList.contains("hidden");

        if (isHidden) {
            // Open Menu
            mobileMenu.classList.remove("hidden");
            burgerIcon.classList.add("hidden");
            closeIcon.classList.remove("hidden");
            // Lock Scroll
            body.style.overflow = "hidden";
        } else {
            // Close Menu
            mobileMenu.classList.add("hidden");
            burgerIcon.classList.remove("hidden");
            closeIcon.classList.add("hidden");
            // Unlock Scroll
            body.style.overflow = "";
        }
    });

    // 2. Handle Mobile Dropdowns (Accordion Style)
    const mobileDropdownBtns = document.querySelectorAll(
        ".mobile-dropdown-btn"
    );

    mobileDropdownBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            // Toggle chevron rotation
            const icon = this.querySelector(".chevron-icon");
            icon.classList.toggle("rotate-180");

            // Toggle submenu height
            const submenu = this.nextElementSibling;
            submenu.classList.toggle("open");
        });
    });

    // 3. Cleanup on Resize
    // If user resizes to desktop while mobile menu is open, we need to reset
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            mobileMenu.classList.add("hidden");
            burgerIcon.classList.remove("hidden");
            closeIcon.classList.add("hidden");
            body.style.overflow = "";
        }
    });
});

function toggleDropdown() {
    const dropdown = document.getElementById("productDropdown");
    const wrapper = document.getElementById("productDropdownWrapper");

    // Toggle the active class on the dropdown
    dropdown.classList.toggle("active");
    wrapper.classList.toggle("active"); // For the chevron rotation
}

// Optional: Close dropdown when clicking outside
document.addEventListener("click", function (event) {
    const wrapper = document.getElementById("productDropdownWrapper");
    const dropdown = document.getElementById("productDropdown");

    if (!wrapper.contains(event.target)) {
        dropdown.classList.remove("active");
        wrapper.classList.remove("active");
    }
});

function toggleMobileProducts() {
    const content = document.getElementById("mobileProductContent");
    const icon = document.getElementById("mobileChevron");

    // Toggle Visibility
    if (content.classList.contains("hidden")) {
        content.classList.remove("hidden");
        // Rotate icon 180 degrees
        icon.classList.add("rotate-180");
    } else {
        content.classList.add("hidden");
        // Reset icon rotation
        icon.classList.remove("rotate-180");
    }
}
