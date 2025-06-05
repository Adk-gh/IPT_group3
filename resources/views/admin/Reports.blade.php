<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Reports & Moderation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin-reports.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-reports.js') }}" defer></script>
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
                <h1 class="header-title">Reports & Moderation</h1>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search reports...">
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

        <!-- Reports Analytics -->
        <div class="dashboard">
            <div class="stat-card">
                <div class="stat-icon reports">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-title">Total Reports This Week</div>
                <div class="stat-value">42</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 12.5% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon art">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div class="stat-title">Artwork Reports</div>
                <div class="stat-value">28</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8.3% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon comments">
                    <i class="fas fa-comment"></i>
                </div>
                <div class="stat-title">Comment Reports</div>
                <div class="stat-value">9</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 5.1% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon users">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stat-title">User Reports</div>
                <div class="stat-value">5</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 2.4% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon trending">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-title">Trending Issues</div>
                <div class="stat-value">3</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 15.2% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon auto">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="stat-title">Auto-Moderated</div>
                <div class="stat-value">18</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 7.8% from last week
                </div>
            </div>
        </div>

        <!-- Reports Filter -->
        <div class="reports-filter">
            <div class="filter-header">
                <h3 class="filter-title">Filter Reports</h3>
                <span class="filter-reset">Reset Filters</span>
            </div>
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Report Type</label>
                    <select class="filter-control">
                        <option value="">All Types</option>
                        <option value="art">Artwork</option>
                        <option value="comment">Comment</option>
                        <option value="user">User Behavior</option>
                        <option value="location">Location Info</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-control">
                        <option value="">All Statuses</option>
                        <option value="open">Open</option>
                        <option value="resolved">Resolved</option>
                        <option value="ignored">Ignored</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Reported By</label>
                    <input type="text" class="filter-control" placeholder="Username or email">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Reported Content</label>
                    <input type="text" class="filter-control" placeholder="Art title, comment, etc.">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Date Range</label>
                    <select class="filter-control">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Flags Threshold</label>
                    <select class="filter-control">
                        <option value="">Any</option>
                        <option value="1">1+ Flags</option>
                        <option value="3">3+ Flags</option>
                        <option value="5">5+ Flags</option>
                        <option value="10">10+ Flags</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Reports Table -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Recent Reports</h3>
                <div class="table-actions">
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-check"></i> Bulk Actions
                    </button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Content</th>
                            <th>Reported By</th>
                            <th>Against</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="report-type art">
                                    <i class="fas fa-paint-brush"></i> Artwork
                                </span>
                            </td>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Urban Flame</div>
                                        <div class="art-artist">by @inkboi</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Sarah Johnson</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">David Peterson</div>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 7, 10:15 AM</td>
                            <td><span class="status open">Open</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View" data-report="1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn resolve" title="Resolve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn ignore" title="Ignore">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="report-type comment">
                                    <i class="fas fa-comment"></i> Comment
                                </span>
                            </td>
                            <td>
                                "This is clearly stolen art, the original..."
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Marcus Taylor</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Priya Kumar</div>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 6, 5:30 PM</td>
                            <td><span class="status open">Open</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View" data-report="2">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn resolve" title="Resolve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn ignore" title="Ignore">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="report-type user">
                                    <i class="fas fa-user"></i> User
                                </span>
                            </td>
                            <td>
                                Harassment in DMs
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Emma Wilson</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">James Lee</div>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 6, 2:45 PM</td>
                            <td><span class="status resolved">Resolved</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View" data-report="3">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn resolve" title="Resolve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn ignore" title="Ignore">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="report-type location">
                                    <i class="fas fa-map-marker-alt"></i> Location
                                </span>
                            </td>
                            <td>
                                Incorrect geotag - artwork is in Berlin, not Munich
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Lena Kowalski</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Aisha Johnson</div>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 5, 9:10 AM</td>
                            <td><span class="status ignored">Ignored</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View" data-report="4">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn resolve" title="Resolve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn ignore" title="Ignore">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="report-type art">
                                    <i class="fas fa-paint-brush"></i> Artwork
                                </span>
                            </td>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-tobiasbjorkli-2119706 (1).jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Abstract Flow</div>
                                        <div class="art-artist">by @felipe_pantone</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Carlos Mendez</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/22.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Sophia Martinez</div>
                                    </div>
                                </div>
                            </td>
                            <td>Apr 4, 7:30 PM</td>
                            <td><span class="status open">Open</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View" data-report="5">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn resolve" title="Resolve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn ignore" title="Ignore">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1 to 5 of 42 reports</div>
                <div class="pagination-btns">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn">9</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        <!-- Most Reported Users -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Most Reported Users</h3>
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
                            <th>User</th>
                            <th>Reports</th>
                            <th>Last Report</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">James Lee</div>
                                        <div class="user-email">@james_art</div>
                                    </div>
                                </div>
                            </td>
                            <td>12</td>
                            <td>Apr 6, 2023</td>
                            <td><span class="status open">Warning Issued</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Warn">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button class="action-btn" title="Suspend">
                                        <i class="fas fa-lock"></i>
                                    </button>
                                    <button class="action-btn" title="Ban">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Aisha Johnson</div>
                                        <div class="user-email">@aisha_creates</div>
                                    </div>
                                </div>
                            </td>
                            <td>8</td>
                            <td>Apr 5, 2023</td>
                            <td><span class="status resolved">No Action</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Warn">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button class="action-btn" title="Suspend">
                                        <i class="fas fa-lock"></i>
                                    </button>
                                    <button class="action-btn" title="Ban">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Carlos Mendez</div>
                                        <div class="user-email">@carlos_streetart</div>
                                    </div>
                                </div>
                            </td>
                            <td>6</td>
                            <td>Apr 4, 2023</td>
                            <td><span class="status open">Under Review</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Warn">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button class="action-btn" title="Suspend">
                                        <i class="fas fa-lock"></i>
                                    </button>
                                    <button class="action-btn" title="Ban">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1 to 3 of 12 frequently reported users</div>
                <div class="pagination-btns">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        <!-- Auto-Moderation Settings -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Auto-Moderation Settings</h3>
                <div class="table-actions">
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Rule</th>
                            <th>Action</th>
                            <th>Threshold</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hide content with multiple reports</td>
                            <td>Hide content temporarily</td>
                            <td>
                                <input type="number" class="form-control" value="5" style="width: 60px;">
                            </td>
                            <td><span class="status active">Active</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Notify admins of frequently reported content</td>
                            <td>Send notification</td>
                            <td>
                                <input type="number" class="form-control" value="3" style="width: 60px;">
                            </td>
                            <td><span class="status active">Active</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Temporarily restrict reported users</td>
                            <td>24h posting restriction</td>
                            <td>
                                <input type="number" class="form-control" value="3" style="width: 60px;">
                            </td>
                            <td><span class="status active">Active</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Automatically flag offensive keywords</td>
                            <td>Mark for review</td>
                            <td>N/A</td>
                            <td><span class="status active">Active</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Report Detail Modal -->
    <div class="modal" id="reportModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Report Details</h3>
                <button class="modal-close" id="modalClose">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4 class="section-title">
                        <i class="fas fa-flag"></i> Reported Content
                    </h4>
                    <div class="report-content">
                        <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Reported Artwork" class="report-preview">
                        <div class="report-reason">Reason: Inappropriate Content (Nudity)</div>
                        <div class="report-description">
                            "This artwork contains explicit nudity that violates community guidelines. It's visible in a public space where children might see it."
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <h4 class="section-title">
                        <i class="fas fa-user"></i> Reporter Information
                    </h4>
                    <div class="user-details">
                        <div class="user-avatar-md">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Reporter">
                        </div>
                        <div class="user-meta">
                            <div class="user-name-md">Sarah Johnson</div>
                            <div class="user-stats">
                                <div class="user-stat">
                                    <i class="fas fa-flag"></i> 12 Reports
                                </div>
                                <div class="user-stat">
                                    <i class="fas fa-check-circle"></i> 89% Accuracy
                                </div>
                                <div class="user-stat">
                                    <i class="fas fa-user"></i> Member since Jun 2022
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <h4 class="section-title">
                        <i class="fas fa-user-shield"></i> Reported User
                    </h4>
                    <div class="user-details">
                        <div class="user-avatar-md">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Reported User">
                        </div>
                        <div class="user-meta">
                            <div class="user-name-md">David Peterson (@inkboi)</div>
                            <div class="user-stats">
                                <div class="user-stat">
                                    <i class="fas fa-exclamation-triangle"></i> 3 Warnings
                                </div>
                                <div class="user-stat">
                                    <i class="fas fa-paint-brush"></i> 128 Artworks
                                </div>
                                <div class="user-stat">
                                    <i class="fas fa-user"></i> Verified Artist
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-section">
                    <h4 class="section-title">
                        <i class="fas fa-history"></i> Moderation History
                    </h4>
                    <div class="history-item">
                        <div class="history-date">Apr 7, 2023 - 10:15 AM</div>
                        <div class="history-action">Report Submitted</div>
                        <div class="history-note">User reported artwork for inappropriate content</div>
                    </div>
                    <div class="history-item">
                        <div class="history-date">Apr 7, 2023 - 10:30 AM</div>
                        <div class="history-action">Auto-Moderated</div>
                        <div class="history-note">Content temporarily hidden pending review (5+ reports)</div>
                    </div>
                </div>

                <div class="modal-section">
                    <h4 class="section-title">
                        <i class="fas fa-edit"></i> Internal Notes
                    </h4>
                    <textarea class="form-control form-textarea" placeholder="Add notes about this report..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary">
                    <i class="fas fa-times"></i> Dismiss Report
                </button>
                <button class="btn btn-warning">
                    <i class="fas fa-exclamation-triangle"></i> Warn User
                </button>
                <button class="btn btn-danger">
                    <i class="fas fa-trash"></i> Delete Content
                </button>
                <button class="btn btn-success">
                    <i class="fas fa-check"></i> Resolve Report
                </button>
            </div>
        </div>
    </div>

    <script src="resources/js/admin-reports.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
