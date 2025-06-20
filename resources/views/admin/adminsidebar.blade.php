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
    <style>
        :root {
            --primary: #1a1a1a;
            --secondary: #f5f5f5;
            --accent: #ff5e5b;
            --accent-dark: #e04e4b;
            --text: #333;
            --text-light: #777;
            --white: #fff;
            --black: #000;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --border-radius: 8px;
            --sidebar-width: 280px;
        }

        [data-theme="dark"] {
            --primary: #f5f5f5;
            --secondary: #1a1a1a;
            --text: #f0f0f0;
            --text-light: #bbb;
            --white: #121212;
            --black: #f5f5f5;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background-color: var(--secondary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            transition: transform var(--transition), box-shadow 0.3s ease, background-color 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .sidebar-logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .sidebar-logo span {
            color: var(--accent);
        }

        .sidebar-menu {
            padding: 0;
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow: hidden;
        }

        .menu-items-top {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
        }

        .menu-items-bottom {
            margin-top: auto;
            padding: 15px 0;
            background: var(--white);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .menu-title {
            padding: 10px 20px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-light);
            margin-top: 10px;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: var(--transition);
            border-left: 3px solid transparent;
            color: var(--text);
            text-decoration: none;
        }

        .menu-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .menu-item.active {
            background-color: rgba(255, 94, 91, 0.1);
            border-left-color: var(--accent);
            color: var(--accent);
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .mobile-menu-btn {
            display: none;
            background: var(--white);
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary);
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            padding: 10px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        @media (max-width: 1200px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Backdrop for mobile view -->
    <div class="backdrop" id="backdrop"></div>

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo"><a href="{{ route('home') }}">Street & <span>Ink</span></a></div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-items-top">
                <div class="menu-title">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <div class="menu-title">Management</div>
                <a href="{{ route('admin.user-management') }}" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>User Management</span>
                </a>
                <a href="{{ route('admin.arts-upload') }}" class="menu-item">
                    <i class="fas fa-paint-brush"></i>
                    <span>Art Uploads</span>
                </a>
                <a href="{{ route('admin.reports') }}" class="menu-item">
                    <i class="fas fa-flag"></i>
                    <span>Reports & Moderation</span>
                </a>
            </div>

            <div class="menu-items-bottom">
                <div class="menu-title">Account</div>
                <a href="{{ route('profile') }}" class="menu-item">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log out</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('backdrop');

            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                backdrop.classList.toggle('active');
            });

            backdrop.addEventListener('click', function() {
                sidebar.classList.remove('active');
                backdrop.classList.remove('active');
            });

            // Close sidebar when clicking on a menu item (for mobile)
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 1200) {
                        sidebar.classList.remove('active');
                        backdrop.classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>
</html>
