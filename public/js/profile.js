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



        // Profile Tabs
        const profileTabs = document.querySelectorAll('.profile-tab');
        const tabContents = {
            'art': document.getElementById('art-tab'),
            'map': document.getElementById('map-tab'),
            'collections': document.getElementById('collections-tab'),
            'liked': document.getElementById('liked-tab'),
            'comments': document.getElementById('comments-tab')
        };

        profileTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                profileTabs.forEach(t => t.classList.remove('active'));

                // Add active class to clicked tab
                tab.classList.add('active');

                // Hide all tab contents
                Object.values(tabContents).forEach(content => {
                    content.style.display = 'none';
                });

                // Show the selected tab content
                const tabName = tab.getAttribute('data-tab');
                if (tabContents[tabName]) {
                    tabContents[tabName].style.display = 'block';

                    // Initialize map if map tab is selected
                    if (tabName === 'map') {
                        initProfileMap();
                    }
                }
            });
        });

           // ========== Interactive Map ==========
    // Define map layers// Light (Carto Light - clean, modern look)
const lightLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, Tiles &copy; Humanitarian OpenStreetMap Team'
});




// Dark (Carto Dark - optimized for nighttime/dark UI)
const darkLayer = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
    maxZoom: 20,
    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>'
});


// Satellite (Esri World Imagery - high quality satellite tiles)
const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 60,
    attribution: '&copy; <a href="https://www.esri.com/">Esri</a>, Maxar, Earthstar Geographics'
});

    // Initialize map with the light layer
    const map = L.map("streetArtMap", {
        layers: [lightLayer],
        zoomControl: false
    }).setView([14.0555, 121.3250], 13);

    // Add zoom control with position
    L.control.zoom({
        position: 'topright'
    }).addTo(map);

    // Layer arrays and index
    const layers = [lightLayer, darkLayer, satelliteLayer];
    const layerNames = ['Light', 'Dark', 'Satellite'];
    let currentIndex = 0;

    // Create a custom Leaflet control for theme toggle
    const ThemeToggleControl = L.Control.extend({
        options: {
            position: 'topleft'
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

            L.DomEvent.disableClickPropagation(container);

            container.addEventListener('click', () => {
                map.removeLayer(layers[currentIndex]);
                currentIndex = (currentIndex + 1) % layers.length;
                map.addLayer(layers[currentIndex]);
                container.textContent = layerNames[currentIndex];
            });

            return container;
        }
    });

    // Add the custom control to map
    map.addControl(new ThemeToggleControl());

    let clusteredMarkers;

    async function loadPostMarkers() {
        try {
            const res = await fetch('/api/posts');
            if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
            const posts = await res.json();

            clusteredMarkers = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true,
                maxClusterRadius: 60
            });

            posts.forEach(post => {
                const originalPost = post.post || post;

                // Skip if no coordinates
                if (!originalPost.latitude || !originalPost.longitude) {
                    console.warn('Missing coordinates for post:', originalPost.id);
                    return;
                }

                const lat = parseFloat(originalPost.latitude);
                const lng = parseFloat(originalPost.longitude);

                // Get user data with fallbacks
                const user = originalPost.user || {};
                const userName = user.name || 'Unknown User';
                const userEmail = user.email || '';
                const userAvatar = user.profile_picture
                    ? user.profile_picture.startsWith('http')
                        ? user.profile_picture
                        : user.profile_picture
                    : '/img/default-avatar.jpg';

                // Get post data with fallbacks
                const location = originalPost.location_name || 'Unknown location';
                const description = originalPost.caption || '';
                const createdAt = originalPost.created_at
                    ? new Date(originalPost.created_at).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                      })
                    : 'Unknown date';

                const imageUrl = originalPost.image_url
                    ? originalPost.image_url.startsWith('http')
                        ? originalPost.image_url
                        : `/storage/${originalPost.image_url.replace(/^storage\/|^public\//, '')}`
                    : null;

                // Create marker icon
                const markerIcon = L.divIcon({
                    html: `<div style="
                        width: 40px;
                        height: 40px;
                        background: url('${userAvatar}');
                        background-size: cover;
                        border-radius: 50%;
                        border: 2px solid white;
                        box-shadow: 0 0 5px rgba(0,0,0,0.3);
                    "></div>`,
                    className: 'custom-marker',
                    iconSize: [40, 40],
                    iconAnchor: [20, 40]
                });

                // Create marker
                const marker = L.marker([lat, lng], {
                    icon: markerIcon,
                    title: description || 'Post location',
                    riseOnHover: true,
                    zIndexOffset: 1000
                });

                // Modern minimalist popup content
                const popupContent = `
                <div class="post-popup" style="
                    width: 320px;
                    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
                ">
                    <!-- Header Section -->
                    <div style="
                        display: flex;
                        align-items: center;
                        padding: 16px;
                        background: #ffffff;
                        border-bottom: 1px solid #f0f0f0;
                    ">
                        <img src="${userAvatar}"
                             style="
                                width: 48px;
                                height: 48px;
                                border-radius: 50%;
                                object-fit: cover;
                                margin-right: 12px;
                                border: 1px solid #f5f5f5;
                             "
                             onerror="this.src='/img/default-avatar.jpg'">
                        <div>
                            <h4 style="
                                margin: 0 0 4px 0;
                                font-size: 15px;
                                font-weight: 600;
                                color: #222;
                            ">${userName}</h4>
                            <small style="
                                color: #888;
                                font-size: 13px;
                                display: flex;
                                align-items: center;
                                gap: 4px;
                            ">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                ${location}
                            </small>
                        </div>
                    </div>

                    <!-- Post Image -->
                    ${imageUrl ? `
                    <div style="
                        width: 100%;
                        height: 220px;
                        background: #f9f9f9;
                    ">
                        <img src="${imageUrl}"
                             style="
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                display: block;
                             "
                             onerror="this.style.display='none'">
                    </div>` : ''}

                    <!-- Content Section -->
                    <div style="padding: 16px; background: #ffffff;">
                        <!-- Date -->
                        <div style="
                            display: flex;
                            align-items: center;
                            gap: 6px;
                            margin-bottom: 12px;
                            color: #888;
                            font-size: 13px;
                        ">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            ${createdAt}
                        </div>

                        <!-- Post Caption -->
                        ${description ? `
                        <div style="
                            margin-bottom: 16px;
                            color: #333;
                            font-size: 15px;
                            line-height: 1.5;
                        ">
                            ${description}
                        </div>` : ''}

                        <!-- Tags -->
                        ${originalPost.tags && originalPost.tags.length ? `
                        <div style="
                            display: flex;
                            flex-wrap: wrap;
                            gap: 6px;
                            margin-top: 12px;
                        ">
                            ${originalPost.tags.map(tag => `
                                <span style="
                                    background: #f0f0f0;
                                    color: #555;
                                    padding: 4px 10px;
                                    border-radius: 20px;
                                    font-size: 12px;
                                ">#${tag}</span>
                            `).join('')}
                        </div>` : ''}
                    </div>
                </div>`;

                marker.bindPopup(popupContent, {
                    maxWidth: 320,
                    minWidth: 320,
                    className: 'modern-popup',
                    autoPanPaddingTopLeft: [20, 20],
                    autoPanPaddingBottomRight: [20, 20]
                });

                clusteredMarkers.addLayer(marker);
            });

            // Clear existing clusters
            map.eachLayer(layer => {
                if (layer instanceof L.MarkerClusterGroup) {
                    map.removeLayer(layer);
                }
            });

            // Add to map and fit bounds
            map.addLayer(clusteredMarkers);
            if (posts.length > 0) {
                map.fitBounds(clusteredMarkers.getBounds(), {
                    padding: [50, 50],
                    maxZoom: 15
                });
            }

            // Force redraw
            setTimeout(() => {
                map.invalidateSize(true);
                clusteredMarkers.refreshClusters();
            }, 100);

        } catch (err) {
            console.error("Map error:", err);
            alert("Error loading map data. Please try again.");
        }
    }

    // Load posts on map initialization
    loadPostMarkers();

     // ========== Robust Fullscreen Toggle ==========
    const mapContainer = document.querySelector('.map-container');
    const viewFullMapBtn = document.getElementById('viewFullMapBtn');
    let isFullscreen = false;

    function toggleFullscreen(e) {
    if (e) e.preventDefault();

    isFullscreen = !isFullscreen;

    // Toggle classes
    mapContainer.classList.toggle('fullscreen', isFullscreen);
    document.body.classList.toggle('fullscreen-map-active', isFullscreen);

    // Update button
    if (viewFullMapBtn) {
        const icon = isFullscreen ? 'compress' : 'expand';
        viewFullMapBtn.innerHTML = `<i class="fas fa-${icon}"></i> ${isFullscreen ? 'Exit Full Map' : 'View Full Map'}`;

        // Ensure button is clickable
        viewFullMapBtn.style.pointerEvents = 'auto';
        viewFullMapBtn.style.zIndex = isFullscreen ? '10001' : '1001';
    }

    // Resize map after transition
    setTimeout(() => {
        map.invalidateSize(true);
        if (isFullscreen && clusteredMarkers) {
            map.fitBounds(clusteredMarkers.getBounds());
        }
    }, 100);
}

    // Add click event listener with proper checks
    if (viewFullMapBtn) {
        viewFullMapBtn.addEventListener('click', toggleFullscreen);
    }

    // Add escape key handler
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isFullscreen) {
            toggleFullscreen(e);
        }
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

        // Art card hover effect
        const artCards = document.querySelectorAll('.art-card');
        artCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px)';
                card.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.08)';
            });
        });

        // Collection card hover effect
        const collectionCards = document.querySelectorAll('.collection-card');
        collectionCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Contact button hover effects
        const contactButtons = document.querySelectorAll('.contact-buttons .btn');
        contactButtons.forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                btn.style.transform = 'translateY(-3px)';
            });

            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translateY(0)';
            });
        });

        editBioBtn.addEventListener('click', () => {
    profileBio.style.display = 'none';
    editBioBtn.style.display = 'none';
    bioEditForm.style.display = 'block';
});

        // Testimonial card hover effect
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        testimonialCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Initialize first tab as active
        document.querySelector('.profile-tab.active').click();

        // Update the logout functionality
        document.getElementById('logout-form').addEventListener('submit', function(e) {
            e.preventDefault();
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            });
        });

