 // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const nav = document.getElementById('nav');

        mobileMenuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
            mobileMenuBtn.innerHTML = nav.classList.contains('active') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });

        // Header Scroll Effect
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth Scrolling for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    if (nav.classList.contains('active')) {
                        nav.classList.remove('active');
                        mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                }
            });
        });

        // Dark Mode Toggle
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

        // Initialize World Map
        const artistMap = L.map('artistWorldMap').setView([20, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(artistMap);

        // Add sample markers for artist locations
        const artistLocations = [
            {
                lat: 51.4545,
                lng: -2.5879,
                name: "Banksy",
                city: "Bristol, UK",
                type: "stencil"
            },
            {
                lat: 34.0522,
                lng: -118.2437,
                name: "Shepard Fairey",
                city: "Los Angeles, USA",
                type: "stencil"
            },
            {
                lat: 40.6782,
                lng: -73.9442,
                name: "Maya Hayuk",
                city: "Brooklyn, USA",
                type: "mural"
            },
            {
                lat: 39.4699,
                lng: -0.3763,
                name: "Felipe Pantone",
                city: "Valencia, Spain",
                type: "digital"
            },
            {
                lat: 48.8566,
                lng: 2.3522,
                name: "JR",
                city: "Paris, France",
                type: "photography"
            },
            {
                lat: 40.7128,
                lng: -74.0060,
                name: "Swoon",
                city: "New York, USA",
                type: "wheatpaste"
            },
            {
                lat: 38.7223,
                lng: -9.1393,
                name: "Vhils",
                city: "Lisbon, Portugal",
                type: "carving"
            },
            {
                lat: 44.4949,
                lng: 11.3426,
                name: "Blu",
                city: "Bologna, Italy",
                type: "mural"
            }
        ];

        // Create custom icons for different artist types
        const stencilIcon = L.divIcon({
            className: 'stencil-marker',
            html: '<i class="fas fa-cut"></i>',
            iconSize: [30, 30]
        });

        const muralIcon = L.divIcon({
            className: 'mural-marker',
            html: '<i class="fas fa-paint-roller"></i>',
            iconSize: [30, 30]
        });

        const digitalIcon = L.divIcon({
            className: 'digital-marker',
            html: '<i class="fas fa-laptop-code"></i>',
            iconSize: [30, 30]
        });

        const photoIcon = L.divIcon({
            className: 'photo-marker',
            html: '<i class="fas fa-camera"></i>',
            iconSize: [30, 30]
        });

        const wheatpasteIcon = L.divIcon({
            className: 'wheatpaste-marker',
            html: '<i class="fas fa-paste"></i>',
            iconSize: [30, 30]
        });

        const carvingIcon = L.divIcon({
            className: 'carving-marker',
            html: '<i class="fas fa-hammer"></i>',
            iconSize: [30, 30]
        });

        // Add markers to the map
        artistLocations.forEach(artist => {
            let icon;

            switch(artist.type) {
                case 'stencil':
                    icon = stencilIcon;
                    break;
                case 'mural':
                    icon = muralIcon;
                    break;
                case 'digital':
                    icon = digitalIcon;
                    break;
                case 'photography':
                    icon = photoIcon;
                    break;
                case 'wheatpaste':
                    icon = wheatpasteIcon;
                    break;
                case 'carving':
                    icon = carvingIcon;
                    break;
                default:
                    icon = L.divIcon({
                        className: 'default-marker',
                        html: '<i class="fas fa-user"></i>',
                        iconSize: [30, 30]
                    });
            }

            const marker = L.marker([artist.lat, artist.lng], { icon: icon }).addTo(artistMap);
            marker.bindPopup(`
                <h3>${artist.name}</h3>
                <p>${artist.city}</p>
                <small>Style: ${artist.type}</small>
            `);
        });

        // Filter functionality
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                console.log(`Filter by ${checkbox.id} is now ${checkbox.checked}`);
                // In a real implementation, this would filter the artist grid
            });
        });

        // Sort functionality
        const sortDropdowns = document.querySelectorAll('.sort-dropdown');
        sortDropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', () => {
                console.log(`Sorted by: ${dropdown.value}`);
                // In a real implementation, this would sort the artist grid
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        const searchBtn = document.querySelector('.search-btn');

        searchBtn.addEventListener('click', () => {
            const searchTerm = searchInput.value;
            console.log(`Searching for: ${searchTerm}`);
            // In a real implementation, this would search the artist grid
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const searchTerm = searchInput.value;
                console.log(`Searching for: ${searchTerm}`);
                // In a real implementation, this would search the artist grid
            }
        });

        // Animation on Scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.artist-card, .spotlight-card');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;

                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // Set initial state for animated elements
        document.querySelectorAll('.artist-card, .spotlight-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
