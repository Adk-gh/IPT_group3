document.addEventListener('DOMContentLoaded', () => {
    // Like Button Functionality
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const postCard = e.target.closest('.post-card');
            const postId = button.getAttribute('data-post-id');
            const isLiked = button.getAttribute('data-liked') === 'true';
            const url = isLiked ? `/posts/${postId}/unlike` : `/posts/${postId}/like`;
            const method = isLiked ? 'DELETE' : 'POST';

            if (!postId) {
                console.error('Error: Missing post ID for like/unlike action');
                return;
            }

            console.log(`Initiating ${isLiked ? 'unlike' : 'like'} for post ${postId}, user ${getUserId()}`);

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                });

                const data = await response.json();

                if (response.ok) {
                    // Update UI
                    const likeCountSpan = button.querySelector('.like-count');
                    likeCountSpan.textContent = data.likes_count;

                    const icon = button.querySelector('i');
                    if (data.liked) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        button.setAttribute('data-liked', 'true');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        button.setAttribute('data-liked', 'false');
                    }

                    // Animation effect
                    button.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        button.style.transform = 'scale(1)';
                    }, 300);

                    console.log(`Success: ${data.message}, Likes: ${data.likes_count}, Liked: ${data.liked}`);
                } else {
                    console.error(`Error: ${data.message || 'Unknown error'}`);
                    showToast(`Error: ${data.message || 'Failed to process like/unlike action'}`);
                }
            } catch (error) {
                console.error(`Fetch error: ${error.message}`);
                showToast('Failed to process like/unlike action.');
                console.error('Error liking/unliking post:', error);
            }
        });
    });

    // Function to get user ID (assumes it's available in a meta tag or similar)
    function getUserId() {
        const userIdMeta = document.querySelector('meta[name="user-id"]');
        return userIdMeta ? userIdMeta.getAttribute('content') : 'unknown';
    }

    // Existing code from your socialfeed.js (merged to avoid duplication)
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const nav = document.getElementById('nav');

    if (mobileMenuBtn && nav) {
        mobileMenuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
            mobileMenuBtn.innerHTML = nav.classList.contains('active') ?
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });
    }

    // Header Scroll Effect
    const header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

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

                if (nav && nav.classList.contains('active')) {
                    nav.classList.remove('active');
                    mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                }
            }
        });
    });

    // Feed Tabs
    const feedTabs = document.querySelectorAll('.feed-tab');
    feedTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            feedTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            console.log(`Feed tab switched to ${tab.textContent}`);
        });
    });

    // Dark Mode Toggle
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            body.setAttribute('data-theme',
                body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
            localStorage.setItem('theme', body.getAttribute('data-theme'));
            themeToggle.innerHTML = body.getAttribute('data-theme') === 'dark' ?
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            console.log(`Theme toggled to ${body.getAttribute('data-theme')}`);
        });

        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            body.setAttribute('data-theme', savedTheme);
            themeToggle.innerHTML = savedTheme === 'dark' ?
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        }
    }

    // Share Button Functionality
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach(button => {
        button.addEventListener('click', function() {
            console.log('Share button clicked');
            showToast('Share functionality would open a dialog with sharing options.');
            button.style.transform = 'scale(1.2)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 300);
        });
    });

    // Save Button Functionality
    const saveButtons = document.querySelectorAll('.save-btn');
    saveButtons.forEach(button => {
        button.addEventListener('click', function() {
            const icon = this.querySelector('i');
            const isSaved = this.classList.contains('saved');

            if (isSaved) {
                this.classList.remove('saved');
                icon.classList.replace('fas', 'far');
                console.log('Post unsaved');
            } else {
                this.classList.add('saved');
                icon.classList.replace('far', 'fas');
                console.log('Post saved');
            }

            button.style.transform = 'scale(1.2)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 300);
        });
    });

    // Follow Button Functionality
    const followButtons = document.querySelectorAll('.follow-btn');
    followButtons.forEach(button => {
        button.addEventListener('click', function() {
            const isFollowing = this.classList.contains('following');
            if (isFollowing) {
                this.classList.remove('following');
                this.textContent = 'Follow';
                console.log('User unfollowed');
            } else {
                this.classList.add('following');
                this.textContent = 'Following';
                console.log('User followed');
            }

            button.style.transform = 'scale(1.1)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 300);
        });
    });

    // Comment Submission
    const commentForms = document.querySelectorAll('.add-comment');
    commentForms.forEach(form => {
        const input = form.querySelector('.comment-input');
        const submit = form.querySelector('.comment-submit');

        if (submit) {
            submit.addEventListener('click', () => {
                if (input.value.trim() !== '') {
                    console.log(`Comment submitted: ${input.value}`);
                    input.value = '';
                }
            });
        }

        if (input) {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && input.value.trim() !== '') {
                    console.log(`Comment submitted via Enter: ${input.value}`);
                    input.value = '';
                }
            });
        }
    });

    // Post Options Menu
    const postOptions = document.querySelectorAll('.post-options');
    postOptions.forEach(option => {
        option.addEventListener('click', () => {
            console.log('Post options menu clicked');
            showToast('Post options menu would appear with options to report, save, or edit post.');
        });
    });

    // Create Post Functionality
    const createPostBtn = document.querySelector('.create-post .btn-primary');
    if (createPostBtn) {
        createPostBtn.addEventListener('click', () => {
            const postInput = document.querySelector('.post-input');
            if (postInput.value.trim() !== '') {
                console.log(`New post submitted: ${postInput.value}`);
                postInput.value = '';
            }
        });
    }

    // Tag Click Functionality
    const tags = document.querySelectorAll('.post-tag, .trending-tag');
    tags.forEach(tag => {
        tag.addEventListener('click', function(e) {
            e.preventDefault();
            const tagText = this.textContent.replace('#', '');
            console.log(`Tag clicked: ${tagText}`);
            this.style.transform = 'scale(1.1)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 300);
        });
    });

    // Location Click Functionality
    const locations = document.querySelectorAll('.location-item');
    locations.forEach(location => {
        location.addEventListener('click', function(e) {
            e.preventDefault();
            const locationName = this.querySelector('.location-name')?.textContent || 'Unknown';
            console.log(`Location clicked: ${locationName}`);
        });
    });

    // Map Location Variables
    const locationToggle = document.getElementById('locationToggle');
    const locationModal = document.getElementById('locationModal');
    const closeModal = document.getElementById('closeModal');
    const saveLocation = document.getElementById('saveLocation');
    const clearLocation = document.getElementById('clearLocation');
    const locationNameInput = document.getElementById('location_name');

    let map, marker;
    let mapInitialized = false;

    if (locationToggle) {
        locationToggle.addEventListener('click', (e) => {
            e.preventDefault();
            locationModal.style.display = 'flex';
            console.log('Location modal opened');

            if (!mapInitialized) {
                initializeMap();
                mapInitialized = true;
            }
        });
    }

    if (closeModal) {
        closeModal.addEventListener('click', (e) => {
            e.preventDefault();
            locationModal.style.display = 'none';
            console.log('Location modal closed');
        });
    }

    if (locationModal) {
        locationModal.addEventListener('click', (e) => {
            if (e.target === locationModal) {
                locationModal.style.display = 'none';
                console.log('Location modal closed by clicking outside');
            }
        });
    }

    if (saveLocation) {
        saveLocation.addEventListener('click', (e) => {
            e.preventDefault();
            locationModal.style.display = 'none';
            const locationName = locationNameInput.value;
            console.log(`Location saved: ${locationName}, Lat: ${document.getElementById('latitude').value}, Lng: ${document.getElementById('longitude').value}`);
            const locationPreview = document.getElementById('locationPreview');
            if (locationName) {
                locationPreview.textContent = locationName;
                locationPreview.style.display = 'block';
            } else {
                locationPreview.style.display = 'none';
            }
        });
    }

    if (clearLocation) {
        clearLocation.addEventListener('click', (e) => {
            e.preventDefault();
            if (marker) {
                map.removeLayer(marker);
                marker = null;
            }
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
            locationNameInput.value = '';
            const locationPreview = document.getElementById('locationPreview');
            if (locationPreview) {
                locationPreview.style.display = 'none';
                locationPreview.innerText = '';
            }
            map.setView([14.0555, 121.3250], 13);
            console.log('Location cleared');
        });
    }

    function initializeMap() {
        map = L.map('map').setView([14.0555, 121.3250], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        map.on('click', function(e) {
            const { lat, lng } = e.latlng;
            placeMarker([lat, lng]);
            reverseGeocode(lat, lng);
            console.log(`Map clicked: Lat ${lat.toFixed(4)}, Lng ${lng.toFixed(4)}`);
        });
    }

    function placeMarker(coords) {
        if (marker) {
            marker.setLatLng(coords);
        } else {
            marker = L.marker(coords, { draggable: true }).addTo(map);
            marker.on('dragend', function(event) {
                const position = event.target.getLatLng();
                updateLatLng(position.lat, position.lng);
                reverseGeocode(position.lat, position.lng);
                console.log(`Marker dragged: Lat ${position.lat.toFixed(4)}, Lng ${position.lng.toFixed(4)}`);
            });
        }
        updateLatLng(coords[0], coords[1]);
        map.panTo(coords);
    }

    function updateLatLng(lat, lng) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    }

    async function reverseGeocode(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
            const data = await response.json();
            if (data.display_name) {
                locationNameInput.value = data.display_name;
                console.log(`Reverse geocoded: ${data.display_name}`);
            } else {
                locationNameInput.value = `${lat.toFixed(4)}, ${lng.toFixed(4)}`;
                console.log(`Reverse geocoding failed, using coordinates: ${lat.toFixed(4)}, ${lng.toFixed(4)}`);
            }
        } catch (error) {
            locationNameInput.value = `${lat.toFixed(4)}, ${lng.toFixed(4)}`;
            console.error(`Geocoding error: ${error.message}`);
        }
    }

    // Tags Dropdown Functionality
    const selectedTags = new Set();
    const tagsButton = document.getElementById('tagsButton');
    if (tagsButton) {
        tagsButton.addEventListener('click', async () => {
            const dropdown = document.getElementById('tagsDropdown');
            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
                console.log('Tags dropdown closed');
                return;
            }

            dropdown.style.display = 'block';
            dropdown.innerHTML = 'Loading tags...';
            console.log('Fetching tags for dropdown');

            try {
                const response = await fetch('/tags/list');
                if (!response.ok) throw new Error('Failed to fetch tags');

                const tags = await response.json();
                if (tags.length === 0) {
                    dropdown.innerHTML = '<em>No tags found</em>';
                    console.log('No tags found');
                    return;
                }

                const tagItems = tags.map(tag => {
                    const isSelected = selectedTags.has(tag.name);
                    return `
                        <div class="tag-item${isSelected ? ' selected' : ''}" data-name="${tag.name}">
                            ${tag.name}
                        </div>
                    `;
                }).join('');

                dropdown.innerHTML = `
                    <div id="tagListContainer">${tagItems}</div>
                    <button type="button" id="doneSelectingTags" style="margin-top: 10px; width: 100%; padding: 8px; background-color:rgb(226, 97, 74); color: white; border: none; border-radius: 6px; cursor: pointer;">
                        Done
                    </button>
                `;

                dropdown.querySelectorAll('.tag-item').forEach(tagEl => {
                    tagEl.addEventListener('click', () => {
                        const tagName = tagEl.dataset.name;
                        if (selectedTags.has(tagName)) {
                            selectedTags.delete(tagName);
                            tagEl.classList.remove('selected');
                            console.log(`Tag deselected: ${tagName}`);
                        } else {
                            selectedTags.add(tagName);
                            tagEl.classList.add('selected');
                            console.log(`Tag selected: ${tagName}`);
                        }
                        document.getElementById('selectedTagsInput').value = Array.from(selectedTags).join(',');
                    });
                });

                document.getElementById('doneSelectingTags').addEventListener('click', () => {
                    dropdown.style.display = 'none';
                    console.log('Tags dropdown closed with Done button');
                });
            } catch (error) {
                dropdown.innerHTML = `<em>Error loading tags</em>`;
                console.error(`Error loading tags: ${error.message}`);
            }
        });
    }

    // Photo Upload Preview
    const photoInput = document.getElementById('photoInput');
    if (photoInput) {
        photoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('photoPreviewContainer');
            const previewImage = document.getElementById('photoPreview');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                    previewContainer.style.display = 'block';
                    console.log(`Photo selected for upload: ${file.name}`);
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
                console.log('No valid photo selected');
            }
        });
    }

    // Show success toast when a post is uploaded
    const successInput = document.getElementById('postSuccessMessage');
    if (successInput) {
        const message = successInput.value;
        showToast(message);
        console.log(`Post success message: ${message}`);
    }

    // Toast Notification Function
    function showToast(message) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.position = 'fixed';
        toast.style.bottom = '30px';
        toast.style.right = '30px';
        toast.style.backgroundColor = '#28a745';
        toast.style.color = 'white';
        toast.style.padding = '12px 20px';
        toast.style.borderRadius = '6px';
        toast.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
        toast.style.zIndex = '9999';
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.4s ease';

        document.body.appendChild(toast);
        requestAnimationFrame(() => {
            toast.style.opacity = '1';
        });

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.addEventListener('transitionend', () => {
                toast.remove();
            });
        }, 3000);
    }

    // Image Modal
    const modal = document.getElementById('imageModal');
    if (modal) {
        const modalImg = document.getElementById('modalImage');
        const closeBtn = modal.querySelector('.close-modal');

        document.querySelectorAll('.clickable-image').forEach(img => {
            img.addEventListener('click', () => {
                modal.style.display = 'flex';
                modalImg.src = img.src;
                console.log(`Image modal opened for: ${img.src}`);
            });
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
            modalImg.src = '';
            console.log('Image modal closed');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
                modalImg.src = '';
                console.log('Image modal closed by clicking outside');
            }
        });
    }
    // Feed Tabs (Duplicate block removed to fix redeclaration error)
});
// Example function to update tags
function updateTagsPreview(tagsArray) {
    const tagsPreview = document.getElementById('tagsPreview');
    const selectedTagsInput = document.getElementById('selectedTagsInput');

    if (tagsArray.length === 0) {
        tagsPreview.style.display = 'none';
        tagsPreview.innerHTML = '';
        selectedTagsInput.value = '';
        return;
    }

    // Show the preview div
    tagsPreview.style.display = 'block';

    // Create tag pills or comma-separated string
    tagsPreview.innerHTML = tagsArray.map(tag => `<span style="background:#e63946; color:#fff; padding: 3px 8px; border-radius: 12px; margin-right: 5px;">${tag}</span>`).join('');

    // Update hidden input value as CSV
    selectedTagsInput.value = tagsArray.join(',');
}
// Comment button toggles comments section below post
document.querySelectorAll('.comment-btn').forEach(button => {
    button.addEventListener('click', () => {
        const postCard = button.closest('.post-card');
        const commentsSection = postCard.querySelector('.comments-section');
        if (commentsSection.style.display === 'none' || commentsSection.style.display === '') {
            commentsSection.style.display = 'block';
        } else {
            commentsSection.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Attach click event to all "See more comments" buttons to open modal
    document.querySelectorAll('[id^="show-comments-"]').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.id.replace('show-comments-', '');
            const modal = document.getElementById(`comments-modal-${postId}`);
            if (modal) {
                modal.style.display = 'block';
            }
        });
    });

    // Close modal when clicking on close button (×)
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function () {
            const modal = this.closest('.custom-modal, .image-modal');
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Optional: Close modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        document.querySelectorAll('.custom-modal').forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        document.querySelectorAll('.image-modal').forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Image modal viewer
    document.querySelectorAll('.clickable-image').forEach(img => {
        img.addEventListener('click', () => {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = img.src;
        });
    });
});

