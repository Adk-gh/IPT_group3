<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/admin-usermanagement.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-usermanagement.js') }}" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
   @include('admin.adminsidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1 class="header-title">User Management</h1>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search users...">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>
                <div class="user-menu">
                    <div class="user-avatar">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin">
                    </div>
                    <div class="user-name">Admin User</div>
                    <div class="user-dropdown">
                        <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Analytics -->
        <div class="dashboard">
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-title">Total Users</div>
                <div class="stat-value">8,742</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 12.5% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon artists">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="stat-title">Verified Artists</div>
                <div class="stat-value">512</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 3.7% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon reports">
                    <i class="fas fa-user-lock"></i>
                </div>
                <div class="stat-title">Banned Users</div>
                <div class="stat-value">42</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 2.4% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="stat-title">New This Week</div>
                <div class="stat-value">127</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8.2% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="stat-title">Inactive Users</div>
                <div class="stat-value">1,245</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 5.1% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="stat-title">Moderators</div>
                <div class="stat-value">18</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 1 new this month
                </div>
            </div>
        </div>

        <!-- Filter Panel -->
        <div class="filter-panel">
            <div class="filter-header">
                <h3 class="filter-title">Filter Users</h3>
                <button class="btn btn-secondary btn-sm">
                    <i class="fas fa-sync-alt"></i> Reset Filters
                </button>
            </div>
            <div class="filter-body">
                <div class="form-group">
                    <label class="form-label">Search By</label>
                    <select class="form-control">
                        <option>Username</option>
                        <option>Email</option>
                        <option>User ID</option>
                        <option>Location</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Verification Status</label>
                    <select class="form-control">
                        <option>All Users</option>
                        <option>Verified Artists</option>
                        <option>Not Verified</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Account Status</label>
                    <select class="form-control">
                        <option>All Statuses</option>
                        <option>Active</option>
                        <option>Banned</option>
                        <option>Pending</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" placeholder="Country, city...">
                </div>
                <div class="form-group">
                    <label class="form-label">Last Active</label>
                    <select class="form-control">
                        <option>Any Time</option>
                        <option>Last 24 Hours</option>
                        <option>Last Week</option>
                        <option>Last Month</option>
                        <option>Over 30 Days</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Artworks Uploaded</label>
                    <select class="form-control">
                        <option>Any Amount</option>
                        <option>None</option>
                        <option>1-5</option>
                        <option>6-20</option>
                        <option>21-50</option>
                        <option>50+</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Sort By</label>
                    <select class="form-control">
                        <option>Recently Joined</option>
                        <option>Recently Active</option>
                        <option>Most Artworks</option>
                        <option>Alphabetical</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select class="form-control">
                        <option>All Roles</option>
                        <option>Basic User</option>
                        <option>Artist</option>
                        <option>Moderator</option>
                        <option>Admin</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- User Table -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">All Users</h3>
                <div class="table-actions">
                    <button class="btn btn-primary btn-sm" id="addUserBtn">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Artworks</th>
                            <th>Location</th>
                            <th>Last Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Sarah Johnson</div>
                                        <div class="user-email">sarah.j@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status active">Active</span>
                            </td>
                            <td>
                                <span class="badge badge-success">Artist</span>
                            </td>
                            <td>42</td>
                            <td>London, UK</td>
                            <td>2 hours ago</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(1)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">David Peterson</div>
                                        <div class="user-email">david.p@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status active">Active</span>
                            </td>
                            <td>
                                <span class="badge badge-warning">Moderator</span>
                            </td>
                            <td>128</td>
                            <td>New York, USA</td>
                            <td>30 minutes ago</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(2)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Lena Kowalski</div>
                                        <div class="user-email">lena.k@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status banned">Banned</span>
                            </td>
                            <td>
                                <span class="badge badge-primary">User</span>
                            </td>
                            <td>0</td>
                            <td>Berlin, Germany</td>
                            <td>3 days ago</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(3)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Unban">
                                        <i class="fas fa-unlock"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">James Lee</div>
                                        <div class="user-email">james.l@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status active">Active</span>
                            </td>
                            <td>
                                <span class="badge badge-success">Artist</span>
                            </td>
                            <td>34</td>
                            <td>Tokyo, Japan</td>
                            <td>1 hour ago</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(4)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Priya Kumar</div>
                                        <div class="user-email">priya.k@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status pending">Pending</span>
                            </td>
                            <td>
                                <span class="badge badge-primary">User</span>
                            </td>
                            <td>5</td>
                            <td>Mumbai, India</td>
                            <td>5 days ago</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(5)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Verify">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Michael Chen</div>
                                        <div class="user-email">michael.c@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status active">Active</span>
                            </td>
                            <td>
                                <span class="badge badge-danger">Admin</span>
                            </td>
                            <td>215</td>
                            <td>San Francisco, USA</td>
                            <td>Just now</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(6)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Emma Wilson</div>
                                        <div class="user-email">emma.w@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status active">Active</span>
                            </td>
                            <td>
                                <span class="badge badge-primary">User</span>
                            </td>
                            <td>12</td>
                            <td>Paris, France</td>
                            <td>1 day ago</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(7)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Marcus Taylor</div>
                                        <div class="user-email">marcus.t@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status active">Active</span>
                            </td>
                            <td>
                                <span class="badge badge-success">Artist</span>
                            </td>
                            <td>87</td>
                            <td>Melbourne, Australia</td>
                            <td>3 hours ago</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="View Profile" onclick="openUserModal(8)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1 to 8 of 8,742 users</div>
                <div class="pagination-btns">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn">10</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- User Profile Modal -->
    <div class="modal" id="userModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">User Profile</h3>
                <button class="modal-close" onclick="closeUserModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" id="modalUserAvatar">
                    </div>
                    <div class="profile-info">
                        <h2 class="profile-name" id="modalUserName">Sarah Johnson</h2>
                        <div class="profile-username" id="modalUserUsername">@sarah_artist</div>
                        <div class="profile-badges">
                            <span class="badge badge-success" id="modalUserRole">Artist</span>
                            <span class="badge badge-primary" id="modalUserStatus">Active</span>
                        </div>
                        <div class="profile-stats">
                            <div class="profile-stat">
                                <div class="profile-stat-value" id="modalUserArtworks">42</div>
                                <div class="profile-stat-label">Artworks</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-value" id="modalUserFollowers">1.2k</div>
                                <div class="profile-stat-label">Followers</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-value" id="modalUserFollowing">356</div>
                                <div class="profile-stat-label">Following</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab active" data-target="profileDetails">Details</div>
                    <div class="tab" data-target="profileArtworks">Artworks</div>
                    <div class="tab" data-target="profileActivity">Activity</div>
                    <div class="tab" data-target="profileReports">Reports</div>
                    <div class="tab" data-target="profileAdmin">Admin</div>
                </div>

                <div class="tab-content active" id="profileDetails">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="Sarah Johnson" id="modalUserFullName">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="sarah.j@example.com" id="modalUserEmail">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="+1 555-123-4567" id="modalUserPhone">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" value="London, UK" id="modalUserLocation">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Joined Date</label>
                                <input type="text" class="form-control" value="June 12, 2023" readonly id="modalUserJoined">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Active</label>
                                <input type="text" class="form-control" value="2 hours ago" readonly id="modalUserLastActive">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control form-textarea" id="modalUserBio">Street artist based in London. Specializing in large-scale murals and stencil work. Passionate about urban art and community projects.</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Social Links</label>
                        <div class="form-row">
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Instagram" value="@sarah_artist" id="modalUserInstagram">
                            </div>
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Twitter" value="@sarah_art" id="modalUserTwitter">
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 10px;">
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Website" value="sarahjohnsonart.com" id="modalUserWebsite">
                            </div>
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Portfolio" value="behance.net/sarahjohnson" id="modalUserPortfolio">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileArtworks">
                    <p>User's uploaded artworks would be displayed here in a grid or list view.</p>
                    <div class="card-grid" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-body">
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Urban Dreams</div>
                                        <div class="art-artist">Shoreditch, London</div>
                                        <div class="art-artist"><small>Uploaded: 3 days ago</small></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-secondary btn-sm">View</button>
                                <button class="btn btn-primary btn-sm">Feature</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-conojeghuo-173301.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Color Explosion</div>
                                        <div class="art-artist">Camden, London</div>
                                        <div class="art-artist"><small>Uploaded: 1 week ago</small></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-secondary btn-sm">View</button>
                                <button class="btn btn-primary btn-sm">Feature</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileActivity">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-upload"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">Today, 10:15 AM</div>
                                <div class="timeline-text">Uploaded new artwork "Urban Dreams"</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">Yesterday, 5:30 PM</div>
                                <div class="timeline-text">Commented on artwork "Neon Installation" by @dface</div>
                                <div class="timeline-user">
                                    <div class="timeline-user-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User">
                                    </div>
                                    <div class="timeline-user-name">David Peterson</div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">Yesterday, 3:20 PM</div>
                                <div class="timeline-text">Liked artwork "Abstract Flow" by @felipe_pantone</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">2 days ago</div>
                                <div class="timeline-text">Started following @banksy</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileReports">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-flag"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">3 days ago</div>
                                <div class="timeline-text">Reported for inappropriate content</div>
                                <div class="timeline-text"><strong>Status:</strong> <span class="badge badge-warning">Pending Review</span></div>
                                <div class="timeline-user">
                                    <div class="timeline-user-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User">
                                    </div>
                                    <div class="timeline-user-name">Emma Wilson</div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">1 week ago</div>
                                <div class="timeline-text">Warning issued for spam behavior</div>
                                <div class="timeline-text"><strong>Admin:</strong> Michael Chen</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-flag"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">2 weeks ago</div>
                                <div class="timeline-text">Report filed for incorrect location</div>
                                <div class="timeline-text"><strong>Status:</strong> <span class="badge badge-success">Resolved</span></div>
                                <div class="timeline-user">
                                    <div class="timeline-user-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User">
                                    </div>
                                    <div class="timeline-user-name">Marcus Taylor</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileAdmin">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Account Status</label>
                                <select class="form-control" id="modalUserAccountStatus">
                                    <option value="active">Active</option>
                                    <option value="banned">Banned</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Role</label>
                                <select class="form-control" id="modalUserAccountRole">
                                    <option value="user">Basic User</option>
                                    <option value="artist" selected>Artist</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Verification Status</label>
                                <select class="form-control" id="modalUserVerification">
                                    <option value="verified" selected>Verified Artist</option>
                                    <option value="unverified">Not Verified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Featured Status</label>
                                <select class="form-control" id="modalUserFeatured">
                                    <option value="featured">Featured</option>
                                    <option value="regular" selected>Regular</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Admin Notes</label>
                        <textarea class="form-control form-textarea" id="modalUserAdminNotes">User has been active and contributing quality content. No issues reported except one minor location correction needed.</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Actions</label>
                        <div class="form-row">
                            <div class="form-col">
                                <button class="btn btn-secondary" style="width: 100%;">
                                    <i class="fas fa-key"></i> Reset Password
                                </button>
                            </div>
                            <div class="form-col">
                                <button class="btn btn-secondary" style="width: 100%;">
                                    <i class="fas fa-envelope"></i> Send Message
                                </button>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 10px;">
                            <div class="form-col">
                                <button class="btn btn-warning" style="width: 100%;">
                                    <i class="fas fa-exclamation-triangle"></i> Issue Warning
                                </button>
                            </div>
                            <div class="form-col">
                                <button class="btn btn-danger" style="width: 100%;">
                                    <i class="fas fa-trash"></i> Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeUserModal()">Cancel</button>
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal" id="addUserModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New User</h3>
                <button class="modal-close" onclick="closeAddUserModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="First name">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Email address">
                </div>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <select class="form-control">
                                <option>Basic User</option>
                                <option>Artist</option>
                                <option>Moderator</option>
                                <option>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control">
                                <option>Active</option>
                                <option>Pending</option>
                                <option>Banned</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea class="form-control form-textarea" placeholder="Short bio..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeAddUserModal()">Cancel</button>
                <button class="btn btn-primary">Create User</button>
            </div>
        </div>
    </div>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
