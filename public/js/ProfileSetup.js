document.addEventListener('DOMContentLoaded', function() {
    // Modal Functionality
    const modalOverlay = document.getElementById('modalOverlay');
    const modalClose = document.getElementById('modalClose');
    const openModalBtn = document.getElementById('openModalBtn');

    if (openModalBtn) {
        openModalBtn.addEventListener('click', () => {
            modalOverlay.style.display = 'flex';
        });
    }

    if (modalClose) {
        modalClose.addEventListener('click', () => {
            modalOverlay.style.display = 'none';
        });
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.style.display = 'none';
            }
        });
    }

    // Step Navigation
    const steps = document.querySelectorAll('.step');
    const formSteps = document.querySelectorAll('.form-step');
    const progressBar = document.getElementById('progressBar');
    const nextBtn1 = document.getElementById('nextBtn1');
    const nextBtn2 = document.getElementById('nextBtn2');
    const backBtn1 = document.getElementById('backBtn1');
    const backBtn2 = document.getElementById('backBtn2');

    function updateStep(stepNumber) {
        // Update active step indicator
        steps.forEach((step, index) => {
            if (index < stepNumber) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });

        // Update form step visibility
        formSteps.forEach((step, index) => {
            if (index === stepNumber - 1) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });

        // Update progress bar
        if (progressBar) {
            progressBar.style.width = `${(stepNumber / 3) * 100}%`;
        }
    }

    if (nextBtn1) {
        nextBtn1.addEventListener('click', () => {
            const displayName = document.getElementById('displayName').value;
            if (!displayName) {
                showNotification('Please enter your display name');
                return;
            }
            updateStep(2);
        });
    }

    if (nextBtn2) nextBtn2.addEventListener('click', () => updateStep(3));
    if (backBtn1) backBtn1.addEventListener('click', () => updateStep(1));
    if (backBtn2) backBtn2.addEventListener('click', () => updateStep(2));

    // Image Upload Functionality (reusable for both avatar and banner)
    function setupImageUpload(uploadBtnId, inputId, previewId, imageId, removeBtnId) {
        const uploadBtn = document.getElementById(uploadBtnId);
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const image = document.getElementById(imageId);
        const removeBtn = document.getElementById(removeBtnId);

        if (!uploadBtn || !input || !preview || !image || !removeBtn) return;

        uploadBtn.addEventListener('click', () => input.click());

        input.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image.src = e.target.result;
                    image.style.display = 'block';
                    preview.querySelector('i').style.display = 'none';
                    removeBtn.style.display = 'inline-block';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        removeBtn.addEventListener('click', function() {
            input.value = '';
            image.src = '';
            image.style.display = 'none';
            preview.querySelector('i').style.display = 'block';
            removeBtn.style.display = 'none';
        });
    }

    // Setup avatar and banner uploads
    setupImageUpload('uploadBtn', 'avatarInput', 'avatarPreview', 'avatarImage', 'removeBtn');
    setupImageUpload('uploadBannerBtn', 'bannerInput', 'bannerPreview', 'bannerImage', 'removeBannerBtn');

    // Style Tags Selection with Limit
    const tagCheckboxes = document.querySelectorAll('input[name="style-tag"], input[name="style_tag[]"]');
    const tagCounter = document.getElementById('tagCounter');
    const maxTags = 3;

    if (tagCheckboxes.length && tagCounter) {
        tagCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkedCount = document.querySelectorAll('input[name="style-tag"]:checked, input[name="style_tag[]"]:checked').length;
                tagCounter.textContent = `${checkedCount}/${maxTags} tags selected`;

                if (checkedCount >= maxTags) {
                    tagCheckboxes.forEach(cb => {
                        if (!cb.checked) cb.disabled = true;
                    });
                    tagCounter.style.color = 'var(--accent)';
                    tagCounter.style.fontWeight = '600';
                } else {
                    tagCheckboxes.forEach(cb => cb.disabled = false);
                    tagCounter.style.color = 'var(--text-light)';
                    tagCounter.style.fontWeight = 'normal';
                }
            });
        });
    }

    // Form Submission
    const artIdentityForm = document.getElementById('artIdentityForm');
    if (artIdentityForm) {
        artIdentityForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get selected tags
            const selectedTags = [];
            document.querySelectorAll('input[name="style-tag"]:checked, input[name="style_tag[]"]:checked').forEach(checkbox => {
                selectedTags.push(checkbox.nextElementSibling.textContent);
            });

            // Here you would typically send all form data to your backend
            console.log('Profile setup complete:', {
                // Step 1 data
                avatar: document.getElementById('avatarInput').files[0]?.name || null,
                displayName: document.getElementById('displayName').value,
                location: document.getElementById('location').value,
                bio: document.getElementById('bio').value,

                // Step 2 data
                roles: Array.from(document.querySelectorAll('input[name="role"]:checked')).map(cb => cb.nextElementSibling.textContent),
                instagram: document.querySelector('.social-link:nth-child(1) input')?.value,
                twitter: document.querySelector('.social-link:nth-child(2) input')?.value,
                behance: document.querySelector('.social-link:nth-child(3) input')?.value,
                website: document.querySelector('.social-link:nth-child(4) input')?.value,

                // Step 3 data
                banner: document.getElementById('bannerInput').files[0]?.name || null,
                styleTags: selectedTags
            });

            showNotification('Profile setup complete!');

            setTimeout(() => {
                if (modalOverlay) modalOverlay.style.display = 'none';
                // In a real app, you would redirect to the profile page
                // window.location.href = 'profile.html';
            }, 2000);
        });
    }

    // Notification Function
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
