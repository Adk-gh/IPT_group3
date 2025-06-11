// ========== Mobile Menu ==========
const menuBtn = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
const nav = document.querySelector('nav');

menuBtn?.addEventListener('click', () => {
    nav?.classList.toggle('active');
    menuBtn.classList.toggle('active');
});

// ========== Header on Scroll ==========
const header = document.querySelector('header');
window.addEventListener('scroll', () => {
    header?.classList.toggle('scrolled', window.scrollY > 50);
});

// ========== Smooth Scrolling ==========
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector(anchor.getAttribute('href'))?.scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// ========== Artworks Tabs ==========
document.querySelectorAll('.art-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.art-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        console.log(`Showing ${tab.textContent} artworks`);
    });
});

// ========== Theme Toggle ==========
const themeToggle = document.getElementById('theme-toggle');
themeToggle?.addEventListener('click', () => {
    const darkMode = document.body.classList.toggle('dark-theme');
    localStorage.setItem('theme', darkMode ? 'dark' : 'light');
});

// Load saved theme
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-theme');
}

// ========== Animation on Scroll ==========
const animatedElements = document.querySelectorAll('.art-card, .community-item');
animatedElements.forEach(el => el.classList.add('fade-in'));
window.addEventListener('scroll', () => {
    animatedElements.forEach(el => {
        if (el.getBoundingClientRect().top < window.innerHeight) {
            el.classList.add('visible');
        }
    });
});

// ========== Newsletter ==========
document.querySelectorAll('.newsletter-form').forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        alert('Subscribed to newsletter!');
        form.reset();
    });
});

// ========== App Store Button ==========
document.querySelectorAll('.app-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        alert('Redirecting to app store');
    });
});



