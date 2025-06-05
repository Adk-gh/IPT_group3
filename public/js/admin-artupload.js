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

        // View Toggle
        const tableViewBtn = document.getElementById('tableViewBtn');
        const gridViewBtn = document.getElementById('gridViewBtn');
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');

        tableViewBtn.addEventListener('click', () => {
            tableViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
            tableView.style.display = 'block';
            gridView.style.display = 'none';
        });

        gridViewBtn.addEventListener('click', () => {
            gridViewBtn.classList.add('active');
            tableViewBtn.classList.remove('active');
            gridView.style.display = 'grid';
            tableView.style.display = 'none';
        });

        // Artwork Modal
        function openArtModal(title) {
            document.getElementById('modalArtTitle').textContent = title;
            document.getElementById('artModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeArtModal() {
            document.getElementById('artModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Edit Artwork Modal
        function openEditArtModal() {
            document.getElementById('editArtModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeEditArtModal() {
            document.getElementById('editArtModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === document.getElementById('artModal')) {
                closeArtModal();
            }
            if (e.target === document.getElementById('editArtModal')) {
                closeEditArtModal();
            }
        });

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

        // View buttons in table
        document.querySelectorAll('.action-btn.view').forEach(btn => {
            btn.addEventListener('click', () => {
                const title = btn.closest('tr').querySelector('.art-title').textContent;
                openArtModal(title);
            });
        });

        // Edit buttons in table
        document.querySelectorAll('.action-btn.edit').forEach(btn => {
            btn.addEventListener('click', openEditArtModal);
        });

        // Bulk select all checkbox
        document.getElementById('selectAll').addEventListener('change', (e) => {
            const checkboxes = document.querySelectorAll('table tbody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });
