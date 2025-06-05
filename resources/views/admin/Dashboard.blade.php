<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-dashboard.js') }}" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
   @include('admin.adminsidebar')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        @include('admin.adminnavbar')

        <!-- Dashboard Stats -->
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
                <div class="stat-icon art">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div class="stat-title">Artworks Uploaded</div>
                <div class="stat-value">25,189</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8.3% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon locations">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-title">Tagged Locations</div>
                <div class="stat-value">3,456</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 5.1% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon reports">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-title">Reports</div>
                <div class="stat-value">42</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 2.4% from last month
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
                <div class="stat-icon comments">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-title">Comments This Week</div>
                <div class="stat-value">1,287</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 15.2% from last week
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-activity">
            <h2 class="section-title">
                Recent Activity
                <a href="#">View All</a>
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-avatar">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                    </div>
                    <div class="activity-content">
                        <div class="activity-user">Sarah Johnson</div>
                        <div class="activity-action">uploaded a new artwork "Urban Dreams"</div>
                        <div class="activity-time">10 minutes ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-avatar">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User">
                    </div>
                    <div class="activity-content">
                        <div class="activity-user">David Peterson</div>
                        <div class="activity-action">commented on "Neon Installation"</div>
                        <div class="activity-time">25 minutes ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-avatar">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                    </div>
                    <div class="activity-content">
                        <div class="activity-user">Lena Kowalski</div>
                        <div class="activity-action">reported an artwork for inappropriate content</div>
                        <div class="activity-time">1 hour ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-avatar">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                    </div>
                    <div class="activity-content">
                        <div class="activity-user">James Lee</div>
                        <div class="activity-action">created a new collection "Berlin Street Art"</div>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-avatar">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="User">
                    </div>
                    <div class="activity-content">
                        <div class="activity-user">Priya Kumar</div>
                        <div class="activity-action">verified artist profile for @felipe_pantone</div>
                        <div class="activity-time">4 hours ago</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Recent Users</h3>
                <div class="table-actions">
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Joined</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Artworks</th>
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
                            <td>Jun 12, 2023</td>
                            <td><span class="status active">Active</span></td>
                            <td>Member</td>
                            <td>42</td>
                            <td>
                                <div class="action-btns">
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
                            <td>May 28, 2023</td>
                            <td><span class="status active">Active</span></td>
                            <td>Artist</td>
                            <td>128</td>
                            <td>
                                <div class="action-btns">
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
                            <td>Apr 15, 2023</td>
                            <td><span class="status active">Active</span></td>
                            <td>Moderator</td>
                            <td>76</td>
                            <td>
                                <div class="action-btns">
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
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">James Lee</div>
                                        <div class="user-email">james.l@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>Mar 30, 2023</td>
                            <td><span class="status active">Active</span></td>
                            <td>Member</td>
                            <td>34</td>
                            <td>
                                <div class="action-btns">
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
                            <td>Feb 18, 2023</td>
                            <td><span class="status active">Active</span></td>
                            <td>Artist</td>
                            <td>215</td>
                            <td>
                                <div class="action-btns">
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
                <div class="pagination-info">Showing 1 to 5 of 8,742 users</div>
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

        <!-- Pending Artwork Approvals -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Pending Artwork Approvals</h3>
                <div class="table-actions">
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-check"></i> Approve All
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
                            <th>Artwork</th>
                            <th>Artist</th>
                            <th>Location</th>
                            <th>Uploaded</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Urban Dreams</div>

                                    </div>
                                </div>
                            </td>
                            <td>Sarah Johnson</td>
                            <td>Shoreditch, London</td>
                            <td>Today, 10:15 AM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-conojeghuo-173301.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Color Explosion</div>
                                        <div class="art-artist">@maya_hayuk</div>
                                    </div>
                                </div>
                            </td>
                            <td>David Peterson</td>
                            <td>Williamsburg, NYC</td>
                            <td>Today, 9:30 AM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-fernando-dos-santos-campos-1309016-2510245 (1).jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">The Thinker</div>
                                        <div class="art-artist">Unknown Artist</div>
                                    </div>
                                </div>
                            </td>
                            <td>Lena Kowalski</td>
                            <td>Berlin, Germany</td>
                            <td>Yesterday, 5:45 PM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-heftiba-1194420.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Neon Dreams</div>
                                        <div class="art-artist">@dface</div>
                                    </div>
                                </div>
                            </td>
                            <td>James Lee</td>
                            <td>Downtown LA</td>
                            <td>Yesterday, 3:20 PM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-tobiasbjorkli-2119706 (1).jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Abstract Flow</div>
                                        <div class="art-artist">@felipe_pantone</div>
                                    </div>
                                </div>
                            </td>
                            <td>Priya Kumar</td>
                            <td>Wynwood, Miami</td>
                            <td>Yesterday, 1:10 PM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1 to 5 of 12 pending approvals</div>
                <div class="pagination-btns">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="card-grid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Reports</h3>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User">
                            </div>
                            <div class="activity-content">
                                <div class="activity-user">Emma Wilson</div>
                                <div class="activity-action">reported artwork for inappropriate content</div>
                                <div class="activity-time">30 minutes ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User">
                            </div>
                            <div class="activity-content">
                                <div class="activity-user">Marcus Taylor</div>
                                <div class="activity-action">reported user for spam</div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                            </div>
                            <div class="activity-content">
                                <div class="activity-user">Sarah Johnson</div>
                                <div class="activity-action">reported incorrect location</div>
                                <div class="activity-time">5 hours ago</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-sm">View All Reports</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">System Status</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Maintenance Mode</label>
                        <select class="form-control">
                            <option>Disabled</option>
                            <option>Enabled (Admin Only)</option>
                            <option>Enabled (All Users)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Backup</label>
                        <input type="text" class="form-control" value="2023-06-15 02:30 AM" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Storage Usage</label>
                        <div style="background-color: var(--secondary); height: 10px; border-radius: 5px; margin-bottom: 5px;">
                            <div style="width: 65%; height: 100%; background-color: var(--accent); border-radius: 5px;"></div>
                        </div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">65% used (14.2 GB of 20 GB)</div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-secondary btn-sm">Run Backup Now</button>
                    <button class="btn btn-primary btn-sm">System Settings</button>
                </div>
            </div>
        </div>

        <!-- Location Management -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Location Management</h3>
                <div class="table-actions">
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Location
                    </button>
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>
            <div class="map-container">
                <div id="adminMap"></div>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1,200 locations in New York City</div>
                <div class="pagination-btns">
                    <button class="btn btn-primary btn-sm">View Full Map</button>
                </div>
            </div>
        </div>

        <!-- Artist Verification Requests -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Artist Verification Requests</h3>
                <div class="table-actions">
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Artist</th>
                            <th>Portfolio</th>
                            <th>Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/22.jpg" alt="Artist">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Sophia Martinez</div>
                                        <div class="user-email">@sophia_art</div>
                                    </div>
                                </div>
                            </td>
                            <td>sophiamartinez.com</td>
                            <td>Today, 11:20 AM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Artist">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Carlos Mendez</div>
                                        <div class="user-email">@carlos_streetart</div>
                                    </div>
                                </div>
                            </td>
                            <td>instagram.com/carlos_streetart</td>
                            <td>Yesterday, 6:45 PM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Artist">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Aisha Johnson</div>
                                        <div class="user-email">@aisha_creates</div>
                                    </div>
                                </div>
                            </td>
                            <td>aishajohnson.com</td>
                            <td>Yesterday, 4:30 PM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1 to 3 of 8 verification requests</div>
                <div class="pagination-btns">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
