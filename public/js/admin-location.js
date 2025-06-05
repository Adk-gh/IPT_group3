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

        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                const target = tab.getAttribute('data-target');
                document.getElementById(target).classList.add('active');
            });
        });

        // Modal functionality
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Event listeners for modals
        document.getElementById('addLocationBtn').addEventListener('click', () => {
            openModal('addLocationModal');
            initLocationMap('locationMap', [14.5522, 121.0514]);
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            closeModal('addLocationModal');
        });

        document.getElementById('closeEditModal').addEventListener('click', () => {
            closeModal('editLocationModal');
        });

        document.getElementById('closeViewModal').addEventListener('click', () => {
            closeModal('viewLocationModal');
        });

        // Initialize maps
        function initAdminMap() {
            const map = L.map('adminMap').setView([14.5522, 121.0514], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add sample markers
            L.marker([14.5522, 121.0514]).addTo(map)
                .bindPopup('Bonifacio Wall')
                .openPopup();

            L.marker([14.5580, 121.0543]).addTo(map)
                .bindPopup('BGC Art Center');

            L.marker([14.5495, 121.0487]).addTo(map)
                .bindPopup('The Mind Museum Wall');
        }

        function initLocationMap(mapId, coords) {
            const map = L.map(mapId).setView(coords, 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add marker
            const marker = L.marker(coords).addTo(map)
                .bindPopup('Selected Location')
                .openPopup();

            // Add click event to update marker position
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                // Update form fields
                const latInput = document.querySelector('#locationForm input:nth-of-type(1)');
                const lngInput = document.querySelector('#locationForm input:nth-of-type(2)');
                if (latInput && lngInput) {
                    latInput.value = e.latlng.lat.toFixed(6);
                    lngInput.value = e.latlng.lng.toFixed(6);
                }
            });
        }

        function initViewLocationMap() {
            const map = L.map('viewLocationMap').setView([14.5522, 121.0514], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add marker
            L.marker([14.5522, 121.0514]).addTo(map)
                .bindPopup('Bonifacio Wall')
                .openPopup();
        }

        // Initialize all maps when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initAdminMap();

            // Add event listeners for view buttons in table
            document.querySelectorAll('.action-btn[title="View"]').forEach(btn => {
                btn.addEventListener('click', () => {
                    openModal('viewLocationModal');
                    setTimeout(initViewLocationMap, 100); // Small delay to ensure modal is visible
                });
            });

            // Add event listeners for edit buttons in table
            document.querySelectorAll('.action-btn[title="Edit"]').forEach(btn => {
                btn.addEventListener('click', () => {
                    openModal('editLocationModal');
                });
            });
        });

        // Select all checkbox functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('table input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Form submission
        document.getElementById('locationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Location saved successfully!');
            closeModal('addLocationModal');
        });

        document.getElementById('editLocationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Location updated successfully!');
            closeModal('editLocationModal');
        });
