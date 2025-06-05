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

        // Confirm restore checkbox
        const confirmRestore = document.getElementById('confirm-restore');
        const restoreBtn = document.querySelector('.form-actions .btn');

        confirmRestore.addEventListener('change', () => {
            restoreBtn.disabled = !confirmRestore.checked;
            restoreBtn.classList.toggle('btn-secondary', !confirmRestore.checked);
            restoreBtn.classList.toggle('btn-primary', confirmRestore.checked);
        });

        // Simulate backup progress
        document.querySelector('.backup-tools .btn-lg').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;

            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Running Backup...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Backup Complete';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;

                    // Show notification
                    const notificationBadge = document.querySelector('.notification-badge');
                    notificationBadge.textContent = parseInt(notificationBadge.textContent) + 1;
                    notificationBadge.style.animation = 'pulse 0.5s 2';

                    setTimeout(() => {
                        notificationBadge.style.animation = '';
                    }, 1000);
                }, 2000);
            }, 3000);
        });
