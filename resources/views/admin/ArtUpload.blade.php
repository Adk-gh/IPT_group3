<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Art Uploads Management</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin-artupload.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-artupload.js') }}" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
    @include('admin.adminsidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
 @include('admin.adminnavbar')

        <!-- Uploads Summary -->
        <div class="dashboard">
            <div class="stat-card">
                <div class="stat-icon uploads">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="stat-title">Total Uploads</div>
                <div class="stat-value">25,189</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8.3% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-title">Pending Submissions</div>
                <div class="stat-value">12</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 2.1% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon approved">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-title">Approved</div>
                <div class="stat-value">23,456</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 5.7% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rejected">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-title">Rejected</div>
                <div class="stat-value">1,721</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 1.2% from last month
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon flagged">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-title">Flagged Reports</div>
                <div class="stat-value">8</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i> 3.5% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon weekly">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-title">Uploads This Week</div>
                <div class="stat-value">342</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 12.8% from last week
                </div>
            </div>
        </div>

        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="view-btn active" id="tableViewBtn">
                <i class="fas fa-list"></i> Table View
            </button>
            <button class="view-btn" id="gridViewBtn">
                <i class="fas fa-th-large"></i> Grid View
            </button>
        </div>

        <!-- Filters Section -->
        <div class="filter-section">
            <div class="filter-row">
                <div class="filter-group">
                    <label class="form-label">Status</label>
                    <select class="form-control">
                        <option>All Statuses</option>
                        <option>Pending</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                        <option>Flagged</option>
                        <option>Featured</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Artist Type</label>
                    <select class="form-control">
                        <option>All Artists</option>
                        <option>Verified Only</option>
                        <option>Regular Users</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Location</label>
                    <select class="form-control">
                        <option>All Locations</option>
                        <option>New York, USA</option>
                        <option>London, UK</option>
                        <option>Berlin, Germany</option>
                        <option>Tokyo, Japan</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>
            <div class="filter-row">
                <div class="filter-group">
                    <label class="form-label">Date Range</label>
                    <select class="form-control">
                        <option>All Time</option>
                        <option>Today</option>
                        <option>This Week</option>
                        <option>This Month</option>
                        <option>Last 3 Months</option>
                        <option>Custom Range</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Tag/Style</label>
                    <select class="form-control">
                        <option>All Tags</option>
                        <option>Graffiti</option>
                        <option>Mural</option>
                        <option>Stencil</option>
                        <option>Installation</option>
                        <option>Political</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Sort By</label>
                    <select class="form-control">
                        <option>Newest First</option>
                        <option>Oldest First</option>
                        <option>Most Popular</option>
                        <option>Most Reported</option>
                        <option>Title (A-Z)</option>
                        <option>Title (Z-A)</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-secondary">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
                <button class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </button>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="bulk-actions">
            <input type="checkbox" id="selectAll" class="bulk-checkbox">
            <label for="selectAll">Select All</label>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-check"></i> Approve Selected
            </button>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-times"></i> Reject Selected
            </button>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-star"></i> Feature Selected
            </button>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-trash"></i> Delete Selected
            </button>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-file-export"></i> Export Selected
            </button>
        </div>

        <!-- Table View -->
        <div class="data-table" id="tableView">
            <div class="table-header">
                <h3 class="table-title">Artwork Submissions</h3>
                <div class="table-actions">
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Artwork
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
                            <th style="width: 30px;"><input type="checkbox"></th>
                            <th>Artwork</th>
                            <th>Artist</th>
                            <th>Location</th>
                            <th>Tags</th>
                            <th>Uploaded</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Urban Flame">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Urban Flame</div>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Artist">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">David Peterson</div>
                                        <div class="user-email">@inkboi</div>
                                    </div>
                                </div>
                            </td>
                            <td>Manila, PH</td>
                            <td>
                                <div class="tags">
                                    <span class="tag">#Graffiti</span>
                                    <span class="tag">#Street</span>
                                </div>
                            </td>
                            <td>Today, 10:15 AM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn approve" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn reject" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn feature" title="Feature">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-conojeghuo-173301.jpg" alt="Color Explosion">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Color Explosion</div>
                                        <div class="art-artist">@maya_hayuk</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Artist">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Sarah Johnson</div>
                                        <div class="user-email">@maya_hayuk</div>
                                    </div>
                                </div>
                            </td>
                            <td>Williamsburg, NYC</td>
                            <td>
                                <div class="tags">
                                    <span class="tag">#Mural</span>
                                    <span class="tag">#Abstract</span>
                                </div>
                            </td>
                            <td>Today, 9:30 AM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn approve" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn reject" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn feature" title="Feature">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-fernando-dos-santos-campos-1309016-2510245 (1).jpg" alt="The Thinker">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">The Thinker</div>
                                        <div class="art-artist">Unknown Artist</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Lena Kowalski</div>
                                        <div class="user-email">@lena_k</div>
                                    </div>
                                </div>
                            </td>
                            <td>Berlin, Germany</td>
                            <td>
                                <div class="tags">
                                    <span class="tag">#Sculpture</span>
                                    <span class="tag">#Classic</span>
                                </div>
                            </td>
                            <td>Yesterday, 5:45 PM</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn approve" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="action-btn reject" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="action-btn feature" title="Feature">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-heftiba-1194420.jpg" alt="Neon Dreams">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Neon Dreams</div>
                                        <div class="art-artist">@dface</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Artist">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">James Lee</div>
                                        <div class="user-email">@dface</div>
                                    </div>
                                </div>
                            </td>
                            <td>Downtown LA</td>
                            <td>
                                <div class="tags">
                                    <span class="tag">#Neon</span>
                                    <span class="tag">#Installation</span>
                                </div>
                            </td>
                            <td>Yesterday, 3:20 PM</td>
                            <td><span class="status approved">Approved</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn feature" title="Feature">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <button class="action-btn reject" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-tobiasbjorkli-2119706 (1).jpg" alt="Abstract Flow">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Abstract Flow</div>
                                        <div class="art-artist">@felipe_pantone</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-sm">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Artist">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name-sm">Priya Kumar</div>
                                        <div class="user-email">@felipe_pantone</div>
                                    </div>
                                </div>
                            </td>
                            <td>Wynwood, Miami</td>
                            <td>
                                <div class="tags">
                                    <span class="tag">#Abstract</span>
                                    <span class="tag">#Modern</span>
                                </div>
                            </td>
                            <td>Yesterday, 1:10 PM</td>
                            <td><span class="status featured">Featured</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn feature" title="Unfeature">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    <button class="action-btn reject" title="Reject">
                                        <i class="fas fa-times"></i>
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

        <!-- Grid View (Hidden by default) -->
        <div class="art-grid" id="gridView" style="display: none;">
            <div class="art-card">
                <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Urban Flame" class="art-card-img" onclick="openArtModal('Urban Flame')">
                <div class="art-card-body">
                    <div class="art-card-title">Urban Flame</div>
                    <div class="art-card-meta">
                        <span>@inkboi</span>
                        <span>Manila, PH</span>
                    </div>
                    <div class="tags">
                        <span class="tag">#Graffiti</span>
                        <span class="tag">#Street</span>
                    </div>
                    <div class="art-card-footer">
                        <span class="art-card-status pending">Pending</span>
                        <div class="art-card-actions">
                            <button class="action-btn view" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn approve" title="Approve">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="art-card">
                <img src="img/pexels-conojeghuo-173301.jpg" alt="Color Explosion" class="art-card-img" onclick="openArtModal('Color Explosion')">
                <div class="art-card-body">
                    <div class="art-card-title">Color Explosion</div>
                    <div class="art-card-meta">
                        <span>@maya_hayuk</span>
                        <span>Williamsburg, NYC</span>
                    </div>
                    <div class="tags">
                        <span class="tag">#Mural</span>
                        <span class="tag">#Abstract</span>
                    </div>
                    <div class="art-card-footer">
                        <span class="art-card-status pending">Pending</span>
                        <div class="art-card-actions">
                            <button class="action-btn view" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn approve" title="Approve">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="art-card">
                <img src="img/pexels-fernando-dos-santos-campos-1309016-2510245 (1).jpg" alt="The Thinker" class="art-card-img" onclick="openArtModal('The Thinker')">
                <div class="art-card-body">
                    <div class="art-card-title">The Thinker</div>
                    <div class="art-card-meta">
                        <span>@lena_k</span>
                        <span>Berlin, Germany</span>
                    </div>
                    <div class="tags">
                        <span class="tag">#Sculpture</span>
                        <span class="tag">#Classic</span>
                    </div>
                    <div class="art-card-footer">
                        <span class="art-card-status pending">Pending</span>
                        <div class="art-card-actions">
                            <button class="action-btn view" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn approve" title="Approve">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="art-card">
                <img src="img/pexels-heftiba-1194420.jpg" alt="Neon Dreams" class="art-card-img" onclick="openArtModal('Neon Dreams')">
                <div class="art-card-body">
                    <div class="art-card-title">Neon Dreams</div>
                    <div class="art-card-meta">
                        <span>@dface</span>
                        <span>Downtown LA</span>
                    </div>
                    <div class="tags">
                        <span class="tag">#Neon</span>
                        <span class="tag">#Installation</span>
                    </div>
                    <div class="art-card-footer">
                        <span class="art-card-status approved">Approved</span>
                        <div class="art-card-actions">
                            <button class="action-btn view" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn feature" title="Feature">
                                <i class="fas fa-star"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="art-card">
                <img src="img/pexels-tobiasbjorkli-2119706 (1).jpg" alt="Abstract Flow" class="art-card-img" onclick="openArtModal('Abstract Flow')">
                <div class="art-card-body">
                    <div class="art-card-title">Abstract Flow</div>
                    <div class="art-card-meta">
                        <span>@felipe_pantone</span>
                        <span>Wynwood, Miami</span>
                    </div>
                    <div class="tags">
                        <span class="tag">#Abstract</span>
                        <span class="tag">#Modern</span>
                    </div>
                    <div class="art-card-footer">
                        <span class="art-card-status featured">Featured</span>
                        <div class="art-card-actions">
                            <button class="action-btn view" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn feature" title="Unfeature">
                                <i class="fas fa-star"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Artwork Detail Modal -->
        <div class="modal" id="artModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalArtTitle">Artwork Details</h3>
                    <button class="modal-close" onclick="closeArtModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Artwork Preview" class="art-preview">
                    <div class="art-details">
                        <div>
                            <div class="detail-group">
                                <div class="detail-label">Artist</div>
                                <div class="detail-value">

                                </div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">Manila, Philippines</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Coordinates</div>
                                <div class="detail-value">14.5995° N, 120.9842° E</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Upload Date</div>
                                <div class="detail-value">June 15, 2023 at 10:15 AM</div>
                            </div>
                        </div>
                        <div>
                            <div class="detail-group">
                                <div class="detail-label">Status</div>
                                <div class="detail-value"><span class="status pending">Pending Approval</span></div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Tags</div>
                                <div class="tags">
                                    <span class="tag">#Graffiti</span>
                                    <span class="tag">#Street</span>
                                    <span class="tag">#Urban</span>
                                </div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Description</div>
                                <div class="detail-value">A vibrant graffiti piece depicting urban life with fiery colors and dynamic shapes. Captured in the streets of Manila during the annual street art festival.</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Reports</div>
                                <div class="detail-value">No reports</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeArtModal()">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-check"></i> Approve
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-star"></i> Feature
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-times"></i> Reject
                    </button>
                </div>
            </div>
        </div>

        <!-- Edit Artwork Modal -->
        <div class="modal" id="editArtModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Artwork Details</h3>
                    <button class="modal-close" onclick="closeEditArtModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">Artwork Title</label>
                                    <input type="text" class="form-control" value="Urban Flame">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">Artist</label>

                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" value="Manila, Philippines">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">Coordinates</label>
                                    <input type="text" class="form-control" value="14.5995° N, 120.9842° E">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tags (comma separated)</label>
                            <input type="text" class="form-control" value="Graffiti, Street, Urban">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control form-textarea">A vibrant graffiti piece depicting urban life with fiery colors and dynamic shapes. Captured in the streets of Manila during the annual street art festival.</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control">
                                <option>Pending</option>
                                <option selected>Approved</option>
                                <option>Rejected</option>
                                <option>Featured</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Replacement Image (optional)</label>
                            <input type="file" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeEditArtModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
