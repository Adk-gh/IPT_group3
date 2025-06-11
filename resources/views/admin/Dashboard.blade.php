<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Admin Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                <div class="stat-value">{{ number_format(App\Models\User::count()) }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon art">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div class="stat-title">Artworks Uploaded</div>
                <div class="stat-value">{{ number_format(App\Models\Post::count()) }}</div>
            </div>

            <!-- Stats Cards -->
            <div class="stat-card">
                <div class="stat-icon locations">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stat-title">Tagged Locations</div>
                <div class="stat-value">{{ number_format($stats['locations']) }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon reports">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="stat-title">Reports</div>
                <div class="stat-value">{{ number_format($stats['reports']) }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon artists">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="stat-title">Verified Artists</div>
                <div class="stat-value">{{ $stats['verified_artists'] }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon comments">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-title">Comments This Week</div>
                <div class="stat-value">{{ number_format($stats['comments']) }}</div>
            </div>
        </div>

       
        <!-- Recent Activity -->
        <div class="recent-activity">
            <h2 class="section-title">
                Recent Activity
                <a href="#">View All</a>
            </h2>
            <div class="activity-list">
                <!-- Activity items here -->
            </div>
        </div>

        <!-- Recent Users Table -->
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
                    <!-- Table content here -->
                </table>
            </div>
            <div class="pagination">
                <!-- Pagination here -->
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
                    <!-- Table content here -->
                </table>
            </div>
            <div class="pagination">
                <!-- Pagination here -->
            </div>
        </div>

        <!-- Card Grid Section -->
        <div class="card-grid">
            <div class="card">
                <!-- Recent Reports card content -->
            </div>
            <div class="card">
                <!-- System Status card content -->
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
                    <!-- Table content here -->
                </table>
            </div>
            <div class="pagination">
                <!-- Pagination here -->
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
