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

        // Initialize profile map
        function initProfileMap() {
            const map = L.map('profileMap').setView([14.5995, 120.9842], 13); // Manila coordinates

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add markers for user's artworks
            const userArtLocations = [
                {
                    lat: 14.5995,
                    lng: 120.9842,
                    title: "Urban Dreams",
                    description: "Cavite Skatepark, Philippines",
                    image: "https://images.unsplash.com/photo-1578926375602-3ad9e91ec0a1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                },
                {
                    lat: 14.5547,
                    lng: 121.0244,
                    title: "Color Explosion",
                    description: "Makati Backstreets, Philippines",
                    image: "https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                },
                {
                    lat: 14.5534,
                    lng: 121.0481,
                    title: "Neon Nights",
                    description: "Bonifacio Global City, Philippines",
                    image: "https://images.unsplash.com/photo-1516617442634-75371039cb3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                },
                {
                    lat: 14.6760,
                    lng: 121.0437,
                    title: "Political Statement",
                    description: "Quezon City, Philippines",
                    image: "https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80"
                },
                {
                    lat: 14.5833,
                    lng: 121.0614,
                    title: "Abstract Flow",
                    description: "Pasig River Wall, Philippines",
                    image: "https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                },
                {
                    lat: 14.5894,
                    lng: 120.9742,
                    title: "Cultural Fusion",
                    description: "Intramuros, Manila",
                    image: "https://images.unsplash.com/photo-1547891654-e66ed7ebb968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                }
            ];

            // Custom icon
            const artIcon = L.divIcon({
                className: 'art-marker',
                html: '<i class="fas fa-spray-can"></i>',
                iconSize: [30, 30]
            });

            // Add markers to the map
            userArtLocations.forEach(location => {
                const marker = L.marker([location.lat, location.lng], { icon: artIcon }).addTo(map);
                marker.bindPopup(`
                    <div style="width: 200px;">
                        <img src="${location.image}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 10px;">
                        <h3 style="margin: 0 0 5px 0; font-size: 1.1rem;">${location.title}</h3>
                        <p style="margin: 0; font-size: 0.9rem;">${location.description}</p>
                        <a href="#" style="display: inline-block; margin-top: 10px; font-size: 0.9rem; color: #ff5e5b;">View Artwork</a>
                    </div>
                `);
            });
        }

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
