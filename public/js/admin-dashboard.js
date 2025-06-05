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

        // Initialize Admin Map
        const adminMap = L.map('adminMap').setView([40.7128, -74.0060], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(adminMap);

        // Add sample markers for street art locations
        const adminLocations = [
            {
                lat: 40.7128,
                lng: -74.0060,
                title: "Banksy Mural",
                type: "stencil",
                status: "verified"
            },
            {
                lat: 40.7150,
                lng: -74.0080,
                title: "Colorful Abstract",
                type: "mural",
                status: "verified"
            },
            {
                lat: 40.7100,
                lng: -74.0050,
                title: "Political Statement",
                type: "political",
                status: "pending"
            },
            {
                lat: 40.7135,
                lng: -74.0030,
                title: "Neon Installation",
                type: "installation",
                status: "verified"
            },
            {
                lat: 40.7145,
                lng: -74.0090,
                title: "New Tagging",
                type: "tagging",
                status: "reported"
            }
        ];

        // Create custom icons with different colors
        const verifiedIcon = L.divIcon({
            className: 'verified-marker',
            html: '<i class="fas fa-map-marker-alt"></i>',
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });

        const pendingIcon = L.divIcon({
            className: 'pending-marker',
            html: '<i class="fas fa-map-marker-alt"></i>',
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });

        const reportedIcon = L.divIcon({
            className: 'reported-marker',
            html: '<i class="fas fa-map-marker-alt"></i>',
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });

        // Add markers to the admin map
        adminLocations.forEach(location => {
            let icon;

            if (location.status === "verified") {
                icon = verifiedIcon;
            } else if (location.status === "pending") {
                icon = pendingIcon;
            } else {
                icon = reportedIcon;
            }

            const marker = L.marker([location.lat, location.lng], { icon: icon }).addTo(adminMap);
            marker.bindPopup(`
                <h3>${location.title}</h3>
                <p>Type: ${location.type}</p>
                <p>Status: <strong>${location.status}</strong></p>
                <div style="display: flex; gap: 5px; margin-top: 10px;">
                    <button style="padding: 5px 10px; background: #4e73df; color: white; border: none; border-radius: 4px; cursor: pointer;">Approve</button>
                    <button style="padding: 5px 10px; background: #e74a3b; color: white; border: none; border-radius: 4px; cursor: pointer;">Remove</button>
                </div>
            `);
        });

        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-target');

                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(target).classList.add('active');
            });
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
