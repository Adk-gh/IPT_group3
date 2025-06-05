  document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;

        // Load theme from localStorage if available
        if (localStorage.getItem('theme') === 'dark') {
            htmlElement.setAttribute('data-theme', 'dark');
        }

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
        });
    });

        // Add this for mobile profile dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const profileBtn = document.querySelector('.profile-btn');
            const profileDropdown = document.querySelector('.profile-dropdown');

            if (profileBtn) {
                profileBtn.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        profileDropdown.style.display =
                            profileDropdown.style.display === 'block' ? 'none' : 'block';
                    }
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.profile-container') && window.innerWidth <= 768) {
                    profileDropdown.style.display = 'none';
                }
            });
        });
