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







        document.addEventListener('DOMContentLoaded', function() {
    // Fetch data from Laravel backend
    fetch('/admin/dashboard/chart-data')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Initialize charts with real data
            initUserGrowthChart(data.user_growth, data.user_growth_labels);
            initArtworkUploadsChart(data.artwork_types, data.artwork_types_labels);
            initMonthlyUploadsChart(data.monthly_uploads, data.monthly_uploads_labels);
        })
        .catch(error => {
            console.error('Error fetching chart data:', error);
            // You might want to display an error message to the admin here
        });


    // User Growth Chart (Line Chart)
    function initUserGrowthChart(userData = [], labels = []) {
        const ctx = document.getElementById('userGrowthChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'User Growth (Last 6 Months)',
                    data: userData.length ? userData : [0, 0, 0, 0, 0, 0],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: true
                }]
            },
            options: getLineChartOptions('User Growth')
        });
    }

    // Artwork Uploads Chart (Bar Chart)
    function initArtworkUploadsChart(artworkData = [], labels = []) {
        const ctx = document.getElementById('artworkUploadsChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels.length ? labels : ['Paintings', 'Sculptures', 'Digital', 'Photography', 'Other'],
                datasets: [{
                    label: 'Artwork by Category',
                    data: artworkData.length ? artworkData : [0, 0, 0, 0, 0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: getBarChartOptions('Artwork Count')
        });
    }

    // Monthly Uploads Chart (Line Chart)
    function initMonthlyUploadsChart(uploadData = [], labels = []) {
        const ctx = document.getElementById('monthlyUploadsChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Artwork Uploads',
                    data: uploadData.length ? uploadData : Array(12).fill(0),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.1,
                    fill: true
                }]
            },
            options: getLineChartOptions('Monthly Uploads')
        });
    }

    // Common chart options
    function getLineChartOptions(title) {
        return {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 16
                    }
                },
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        };
    }

    function getBarChartOptions(title) {
        return {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 16
                    }
                },
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
    }
});

async function fetchChartData() {
    try {
        const response = await fetch('/api/chart-data', {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'include'
        });

        // First check if response is OK
        if (!response.ok) {
            const errorData = await response.text();
            throw new Error(`Server responded with ${response.status}: ${errorData}`);
        }

        // Then try to parse as JSON
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching chart data:', error);

        // Handle unauthorized (401) specifically
        if (error.message.includes('401')) {
            window.location.reload(); // Force page refresh which should redirect to login
        }

        return null;
    }
}
