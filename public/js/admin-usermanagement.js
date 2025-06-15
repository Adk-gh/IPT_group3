document.addEventListener('DOMContentLoaded', function() {
    console.log('[ADMIN] DOM fully loaded, initializing user management system');

    // Initialize Bootstrap components
    const viewUserModal = new bootstrap.Modal(document.getElementById('viewUserModal'));
    const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    const deleteUserModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
    const toast = new bootstrap.Toast(document.getElementById('toast'));

    // Track selected user
    let selectedUserId = null;

    // Tab functionality
    const tabs = document.querySelectorAll('.tabs .tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');

            clearSelection();
        });
    });

    // Checkbox functionality for users
    document.getElementById('selectAllUsersCheckbox')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('#usersTableBody .user-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    // Checkbox functionality for artists
    document.getElementById('selectAllArtistsCheckbox')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('#artistsTableBody .artist-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    // Update selected count
    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.user-checkbox:checked, .artist-checkbox:checked').length;
        const countElement = document.getElementById('selectedCount');
        const deleteBtn = document.getElementById('deleteSelectedBtn');

        if (countElement) countElement.textContent = selectedCount;
        if (deleteBtn) deleteBtn.disabled = selectedCount === 0;
    }

    // Clear all selections
    function clearSelection() {
        document.querySelectorAll('.user-checkbox, .artist-checkbox').forEach(cb => {
            cb.checked = false;
        });
        selectedUserId = null;
        updateSelectedCount();
    }

    // Handle checkbox changes
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('user-checkbox') || e.target.classList.contains('artist-checkbox')) {
            if (e.target.checked) {
                // Uncheck all other checkboxes in the same table
                const tableBody = e.target.closest('tbody');
                tableBody.querySelectorAll('.user-checkbox, .artist-checkbox').forEach(cb => {
                    if (cb !== e.target) cb.checked = false;
                });
                selectedUserId = e.target.value;
            } else {
                selectedUserId = null;
            }
            updateSelectedCount();
        }
    });

    // Event delegation for user actions
    document.addEventListener('click', async function(e) {
        // View User
        if (e.target.closest('.view-user-btn')) {
            const userId = e.target.closest('.view-user-btn').dataset.userId;
            try {
                const userData = await fetchUserData(userId);
                populateViewModal(userData);
                viewUserModal.show();
            } catch (error) {
                showToast(error.message || 'Failed to load user data', 'danger');
            }
        }

        // Edit User
        if (e.target.closest('.edit-user-btn')) {
            const userId = e.target.closest('.edit-user-btn').dataset.userId;
            try {
                const userData = await fetchUserData(userId);
                populateEditForm(userData);
                editUserModal.show();
            } catch (error) {
                showToast(error.message || 'Failed to load user data', 'danger');
            }
        }

        // Delete User
        if (e.target.closest('.delete-user-btn')) {
            const userId = e.target.closest('.delete-user-btn').dataset.userId;
            document.getElementById('deleteUserForm').action = `/admin/users/${userId}`;
            deleteUserModal.show();
        }
    });

    // Bulk Delete
    document.getElementById('deleteSelectedBtn')?.addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.user-checkbox:checked, .artist-checkbox:checked'))
                               .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            showToast('Please select at least one user to delete', 'warning');
            return;
        }

        if (confirm(`Are you sure you want to delete ${selectedIds.length} selected users?`)) {
            deleteUsers(selectedIds);
        }
    });

    // Search functionality for users
    document.getElementById('userSearch')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#usersTableBody tr');
        filterTableRows(rows, searchTerm);
    });

    // Search functionality for artists
    document.getElementById('artistSearch')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#artistsTableBody tr');
        filterTableRows(rows, searchTerm);
    });

    function filterTableRows(rows, searchTerm) {
        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(2) .fw-bold')?.textContent.toLowerCase() || '';
            const email = row.querySelector('td:nth-child(2) .text-muted')?.textContent.toLowerCase() || '';
            const location = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';

            if (name.includes(searchTerm) || email.includes(searchTerm) || location.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
                const checkbox = row.querySelector('.user-checkbox, .artist-checkbox');
                if (checkbox && checkbox.checked) {
                    checkbox.checked = false;
                    updateSelectedCount();
                }
            }
        });
    }
});

// Fetch single user data
async function fetchUserData(userId) {
    try {
        const response = await fetch(`/admin/users/${userId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to fetch user');
        }

        return await response.json();
    } catch (error) {
        console.error('Fetch error:', error);
        throw error;
    }
}

// Populate view modal
function populateViewModal(userData) {
    document.getElementById('viewUserName').textContent = userData?.name || 'N/A';
    document.getElementById('viewUserEmail').textContent = userData?.email || 'N/A';
    document.getElementById('viewUserPhone').textContent = userData?.phone || 'N/A';
    document.getElementById('viewUserLocation').textContent = userData?.location || 'Unknown';
    document.getElementById('viewUserBio').textContent = userData?.bio || 'No bio provided';

    document.getElementById('viewUserCreatedAt').textContent =
        userData?.created_at ? new Date(userData.created_at).toLocaleDateString() : 'Unknown';
    document.getElementById('viewUserLastActive').textContent =
        userData?.last_active_at ? new Date(userData.last_active_at).toLocaleString() : 'Never';

    document.getElementById('viewUserArtworks').textContent = userData?.artworks_count || 0;

    const avatar = document.getElementById('viewUserAvatar');
    avatar.src = userData?.profile_picture ? `/storage/${userData.profile_picture}` : '/img/default.jpg';
}

// Populate edit form
function populateEditForm(userData) {
    document.getElementById('editName').value = userData?.name || '';
    document.getElementById('editEmail').value = userData?.email || '';
    document.getElementById('editPhone').value = userData?.phone || '';
    document.getElementById('editLocation').value = userData?.location || '';
    document.getElementById('editBio').value = userData?.bio || '';
    document.getElementById('editVerifiedArtist').checked = userData?.verified_artist || false;

    const avatar = document.getElementById('editUserAvatar');
    avatar.src = userData?.profile_picture ? `/storage/${userData.profile_picture}` : '/img/default.jpg';

    document.getElementById('editUserForm').action = `/admin/users/${userData?.id || ''}`;
}

// Bulk delete users
async function deleteUsers(userIds) {
    try {
        const response = await fetch('/admin/users/bulk-delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ ids: userIds })
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Bulk delete failed');
        }

        const data = await response.json();
        showToast(`${userIds.length} users deleted successfully`, 'success');
        location.reload();
    } catch (error) {
        showToast(error.message, 'danger');
    }
}

// Show toast notification
function showToast(message, type = 'success') {
    const toastEl = document.getElementById('toast');
    const toastBody = toastEl.querySelector('.toast-body');

    toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
    toastBody.textContent = message;

    const toast = new bootstrap.Toast(toastEl);
    toast.show();
}
