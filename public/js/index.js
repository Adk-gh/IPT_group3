import '../css/app.css';
        // Mobile Menu
        const mobileMenu = document.getElementById('mobile-menu');
        const menuBtn = document.getElementById('menu-btn');
        mobileMenu.addEventListener('click', () => {
            nav.classList.toggle('active');
            menuBtn.classList.toggle('active');
        });

        // Header styles on scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smoothscroll'
                });
            });
        });

        // Artworks Tabs
        const artTabs = document.querySelectorAll('.art-tab');
        artTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                artTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                console.log(`Showing ${tab.textContent} artworks`);
            });
        });

        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme');
            localStorage.setItem('theme', document.body.classList.contains('dark-theme') ? 'dark' : 'light');
        });

        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-theme');
        }

        // Initialize Map
        const map = L.map('map').setView([14.2900, -1.3255], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Map Markers
        const markers = [
            { lat: 14.2900, lng: -1.3255, label: 'Art Location 1', description: 'Description 1' },
            { lat: 14.2950, lng: -1.3200, label: 'Art Location 2', description: 'Description 2' },
        ];
        markers.forEach(marker => {
            L.marker([marker.lat, marker.lng]).addTo(map)
                .bindPopup(`<label>${marker.label}</label><p>${marker.description}</p>`);
        });

        // Add sample markers for street art locations
        const streetArtLocations = [
            {
                lat: 40.7128,
                lng: -74.0060,
                title: "Banksy Mural",
                description: "Iconic stencil work by anonymous artist",
                type: "stencil"
            },
            {
                lat: 40.7150,
                lng: -74.0080,
                title: "Colorful Abstract",
                description: "Vibrant abstract mural by local artist",
                type: "mural"
            },
            {
                lat: 40.7100,
                lng: -74.0050,
                title: "Political Statement",
                description: "Thought-provoking political artwork",
                type: "political"
            },
            {
                lat: 40.7135,
                lng: -74.0030,
                title: "Neon Installation",
                description: "Glowing neon street art installation",
                type: "installation"
            }
        ];

        // Create custom icons
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

        const politicalIcon = L.divIcon({
            className: 'political-marker',
            html: '<i class="fas fa-comment-alt"></i>',
            iconSize: [30, 30]
        });

        const installationIcon = L.divIcon({
            className: 'installation-marker',
            html: '<i class="fas fa-lightbulb"></i>',
            iconSize: [30, 30]
        });

        // Add markers to the map
        streetArtLocations.forEach(location => {
            let icon;

            switch(location.type) {
                case 'stencil':
                    icon = stencilIcon;
                    break;
                case 'mural':
                    icon = muralIcon;
                    break;
                case 'political':
                    icon = politicalIcon;
                    break;
                case 'installation':
                    icon = installationIcon;
                    break;
                default:
                    icon = L.divIcon({
                        className: 'default-marker',
                        html: '<i class="fas fa-map-marker-alt"></i>',
                        iconSize: [30, 30]
                    });
            }

            const marker = L.marker([location.lat, location.lng], { icon: icon }).addTo(map);
            marker.bindPopup(`
                <h3>${location.title}</h3>
                <p>${location.description}</p>
                <small>Type: ${location.type}</small>
            `);
        });
        // Animation on Scroll
        const elements = document.querySelectorAll('.art-card, .community-item');
        elements.forEach(element => {
            element.classList.add('fade-in');
        });
        window.addEventListener('scroll', () => {
            elements.forEach(element => {
                if (element.getBoundingClientRect().top < window.innerHeight) {
                    element.classList.add('visible');
                }
            });
        });

        // Newsletter submission
        $('.newsletter-form').submit(function(e) {
            e.preventDefault();
            alert('Subscribed to newsletter!');
            this.form.reset();
        });

        // App Store button
        $('.app-btn').click(function() {
            alert('Redirecting to app store');
        });

        document.addEventListener('DOMContentLoaded', function() {
   // Initialize Map
map = L.map('map').setView([14.0555, 121.3250], 13);

// Add OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    detectRetina: true
}).addTo(map);

let marker;

map.on('click', function(e) {
    const { lat, lng } = e.latlng;

    if (marker) {
        marker.setLatLng(e.latlng);
    } else {
        marker = L.marker(e.latlng, { draggable: true }).addTo(map);

        marker.on('dragend', function(event) {
            const position = event.target.getLatLng();
            updateLatLngInputs(position.lat, position.lng);
        });
    }

    updateLatLngInputs(lat, lng);
});

function updateLatLngInputs(lat, lng) {
    document.getElementById('latitude').value = lat.toFixed(6);
    document.getElementById('longitude').value = lng.toFixed(6);
}


    // Create custom icons
    const iconCreator = (color, symbol) => {
        return L.divIcon({
            className: 'custom-marker',
            html: `<div style="background: ${color};
                              width: 30px;
                              height: 30px;
                              border-radius: 50%;
                              display: flex;
                              align-items: center;
                              justify-content: center;
                              color: white;
                              border: 2px solid white;
                              box-shadow: 0 0 5px rgba(0,0,0,0.3);">
                     <i class="fas fa-${symbol}"></i>
                   </div>`,
            iconSize: [30, 30],
            popupAnchor: [0, -15]
        });
    };

    const icons = {
        stencil: iconCreator('#e74c3c', 'cut'),
        mural: iconCreator('#3498db', 'paint-roller'),
        political: iconCreator('#2ecc71', 'comment-alt'),
        installation: iconCreator('#f39c12', 'lightbulb'),
        default: iconCreator('#9b59b6', 'map-marker-alt')
    };

    // Function to fetch data from Laravel backend
    async function fetchStreetArtData() {
        try {
            const response = await fetch('/api/street-art-locations');
            if (!response.ok) throw new Error('Network response was not ok');
            return await response.json();
        } catch (error) {
            console.error('Error fetching street art data:', error);
            // Return sample data if API fails
            return [
                {
                    lat: 40.7128,
                    lng: -74.0060,
                    title: "Banksy Mural",
                    description: "Iconic stencil work by anonymous artist",
                    type: "stencil",
                    image_url: "/images/banksy.jpg"
                },
                {
                    lat: 40.7150,
                    lng: -74.0080,
                    title: "Colorful Abstract",
                    description: "Vibrant abstract mural by local artist",
                    type: "mural",
                    image_url: "/images/abstract.jpg"
                }
            ];
        }
    }

    // Main function to initialize the map with data
    async function initializeMap() {
        const streetArtLocations = await fetchStreetArtData();

        // Add markers to the map
        streetArtLocations.forEach(location => {
            const icon = icons[location.type] || icons.default;

            const marker = L.marker([location.lat, location.lng], { icon: icon }).addTo(map);

            let popupContent = `
                <div class="art-popup">
                    <h3>${location.title}</h3>
                    ${location.image_url ? `<img src="${location.image_url}" style="max-width: 200px; max-height: 150px; margin-bottom: 10px;">` : ''}
                    <p>${location.description}</p>
                    <small>Type: ${location.type}</small>
                </div>
            `;

            marker.bindPopup(popupContent);

            // Optional: Add click event for more interactivity
            marker.on('click', function() {
                console.log('Marker clicked:', location);
                // You could trigger a modal or sidebar with more info here
            });
        });

        // Add layer control if you have multiple types
        const layerControl = L.control.layers(null, null, { collapsed: false }).addTo(map);
    }

    // Initialize the map with data
    initializeMap();
});
