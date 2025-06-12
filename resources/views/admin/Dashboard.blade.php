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
             <div class="pagination">
                <!-- Pagination here -->
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

        <div class="charts-section">

            <div class="charts-container">

    <h2 class="section-title">User Growth Over Time</h2>
    <canvas id="userGrowthChart"></canvas>
            </div>
             <div class="charts-container">
    <h2 class="section-title">Artworks Uploaded Over Time</h2>
    <canvas id="artUploadsChart"></canvas>
            </div>
        </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('/dashboard/chart-data')
        .then(res => res.json())
        .then(data => {
            // Handle user growth chart
            const userLabels = data.userGrowth.map(item => item.date);
            const userCounts = data.userGrowth.map(item => item.count);

            const userCtx = document.getElementById('userGrowthChart').getContext('2d');
            new Chart(userCtx, {
                type: 'line',
                data: {
                    labels: userLabels,
                    datasets: [{
                        label: 'New Users',
                        data: userCounts,
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // Handle art uploads chart
            const artLabels = data.artUploads.map(item => item.date);
            const artCounts = data.artUploads.map(item => item.count);

            const artCtx = document.getElementById('artUploadsChart').getContext('2d');
            new Chart(artCtx, {
                type: 'bar',
                data: {
                    labels: artLabels,
                    datasets: [{
                        label: 'Artworks Uploaded',
                        data: artCounts,
                        backgroundColor: '#1cc88a'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching chart data:', error));
});
</script>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
