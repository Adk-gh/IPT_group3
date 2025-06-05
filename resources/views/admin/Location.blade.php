<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Location Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link href="{{ asset('css/admin-location.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-location.js') }}" defer></script>
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
                <h1 class="header-title">Location Management</h1>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search locations...">
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

        <!-- Filter Panel -->
        <div class="filter-panel">
            <div class="filter-row">
                <div class="filter-group">
                    <label class="form-label">Search by</label>
                    <select class="form-control">
                        <option>Location name</option>
                        <option>City</option>
                        <option>Artist username</option>
                        <option>Description</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Filter by status</label>
                    <select class="form-control">
                        <option>All statuses</option>
                        <option>Approved</option>
                        <option>Pending</option>
                        <option>Rejected</option>
                        <option>Hidden</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Filter by country</label>
                    <select class="form-control">
                        <option>All countries</option>
                        <option>United States</option>
                        <option>United Kingdom</option>
                        <option>Philippines</option>
                        <option>Germany</option>
                        <option>France</option>
                    </select>
                </div>
            </div>
            <div class="filter-row">
                <div class="filter-group">
                    <label class="form-label">With artwork</label>
                    <select class="form-control">
                        <option>All locations</option>
                        <option>With artwork</option>
                        <option>Without artwork</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Sort by</label>
                    <select class="form-control">
                        <option>Date added (newest)</option>
                        <option>Date added (oldest)</option>
                        <option>Popularity</option>
                        <option>Name (A-Z)</option>
                        <option>Name (Z-A)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="form-label">Time period</label>
                    <select class="form-control">
                        <option>All time</option>
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last year</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Bulk Actions -->
        <div class="bulk-actions">
            <div class="form-group" style="margin-bottom: 0;">
                <input type="checkbox" id="selectAll">
                <label for="selectAll">Select all</label>
            </div>
            <div class="bulk-info">3 locations selected</div>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-check"></i> Approve
            </button>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-times"></i> Reject
            </button>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-trash"></i> Delete
            </button>
            <button class="btn btn-secondary btn-sm">
                <i class="fas fa-download"></i> Export
            </button>
        </div>

        <!-- Location List -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">All Locations</h3>
                <div class="table-actions">
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-filter"></i> Filters
                    </button>
                    <button class="btn btn-primary btn-sm" id="addLocationBtn">
                        <i class="fas fa-plus"></i> Add Location
                    </button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 30px;"></th>
                            <th>Location Name</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Artist</th>
                            <th>Status</th>
                            <th>Pins</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Bonifacio Wall</td>
                            <td>Taguig</td>
                            <td>Philippines</td>
                            <td>@inkboy</td>
                            <td><span class="status active">Approved</span></td>
                            <td>3</td>
                            <td>Apr 6, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Bricklane Tunnel</td>
                            <td>London</td>
                            <td>UK</td>
                            <td>@splashqueen</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>1</td>
                            <td>Apr 3, 2025</td>
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
                            <td><input type="checkbox"></td>
                            <td>Wynwood Walls</td>
                            <td>Miami</td>
                            <td>USA</td>
                            <td>Multiple Artists</td>
                            <td><span class="status active">Approved</span></td>
                            <td>42</td>
                            <td>Mar 28, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Shoreditch Street</td>
                            <td>London</td>
                            <td>UK</td>

                            <td><span class="status featured">Featured</span></td>
                            <td>18</td>
                            <td>Mar 22, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Berlin Wall East Side</td>
                            <td>Berlin</td>
                            <td>Germany</td>
                            <td>Various Artists</td>
                            <td><span class="status active">Approved</span></td>
                            <td>56</td>
                            <td>Mar 15, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>5 Pointz</td>
                            <td>New York</td>
                            <td>USA</td>
                            <td>@meresone</td>
                            <td><span class="status banned">Removed</span></td>
                            <td>0</td>
                            <td>Mar 10, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Restore">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Melrose Avenue</td>
                            <td>Los Angeles</td>
                            <td>USA</td>
                            <td>@shepard_fairey</td>
                            <td><span class="status active">Approved</span></td>
                            <td>24</td>
                            <td>Mar 5, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="action-btn" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Rue Denoyez</td>
                            <td>Paris</td>
                            <td>France</td>
                            <td>Local Artists</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>7</td>
                            <td>Mar 1, 2025</td>
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
                <div class="pagination-info">Showing 1 to 8 of 1,240 locations</div>
                <div class="pagination-btns">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn">25</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        <!-- Reported Locations -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Reported Locations</h3>
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
                            <th>Location</th>
                            <th>Reported By</th>
                            <th>Reason</th>
                            <th>Date Reported</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bonifacio Wall</td>
                            <td>@artlover22</td>
                            <td>Incorrect location</td>
                            <td>Apr 10, 2025</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Review">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="action-btn" title="Mark as safe">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Bricklane Tunnel</td>
                            <td>@streetartfan</td>
                            <td>Offensive content</td>
                            <td>Apr 8, 2025</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Review">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="action-btn" title="Mark as safe">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Melrose Avenue</td>
                            <td>@localresident</td>
                            <td>Artwork no longer exists</td>
                            <td>Apr 5, 2025</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Review">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="action-btn" title="Mark as safe">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1 to 3 of 12 reported locations</div>
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

        <!-- Location Map -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Location Heatmap</h3>
                <div class="table-actions">
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-layer-group"></i> Layers
                    </button>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>
            <div class="map-container">
                <div id="adminMap"></div>
                <div class="map-controls">
                    <button class="map-btn" title="Zoom in">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="map-btn" title="Zoom out">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="map-btn" title="Reset view">
                        <i class="fas fa-crosshairs"></i>
                    </button>
                </div>
                <div class="heatmap-legend">
                    <div class="legend-title">Location Density</div>
                    <div class="legend-gradient"></div>
                    <div class="legend-labels">
                        <span>Low</span>
                        <span>High</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Analytics -->
        <div class="card-grid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Locations by Country</h3>
                </div>
                <div class="card-body">
                    <div style="height: 300px; background-color: var(--secondary); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center;">
                        <p style="color: var(--text-light);">Bar chart visualization would appear here</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Location Statistics</h3>
                </div>
                <div class="card-body">
                    <div class="location-stats">
                        <div class="stat-item">
                            <div class="stat-number">1,240</div>
                            <div class="stat-label">Total Locations</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">892</div>
                            <div class="stat-label">Approved</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">48</div>
                            <div class="stat-label">Pending</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Reported</div>
                        </div>
                    </div>
                    <div style="height: 200px; margin-top: 20px; background-color: var(--secondary); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center;">
                        <p style="color: var(--text-light);">Line chart visualization would appear here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Location Modal -->
    <div class="modal" id="addLocationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Location</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="locationForm">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Location Name</label>
                                <input type="text" class="form-control" placeholder="e.g. Bonifacio Wall" required>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select class="form-control">
                                    <option>Approved</option>
                                    <option selected>Pending</option>
                                    <option>Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" placeholder="e.g. Taguig" required>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <select class="form-control" required>
                                    <option value="">Select country</option>
                                    <option>Philippines</option>
                                    <option>United States</option>
                                    <option>United Kingdom</option>
                                    <option>Germany</option>
                                    <option>France</option>
                                    <option>Spain</option>
                                    <option>Italy</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">GPS Coordinates</label>
                        <div class="form-row">
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Latitude" required>
                            </div>
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Longitude" required>
                            </div>
                        </div>
                        <small style="color: var(--text-light);">Or click on the map below to set coordinates</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Map Preview</label>
                        <div class="map-container" style="height: 250px;">
                            <div id="locationMap"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Artist</label>
                        <select class="form-control">
                            <option value="">Select artist</option>
                            <option>@inkboy</option>
                            <option>@splashqueen</option>
                            <option>@banksy</option>
                            <option>@shepard_fairey</option>
                            <option>@invader</option>
                        </select>
                        <small style="color: var(--text-light);">Or enter manually:</small>
                        <input type="text" class="form-control" style="margin-top: 5px;" placeholder="Artist name or @username">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control form-textarea" placeholder="Brief description of the location and artwork"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location Tags</label>
                        <input type="text" class="form-control" placeholder="Add tags (urban, legal wall, gallery spot, etc.)">
                        <div class="location-tags">
                            <div class="tag">urban <i class="fas fa-times"></i></div>
                            <div class="tag">legal wall <i class="fas fa-times"></i></div>
                            <div class="tag">popular <i class="fas fa-times"></i></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Upload Images</label>
                        <input type="file" class="form-control" multiple accept="image/*">
                        <div class="location-gallery">
                            <div class="gallery-item">
                                <img src="https://via.placeholder.com/150" alt="Location image">
                                <div class="delete-btn">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="https://via.placeholder.com/150" alt="Location image">
                                <div class="delete-btn">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <div style="width: 100%; height: 100%; background-color: var(--secondary); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-plus" style="font-size: 1.5rem; color: var(--text-light);"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- AI Suggestion -->
                    <div class="ai-suggestion">
                        <div class="suggestion-title">
                            <i class="fas fa-robot"></i> AI Suggestion
                        </div>
                        <div class="suggestion-text">
                            This location might be similar to "Bonifacio High Street" (ID: #LOC-4829) which already exists in our database. Consider merging or verifying if this is a new location.
                        </div>
                        <div class="suggestion-actions">
                            <button class="btn btn-secondary btn-sm">View Similar</button>
                            <button class="btn btn-secondary btn-sm">Mark as Different</button>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Location</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Location Modal -->
    <div class="modal" id="editLocationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Location</h3>
                <button class="modal-close" id="closeEditModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editLocationForm">
                    <div class="tabs">
                        <div class="tab active" data-target="locationDetails">Details</div>
                        <div class="tab" data-target="locationImages">Images</div>
                        <div class="tab" data-target="locationReports">Reports</div>
                        <div class="tab" data-target="locationAnalytics">Analytics</div>
                    </div>

                    <div class="tab-content active" id="locationDetails">
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">Location Name</label>
                                    <input type="text" class="form-control" value="Bonifacio Wall" required>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control">
                                        <option selected>Approved</option>
                                        <option>Pending</option>
                                        <option>Hidden</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" value="Taguig" required>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="form-control" required>
                                        <option>Philippines</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                        <option>Spain</option>
                                        <option>Italy</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">GPS Coordinates</label>
                            <div class="form-row">
                                <div class="form-col">
                                    <input type="text" class="form-control" value="14.5522" required>
                                </div>
                                <div class="form-col">
                                    <input type="text" class="form-control" value="121.0514" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Artist</label>
                            <select class="form-control">
                                <option value="">Select artist</option>
                                <option selected>@inkboy</option>
                                <option>@splashqueen</option>
                                <option>@banksy</option>
                                <option>@shepard_fairey</option>
                                <option>@invader</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control form-textarea">A popular wall in Bonifacio Global City featuring rotating street art from local and international artists. Currently showcasing works by @inkboy.</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Location Tags</label>
                            <input type="text" class="form-control" placeholder="Add tags (urban, legal wall, gallery spot, etc.)">
                            <div class="location-tags">
                                <div class="tag">urban <i class="fas fa-times"></i></div>
                                <div class="tag">legal wall <i class="fas fa-times"></i></div>
                                <div class="tag">popular <i class="fas fa-times"></i></div>
                                <div class="tag">rotating exhibits <i class="fas fa-times"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="locationImages">
                        <div class="form-group">
                            <label class="form-label">Current Images</label>
                            <div class="location-gallery">
                                <div class="gallery-item">
                                    <img src="https://via.placeholder.com/150/ff5e5b/ffffff?text=Image+1" alt="Location image">
                                    <div class="delete-btn">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                                <div class="gallery-item">
                                    <img src="https://via.placeholder.com/150/36b9cc/ffffff?text=Image+2" alt="Location image">
                                    <div class="delete-btn">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                                <div class="gallery-item">
                                    <img src="https://via.placeholder.com/150/1cc88a/ffffff?text=Image+3" alt="Location image">
                                    <div class="delete-btn">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                                <div class="gallery-item">
                                    <div style="width: 100%; height: 100%; background-color: var(--secondary); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-plus" style="font-size: 1.5rem; color: var(--text-light);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Upload New Images</label>
                            <input type="file" class="form-control" multiple accept="image/*">
                        </div>
                    </div>

                    <div class="tab-content" id="locationReports">
                        <div class="report-details">
                            <div class="report-reason">
                                <i class="fas fa-flag"></i> Reported for: Incorrect location
                            </div>
                            <div class="report-description">
                                User @artlover22 reported that the GPS coordinates are incorrect and the actual artwork is located about 200m north of this position.
                            </div>
                            <div class="suggestion-actions" style="margin-top: 15px;">
                                <button class="btn btn-secondary btn-sm">
                                    <i class="fas fa-map-marker-alt"></i> Verify Location
                                </button>
                                <button class="btn btn-secondary btn-sm">
                                    <i class="fas fa-check-circle"></i> Mark as Resolved
                                </button>
                                <button class="btn btn-secondary btn-sm">
                                    <i class="fas fa-comment"></i> Contact Reporter
                                </button>
                            </div>
                        </div>

                        <div style="margin-top: 20px;">
                            <h4 style="margin-bottom: 15px;">Report History</h4>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Apr 10, 2025</td>
                                        <td>Incorrect location</td>
                                        <td><span class="status pending">Pending</span></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 15, 2025</td>
                                        <td>Offensive content</td>
                                        <td><span class="status active">Resolved</span></td>
                                        <td>Content reviewed and approved</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 28, 2024</td>
                                        <td>Artwork removed</td>
                                        <td><span class="status active">Resolved</span></td>
                                        <td>Updated with new artwork</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-content" id="locationAnalytics">
                        <div class="location-stats">
                            <div class="stat-item">
                                <div class="stat-number">3,842</div>
                                <div class="stat-label">Total Views</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">124</div>
                                <div class="stat-label">Saves</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">56</div>
                                <div class="stat-label">Shares</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">28</div>
                                <div class="stat-label">Comments</div>
                            </div>
                        </div>

                        <div style="margin-top: 20px;">
                            <h4 style="margin-bottom: 15px;">Visitor Demographics</h4>
                            <div style="height: 200px; background-color: var(--secondary); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center;">
                                <p style="color: var(--text-light);">Demographics chart would appear here</p>
                            </div>
                        </div>

                        <div style="margin-top: 20px;">
                            <h4 style="margin-bottom: 15px;">Popular Times</h4>
                            <div style="height: 200px; background-color: var(--secondary); border-radius: var(--border-radius); display: flex; align-items: center; justify-content: center;">
                                <p style="color: var(--text-light);">Popular times chart would appear here</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Location Modal -->
    <div class="modal" id="viewLocationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Location Details</h3>
                <button class="modal-close" id="closeViewModal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="display: flex; gap: 30px; margin-bottom: 20px;">
                    <div style="flex: 1;">
                        <div style="height: 300px; background-color: var(--secondary); border-radius: var(--border-radius); overflow: hidden;">
                            <img src="https://via.placeholder.com/600x400/ff5e5b/ffffff?text=Bonifacio+Wall" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="location-gallery" style="margin-top: 15px;">
                            <div class="gallery-item">
                                <img src="https://via.placeholder.com/150/ff5e5b/ffffff?text=Image+1" alt="Location image">
                            </div>
                            <div class="gallery-item">
                                <img src="https://via.placeholder.com/150/36b9cc/ffffff?text=Image+2" alt="Location image">
                            </div>
                            <div class="gallery-item">
                                <img src="https://via.placeholder.com/150/1cc88a/ffffff?text=Image+3" alt="Location image">
                            </div>
                            <div class="gallery-item">
                                <img src="https://via.placeholder.com/150/4e73df/ffffff?text=Image+4" alt="Location image">
                            </div>
                        </div>
                    </div>
                    <div style="flex: 1;">
                        <h2 style="margin-bottom: 5px;">Bonifacio Wall</h2>
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                            <span class="status active">Approved</span>
                            <span style="color: var(--text-light); font-size: 0.9rem;">Taguig, Philippines</span>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <p>A popular wall in Bonifacio Global City featuring rotating street art from local and international artists. Currently showcasing works by @inkboy.</p>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <h4 style="margin-bottom: 10px;">Details</h4>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">Artist</div>
                                    <div>@inkboy</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">Added By</div>
                                    <div>@adminuser</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">Date Added</div>
                                    <div>Apr 6, 2025</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">Last Updated</div>
                                    <div>Apr 8, 2025</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">Coordinates</div>
                                    <div>14.5522, 121.0514</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-light);">Pins</div>
                                    <div>3</div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <h4 style="margin-bottom: 10px;">Tags</h4>
                            <div class="location-tags">
                                <div class="tag">urban</div>
                                <div class="tag">legal wall</div>
                                <div class="tag">popular</div>
                                <div class="tag">rotating exhibits</div>
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <h4 style="margin-bottom: 10px;">Map</h4>
                            <div class="map-container" style="height: 200px;">
                                <div id="viewLocationMap"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-secondary">
                    <i class="fas fa-share-alt"></i> Share
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-check"></i> Approve
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="resources/js/admin-location.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>