document.addEventListener("DOMContentLoaded", async () => {
  // Define your tile layers
  const lightLayer = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: "© OpenStreetMap"
  });

  const darkLayer = L.tileLayer("https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="https://carto.com/">CARTO</a>'
  });

  const satelliteLayer = L.tileLayer("https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
    maxZoom: 19,
    subdomains:['mt0','mt1','mt2','mt3'],
    attribution: '© Google Satellite'
  });

  // Initialize map with the light layer
  const map = L.map("streetArtMap", {
    layers: [lightLayer]
  }).setView([14.0555, 121.3250], 13);

  // Layer arrays and index
  const layers = [lightLayer, darkLayer, satelliteLayer];
  const layerNames = ['Light', 'Dark', 'Satellite'];
  let currentIndex = 0;

  // Create a custom Leaflet control
  const ThemeToggleControl = L.Control.extend({
    options: {
      position: 'topleft'  // same as zoom control
    },
    onAdd: function () {
      const container = L.DomUtil.create('button', 'leaflet-bar leaflet-control leaflet-control-custom');
      container.style.backgroundColor = 'white';
      container.style.width = '90px';
      container.style.height = '30px';
      container.style.lineHeight = '30px';
      container.style.textAlign = 'center';
      container.style.cursor = 'pointer';
      container.style.fontWeight = '600';
      container.title = 'Toggle map theme';

      container.textContent = layerNames[currentIndex];

      // Prevent map panning when clicking the button
      L.DomEvent.disableClickPropagation(container);

      container.addEventListener('click', () => {
        // Remove current layer
        map.removeLayer(layers[currentIndex]);

        // Cycle index
        currentIndex = (currentIndex + 1) % layers.length;

        // Add new layer
        map.addLayer(layers[currentIndex]);

        // Update button label
        container.textContent = layerNames[currentIndex];
      });

      return container;
    }
  });

  // Add the custom control to map
  map.addControl(new ThemeToggleControl());

  // Your existing marker loading code here
  try {
    const res = await fetch("/api/posts");
    const posts = await res.json();

    const clusteredMarkers = L.markerClusterGroup();

    posts.forEach(post => {
      if (post.latitude && post.longitude) {
        const marker = L.marker([post.latitude, post.longitude]);
        marker.bindPopup(`
          <strong>${post.title}</strong><br>
          ${post.description || ""}
        `);
        clusteredMarkers.addLayer(marker);
      }
    });

    map.addLayer(clusteredMarkers);
  } catch (err) {
    console.error("Failed to load posts on map:", err);
  }


  // Fullscreen toggle button logic
  const mapContainer = document.querySelector('.map-container');
  const viewFullMapBtn = document.getElementById('viewFullMapBtn');

  viewFullMapBtn.addEventListener('click', e => {
    e.preventDefault();

    mapContainer.classList.toggle('fullscreen');
    document.body.classList.toggle('fullscreen-map-active');

    // Resize map after container changes size
    setTimeout(() => {
      map.invalidateSize();
    }, 300);

    // Update button text
    if (mapContainer.classList.contains('fullscreen')) {
      viewFullMapBtn.textContent = 'Exit Full Map';
    } else {
      viewFullMapBtn.textContent = 'View Full Map';
    }
  });
});
// Load dynamic posts from the database
async function loadPostMarkers() {
    try {
        const res = await fetch('/api/posts');
        const posts = await res.json();
        console.log(posts);

        const postMarkers = L.markerClusterGroup();

       posts.forEach(post => {
    if (!post.latitude || !post.longitude) return;

    const user = post.user || {};
    const avatar = user.avatar || 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png';
    const userName = user.name || 'Unknown User';
    const userEmail = user.email || 'N/A';
    const location = post.location || 'Unknown location';
    const description = post.description || '';
    const createdAt = post.created_at || '';
    const imageUrl = post.imageUrl || null;

    const marker = L.marker([post.latitude, post.longitude], {
        icon: L.icon({
            iconUrl: avatar,
            iconSize: [35, 35],
            iconAnchor: [17, 35],
            popupAnchor: [0, -35],
            className: 'marker-post'
        })
    });

    marker.on('click', () => {
        const tags = (post.tags || []).map(tag => `<span class="text-sm text-blue-600 mr-2">#${tag}</span>`).join(' ');

        const modalHTML = `
          <div class="bg-white rounded-xl shadow-xl p-5 max-w-md w-full">
            <div class="flex items-center gap-4 mb-4">
              <img src="${avatar}" class="w-12 h-12 rounded-full object-cover" alt="Avatar" />
              <div>
                <h3 class="text-lg font-semibold text-gray-800">${userName}</h3>
                <p class="text-sm text-gray-500">${userEmail}</p>
              </div>
            </div>

            <div class="text-sm text-gray-600 mb-2">
              <i class="fas fa-map-marker-alt mr-1"></i> ${location} &bull;
              <i class="far fa-clock ml-2 mr-1"></i> ${createdAt}
            </div>

            <p class="text-gray-700 mb-4">${description}</p>

            ${imageUrl ? `<img src="${imageUrl}" class="rounded-lg w-full object-cover mb-4" alt="Post image">` : ''}

            <div class="mb-3">${tags}</div>

            <div class="flex justify-end space-x-3 text-gray-500 text-sm">
              <button class="hover:text-red-500"><i class="far fa-heart"></i> Like</button>
              <button class="hover:text-blue-500"><i class="far fa-comment"></i> Comment</button>
              <button class="hover:text-green-500"><i class="fas fa-share"></i> Share</button>
            </div>
          </div>
        `;

        document.getElementById('modalContent').innerHTML = modalHTML;
        document.getElementById('postModal').classList.remove('hidden');
    });

    postMarkers.addLayer(marker);
});


        map.addLayer(postMarkers);
    } catch (err) {
        console.error("❌ Error loading post markers:", err);
    }
}
document.addEventListener('click', (e) => {
  const modal = document.getElementById('postModal');
  if (e.target === modal) {
    modal.classList.add('hidden');
  }
});
 document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.querySelector(".mobile-menu-btn");
    const nav = document.querySelector("nav");

    if (menuBtn && nav) {
      menuBtn.addEventListener("click", function () {
        nav.classList.toggle("active");
      });
    }
  });

    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const nav = document.querySelector('nav');

        if (mobileMenuBtn && nav) {
            mobileMenuBtn.addEventListener('click', () => {
                nav.classList.toggle('show');
                mobileMenuBtn.innerHTML = nav.classList.contains('show') ?
                    '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
            });
        }

        // Close mobile menu when clicking on a nav link
        const navLinks = document.querySelectorAll('nav ul li a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    nav.classList.remove('show');
                    mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                }
            });
        });
    });

