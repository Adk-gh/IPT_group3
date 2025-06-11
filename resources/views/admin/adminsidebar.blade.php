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
    <link href="resources/css/admin-sidebar.css" rel="stylesheet">
    <script src="resources/js/admin-sidebar.js" defer></script>
</head>
<body>
   <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

      <!-- Sidebar -->
      <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">Street & <span>Ink</span></div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <div class="menu-title">Management</div>
            <a href="{{ route('admin.UserManagement') }}" class="menu-item">
                <i class="fas fa-users"></i>
                <span>User Management</span>
                <span class="menu-badge">5 new</span>
            </a>
            <a href="{{ route('admin.ArtUpload') }}" class="menu-item">
                <i class="fas fa-paint-brush"></i>
                <span>Art Uploads</span>
                <span class="menu-badge">12 pending</span>
            </a>
            <a href="{{ route('admin.Reports') }}" class="menu-item">
                <i class="fas fa-flag"></i>
                <span>Reports & Moderation</span>
            </a>
            <a href="{{ route('admin.Location') }}" class="menu-item">
                <i class="fas fa-map-marked-alt"></i>
                <span>Location Management</span>
            </a>
            <a href="{{ route('admin.ArtistPartners') }}" class="menu-item">
                <i class="fas fa-palette"></i>
                <span>Artist & Partners</span>
                <span class="menu-badge">3 new</span>
            </a>

            <div class="menu-title">Content</div>
            <a href="#" class="menu-item">
                <i class="fas fa-envelope"></i>
                <span>Contact & Feedback</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-comments"></i>
                <span>Comment Moderation</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-newspaper"></i>
                <span>Frontend Content</span>
            </a>

            <div class="menu-title">System</div>
            <a href="Backup.php" class="menu-item">
                <i class="fas fa-database"></i>
                <span>Data & Backup</span>
            </a>
            <a href="{{ route('admin.Settings') }}" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Admin Settings</span>
            </a>
        </div>
    </div>


</body>
</html>
