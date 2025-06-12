document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mobileMenuBtn.innerHTML = sidebar.classList.contains('active') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });
    }

    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const newTheme = body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            themeToggle.innerHTML = newTheme === 'dark' ?
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        });

        // Initialize theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        body.setAttribute('data-theme', savedTheme);
        themeToggle.innerHTML = savedTheme === 'dark' ?
            '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    }

    // View Toggle
    const tableViewBtn = document.getElementById('tableViewBtn');
    const gridViewBtn = document.getElementById('gridViewBtn');
    const tableView = document.getElementById('tableView');
    const gridView = document.getElementById('gridView');

    if (tableViewBtn && gridViewBtn && tableView && gridView) {
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

        // Initialize view (show table by default)
        tableViewBtn.classList.add('active');
        tableView.style.display = 'block';
        gridView.style.display = 'none';
    }

    // Modal Functions
    window.openArtModal = function(title) {
        const modal = document.getElementById('artModal');
        if (modal) {
            const titleElement = document.getElementById('modalArtTitle');
            if (titleElement) titleElement.textContent = title;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeArtModal = function() {
        const modal = document.getElementById('artModal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    };

    window.openEditArtModal = function() {
        const modal = document.getElementById('editArtModal');
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeEditArtModal = function() {
        const modal = document.getElementById('editArtModal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    };

    // Close modals when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === document.getElementById('artModal')) {
            closeArtModal();
        }
        if (e.target === document.getElementById('editArtModal')) {
            closeEditArtModal();
        }
    });

    // Notification button
    const notificationBtn = document.querySelector('.notification-btn');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', () => {
            alert('Notification center would open here showing recent system alerts and messages.');
        });
    }

    // User dropdown
    const userMenu = document.querySelector('.user-menu');
    const userDropdown = document.querySelector('.user-dropdown');

    if (userMenu && userDropdown) {
        userMenu.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });

        document.addEventListener('click', () => {
            userDropdown.classList.remove('active');
        });
    }

    // View buttons in table and grid
    document.querySelectorAll('.action-btn.view').forEach(btn => {
        btn.addEventListener('click', function() {
            // Works for both table and grid views
            const card = this.closest('tr, .art-card');
            if (card) {
                const titleElement = card.querySelector('.art-title, .art-card-title');
                if (titleElement) {
                    openArtModal(titleElement.textContent.trim());
                }
            }
        });
    });

    // Bulk select all checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', (e) => {
            const checkboxes = document.querySelectorAll('table tbody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });
    }

    // Edit buttons - adding event listeners if they exist
    document.querySelectorAll('.action-btn.edit').forEach(btn => {
        btn.addEventListener('click', openEditArtModal);
    });
});
