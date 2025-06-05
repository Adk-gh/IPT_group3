import '../css/index.css';

// DOM Elements
const mobileMenu = document.getElementById('mobile-menu');
const menuBtn = document.getElementById('menu-btn');
const nav = document.querySelector('nav');
const header = document.querySelector('header');
const artTabs = document.querySelectorAll('.art-tab');
const themeToggle = document.getElementById('theme-toggle');
const elements = document.querySelectorAll('.art-card, .community-item');

// Initialize all functionality
function init() {
    setupMobileMenu();
    setupScrollEffects();
    setupSmoothScrolling();
    setupArtTabs();
    setupThemeToggle();
    setupAnimations();
    setupNewsletter();
    setupAppButtons();
    initializeMap();
}

// Mobile Menu
function setupMobileMenu() {
    mobileMenu.addEventListener('click', () => {
        nav.classList.toggle('active');
        menuBtn.classList.toggle('active');
    });
}

// Header styles on scroll
function setupScrollEffects() {
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 50);
    });
}

// Smooth Scrolling
function setupSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
}

// Artworks Tabs
function setupArtTabs() {
    artTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            artTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            console.log(`Showing ${tab.textContent} artworks`);
        });
    });
}

// Theme Toggle
function setupThemeToggle() {
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-theme');
        localStorage.setItem('theme', document.body.classList.contains('dark-theme') ? 'dark' : 'light');
    });

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-theme');
    }
}

// Animation on Scroll
function setupAnimations() {
    elements.forEach(element => {
        element.classList.add('fade-in');
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    elements.forEach(element => {
        observer.observe(element);
    });
}

// Newsletter submission
function setupNewsletter() {
    document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Subscribed to newsletter!');
        this.reset();
    });
}

// App Store button
function setupAppButtons() {
    document.querySelectorAll('.app-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Redirecting to app store');
        });
    });
}

// Map Initialization
async function initializeMap() {
    if (!document.getElementById('streetArtMap')) return;

    const map = L.map('streetArtMap').setView([14.2900, -1.3255], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        detectRetina: true
    }).addTo(map);

    // Custom icon creator
    const createIcon = (color, symbol) => L.divIcon({
        className: 'custom-marker',
        html: `<div style="background: ${color}; width: 30px; height: 30px; border-radius: 50%;
                display: flex; align-items: center; justify-content: center; color: white;
                border: 2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.3);">
                <i class="fas fa-${symbol}"></i></div>`,
        iconSize: [30, 30],
        popupAnchor: [0, -15]
    });

    const icons = {
        stencil: createIcon('#e74c3c', 'cut'),
        mural: createIcon('#3498db', 'paint-roller'),
        political: createIcon('#2ecc71', 'comment-alt'),
        installation: createIcon('#f39c12', 'lightbulb'),
        default: createIcon('#9b59b6', 'map-marker-alt')
    };

    try {
        const response = await fetch('/api/street-art-locations');
        const locations = await response.json();

        locations.forEach(location => {
            const marker = L.marker(
                [location.lat, location.lng],
                { icon: icons[location.type] || icons.default }
            ).addTo(map);

            marker.bindPopup(`
                <div class="art-popup">
                    <h3>${location.title}</h3>
                    ${location.image_url ?
                        `<img src="${location.image_url}" alt="${location.title}"
                        style="max-width:200px;max-height:150px;margin-bottom:10px;">` : ''}
                    <p>${location.description}</p>
                    <small>Type: ${location.type}</small>
                </div>
            `);
        });
    } catch (error) {
        console.error('Error loading map data:', error);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', init);
