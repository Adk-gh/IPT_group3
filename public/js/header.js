document.addEventListener('DOMContentLoaded', function() {
    // ======================
    // Theme Toggle Functionality
    // ======================
    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;
    
    if (themeToggle) {
        const icon = themeToggle.querySelector('i');
        
        function updateIcon(theme) {
            if (theme === 'dark') {
                icon.classList.replace('fa-moon', 'fa-sun');
            } else {
                icon.classList.replace('fa-sun', 'fa-moon');
            }
        }
        
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            htmlElement.setAttribute('data-theme', 'dark');
        }
        updateIcon(savedTheme);
        
        themeToggle.addEventListener('click', function() {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            if (newTheme === 'dark') {
                htmlElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                htmlElement.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            }
            
            updateIcon(newTheme);
        });
    }

    // ======================
    // Mobile Menu Functionality
    // ======================
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const nav = document.getElementById('nav');
    const header = document.getElementById('header');
    
    if (mobileMenuBtn && nav) {
        mobileMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            nav.classList.toggle('active');
            mobileMenuBtn.innerHTML = nav.classList.contains('active') 
                ? '<i class="fas fa-times"></i>' 
                : '<i class="fas fa-bars"></i>';
        });
        
        nav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                nav.classList.remove('active');
                mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            });
        });
        
        document.addEventListener('click', function(e) {
            if (!nav.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                nav.classList.remove('active');
                mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
    }
    
    // ======================
    // Header Scroll Effect
    // ======================
    if (header) {
        window.addEventListener('scroll', function() {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    }
    
    // ======================
    // Enhanced Profile Dropdown
    // ======================
    const profileContainer = document.querySelector('.profile-container');
    const profileBtn = document.querySelector('.profile-btn');
    const profileDropdown = document.querySelector('.profile-dropdown');
    
    if (profileContainer && profileBtn && profileDropdown) {
        // Click handler for profile button
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('show-dropdown');
        });
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileContainer.contains(e.target)) {
                profileDropdown.classList.remove('show-dropdown');
            }
        });
        
        // Close when clicking on dropdown items
        profileDropdown.querySelectorAll('a').forEach(item => {
            item.addEventListener('click', () => {
                profileDropdown.classList.remove('show-dropdown');
            });
        });
        
        // Optional: Hover functionality for desktop
        if (window.matchMedia('(min-width: 769px)').matches) {
            profileContainer.addEventListener('mouseenter', function() {
                profileDropdown.classList.add('show-dropdown');
            });
            
            profileContainer.addEventListener('mouseleave', function() {
                profileDropdown.classList.remove('show-dropdown');
            });
        }
    }
});