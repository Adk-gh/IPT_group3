// Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mobileMenuBtn.innerHTML = sidebar.classList.contains('active') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });

        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            body.setAttribute('data-theme',
                body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');

            // Save preference to localStorage
            localStorage.setItem('theme', body.getAttribute('data-theme'));

            // Update icon
            themeToggle.innerHTML = body.getAttribute('data-theme') === 'dark' ?
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        });

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.setAttribute('data-theme', savedTheme);
            themeToggle.innerHTML = savedTheme === 'dark' ?
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        }

        // Report Modal
        const reportModal = document.getElementById('reportModal');
        const modalClose = document.getElementById('modalClose');
        const viewButtons = document.querySelectorAll('.action-btn.view');

        viewButtons.forEach(button => {
            button.addEventListener('click', () => {
                reportModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        modalClose.addEventListener('click', () => {
            reportModal.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Close modal when clicking outside
        reportModal.addEventListener('click', (e) => {
            if (e.target === reportModal) {
                reportModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Simulate loading data
        setTimeout(() => {
            document.querySelectorAll('.stat-value').forEach(el => {
                el.style.color = '#1cc88a';
                setTimeout(() => {
                    el.style.color = '';
                }, 500);
            });
        }, 1000);

        // Simulate notification click
        document.querySelector('.notification-btn').addEventListener('click', () => {
            alert('Notification center would open here showing recent system alerts and messages.');
        });

        // Simulate user dropdown
        document.querySelector('.user-menu').addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelector('.user-dropdown').classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            document.querySelector('.user-dropdown').classList.remove('active');
        });
