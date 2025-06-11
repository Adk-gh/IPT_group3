document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;
    const icon = toggleButton.querySelector('i');

    // Function to update icon based on theme
    function updateIcon(theme) {
        if (theme === 'dark') {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    }

    // Load theme from localStorage and update icon
    const savedTheme = localStorage.getItem('theme') || 'light';
    if (savedTheme === 'dark') {
        htmlElement.setAttribute('data-theme', 'dark');
    } else {
        htmlElement.removeAttribute('data-theme');
    }
    updateIcon(savedTheme);

    // Theme toggle button click handler
    toggleButton.addEventListener('click', function () {
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

    // --- Your existing profile dropdown code here ---
});

document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.getElementById('mobileMenuBtn');
    const nav = document.getElementById('mainNav');

    if (menuBtn && nav) {
        menuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
    }
});

nav.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        nav.classList.remove('active');
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.querySelector(".mobile-menu-btn");
    const nav = document.querySelector("nav");

    menuBtn.addEventListener("click", function () {
      nav.classList.toggle("active");
    });
  });