// Clipboard copy for post URLs
function copyPostUrl(postId) {
    const url = `${window.location.origin}/posts/${postId}`;
    navigator.clipboard.writeText(url).then(() => {
        alert("Post link copied to clipboard!");
    }).catch(err => {
        console.error("Failed to copy: ", err);
    });
}


document.addEventListener('DOMContentLoaded', function() {
    // Show modal when "See more comments" is clicked
    document.querySelectorAll('.show-comments-btn').forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.getAttribute('data-post-id');
            const modal = document.getElementById(`comments-modal-${postId}`);
            const overlay = document.querySelector('.modal-overlay');

            modal.style.display = 'block';
            overlay.style.display = 'block';
        });
    });

    // Close modal when X button is clicked
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.custom-modal');
            const overlay = document.querySelector('.modal-overlay');

            modal.style.display = 'none';
            overlay.style.display = 'none';
        });
    });




// Add this to your socialfeed.js
document.addEventListener('touchstart', function() {}, {passive: true});



document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.tag-checkbox');
    const hiddenInput = document.getElementById('selectedTags');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selected = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            // Update hidden input value
            hiddenInput.value = selected;
        });
    });
});


    document.addEventListener('DOMContentLoaded', async () => {
        const dropdown = document.getElementById('tagsDropdown');
        const hiddenInput = document.getElementById('selectedTags');
        let selectedTagIds = [];

        // Fetch tags from your backend endpoint
        const response = await fetch('/api/tags'); // create this endpoint
        const tags = await response.json();

        tags.forEach(tag => {
            const item = document.createElement('div');
            item.classList.add('form-check');

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.classList.add('form-check-input');
            checkbox.value = tag.id;
            checkbox.id = `tag-${tag.id}`;

            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    selectedTagIds.push(tag.id);
                } else {
                    selectedTagIds = selectedTagIds.filter(id => id !== tag.id);
                }
                hiddenInput.value = JSON.stringify(selectedTagIds); // update hidden input
            });

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.htmlFor = `tag-${tag.id}`;
            label.innerText = tag.name;

            item.appendChild(checkbox);
            item.appendChild(label);
            dropdown.appendChild(item);
        });
    }
    );