document.addEventListener('DOMContentLoaded', () => {
  // Overlay element for all edit forms
  const overlay = document.createElement('div');
  overlay.className = 'edit-form-overlay';
  document.body.appendChild(overlay);

  // Helper: Toggle form visibility with overlay and buttons
  function setupToggle(editBtnId, formId, cancelBtnId) {
    const editBtn = document.getElementById(editBtnId);
    const form = document.getElementById(formId);
    const cancelBtn = document.getElementById(cancelBtnId);
    if (!editBtn || !form || !cancelBtn) return;

    const showForm = () => {
      form.classList.add('edit-form-active');
      overlay.classList.add('active');
      editBtn.style.display = 'none';
    };

    const hideForm = () => {
      form.classList.remove('edit-form-active');
      overlay.classList.remove('active');
      editBtn.style.display = 'inline-block';
    };

    editBtn.addEventListener('click', showForm);
    cancelBtn.addEventListener('click', hideForm);
    overlay.addEventListener('click', hideForm);

    // Optional: close form on submit
    const innerForm = form.querySelector('form');
    if (innerForm) {
      innerForm.addEventListener('submit', (e) => {
        // You can handle AJAX here or just close UI
        hideForm();
      });
    }
  }

  // Setup toggles for all edit buttons/forms
  setupToggle('editNameBtn', 'nameEditForm', 'cancelNameEdit');
  setupToggle('editBioBtn', 'bioEditForm', 'cancelBioEdit');
  setupToggle('editLocationBtn', 'locationEditForm', 'cancelLocationEdit');
  setupToggle('coverEditBtn', 'coverEditForm', 'cancelCoverEdit');

  // Specific elements for cover photo AJAX upload
  const coverPhotoForm = document.getElementById('coverPhotoForm');
  const bannerImage = document.getElementById('bannerImage');

  if (coverPhotoForm) {
    coverPhotoForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const formData = new FormData(coverPhotoForm);

      try {
        const response = await fetch('{{ route("user.cover.update") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: formData,
        });

        if (!response.ok) throw new Error('Upload failed');

        const data = await response.json();
        if (bannerImage && data.cover_photo_url) {
          bannerImage.src = data.cover_photo_url;
        }
      } catch (error) {
        alert('Failed to upload cover photo');
        console.error(error);
      }
    });
  }

  // Specific elements for bio AJAX update
  const bioForm = document.getElementById('bioForm');
  const bioTextarea = document.getElementById('bioTextarea');
  const profileBio = document.getElementById('profileBio');

  if (bioForm && bioTextarea && profileBio) {
    bioForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const bioText = bioTextarea.value.trim();

      try {
        const response = await fetch('{{ route("user.bio.update") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({ bio: bioText }),
        });

        if (!response.ok) throw new Error('Update failed');

        const data = await response.json();
        profileBio.textContent = data.bio;
      } catch (error) {
        alert('Failed to update bio');
        console.error(error);
      }
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const avatarInput = document.getElementById('avatarInput');
  const avatarForm = document.getElementById('avatarForm');
  const avatarImage = document.getElementById('avatarImage');
  const editAvatarBtn = document.getElementById('editAvatarBtn');

  // Open file picker
  editAvatarBtn.addEventListener('click', () => {
    avatarInput.click();
  });

  // Submit avatar form when file is selected
  avatarInput.addEventListener('change', async () => {
    if (!avatarInput.files.length) return;

    const formData = new FormData(avatarForm);

    try {
      const response = await fetch('{{ route("user.avatar.update") }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      });

      if (!response.ok) throw new Error('Upload failed');

      const data = await response.json();
      avatarImage.src = data.avatar_url;

    } catch (error) {
      alert('Failed to update avatar');
      console.error(error);
    }
  });
});
document.addEventListener('DOMContentLoaded', () => {
    // Cover Photo Edit Functionality
    const coverEditBtn = document.getElementById('coverEditBtn');
    const coverEditForm = document.getElementById('coverEditForm');
    const cancelCoverEdit = document.getElementById('cancelCoverEdit');
    const bannerImage = document.getElementById('bannerImage');
    const coverPhotoInput = document.getElementById('coverPhotoInput');
    const coverPhotoForm = document.getElementById('coverPhotoForm');
    const coverPreview = document.getElementById('coverPreview');
    const overlay = document.querySelector('.edit-form-overlay');

    if (coverEditBtn && coverEditForm) {
        // Show edit form
        coverEditBtn.addEventListener('click', () => {
            coverEditForm.style.display = 'block';
            overlay.style.display = 'block';
        });

        // Hide edit form
        cancelCoverEdit.addEventListener('click', () => {
            coverEditForm.style.display = 'none';
            overlay.style.display = 'none';
            coverPreview.style.display = 'none';
            coverPhotoInput.value = '';
        });

        overlay.addEventListener('click', () => {
            coverEditForm.style.display = 'none';
            overlay.style.display = 'none';
            coverPreview.style.display = 'none';
            coverPhotoInput.value = '';
        });

        // Preview cover photo when selected
        coverPhotoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    coverPreview.src = event.target.result;
                    coverPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle cover photo form submission
        coverPhotoForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(coverPhotoForm);

            try {
                const response = await fetch('/profile/update-cover', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    // Update the banner image
                    bannerImage.src = data.cover_url;

                    // Hide the form and reset
                    coverEditForm.style.display = 'none';
                    overlay.style.display = 'none';
                    coverPreview.style.display = 'none';
                    coverPhotoInput.value = '';

                    showToast('Cover photo updated successfully!');
                } else {
                    throw new Error(data.message || 'Failed to update cover photo');
                }
            } catch (error) {
                console.error('Error updating cover photo:', error);
                showToast(error.message || 'Failed to update cover photo');
            }
        });
    }

    // Toast notification function
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
});
// Profile Actions Dropdown
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap dropdown
    $('.dropdown-toggle').dropdown();

    document.getElementById('profileActionsDropdown').addEventListener('click', function(event) {
    event.preventDefault();
    const dropdownMenu = this.nextElementSibling;
    dropdownMenu.classList.toggle('show');
});

    // Edit Profile Button Click
    document.getElementById('editProfileBtn').addEventListener('click', function(e) {
        e.preventDefault();
        $('#editProfileModal').modal('show');
    });

    // Save Profile Changes
    document.getElementById('saveProfileChanges').addEventListener('click', function() {
        const form = document.getElementById('profileEditForm');
        const formData = new FormData(form);

        fetch('/profile/update', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the profile info on the page
                if (data.name) {
                    document.getElementById('profileName').textContent = data.name;
                }
                if (data.bio) {
                    document.getElementById('profileBio').textContent = data.bio;
                }
                if (data.location) {
                    document.getElementById('profileLocation').textContent = data.location;
                }
                if (data.avatar) {
                    document.getElementById('avatarImage').src = data.avatar;
                }
                if (data.cover_photo) {
                    document.getElementById('bannerImage').src = data.cover_photo;
                }

                // Close the modal
                $('#editProfileModal').modal('hide');

                // Show success message
                alert('Profile updated successfully!');
            } else {
                alert('Failed to update profile: ' + (data.message || 'Please try again.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the profile.');
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all dropdowns
    var dropdownElements = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    dropdownElements.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });

    // Edit Profile button click handler
    document.getElementById('editProfileBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        var editModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
        editModal.show();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editProfileBtn');
    const modal = document.getElementById('editModal');

    if (editBtn && modal) {
        editBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.style.display = 'block';
        });
    }

    // Optional: Close modal when clicking outside or on close button
    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    });
});
