<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Admin Settings</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/admin-settings.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-settings.js') }}" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
   @include('admin.adminsidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
         @include('admin.adminnavbar')

        <!-- Settings Content -->
        <div class="settings-container">
            <!-- Settings Sidebar -->
            <div class="settings-sidebar">
                <div class="settings-nav-item active" data-target="general">
                    <i class="fas fa-sliders-h"></i>
                    <span>General Settings</span>
                </div>
                <div class="settings-nav-item" data-target="admins">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin Accounts</span>
                </div>
                <div class="settings-nav-item" data-target="features">
                    <i class="fas fa-toggle-on"></i>
                    <span>Feature Toggles</span>
                </div>
                <div class="settings-nav-item" data-target="email">
                    <i class="fas fa-envelope"></i>
                    <span>Email & Notifications</span>
                </div>
                <div class="settings-nav-item" data-target="moderation">
                    <i class="fas fa-gavel"></i>
                    <span>Moderation Rules</span>
                </div>
                <div class="settings-nav-item" data-target="security">
                    <i class="fas fa-lock"></i>
                    <span>Security Settings</span>
                </div>
                <div class="settings-nav-item" data-target="seo">
                    <i class="fas fa-search"></i>
                    <span>SEO & Social</span>
                </div>
                <div class="settings-nav-item" data-target="legal">
                    <i class="fas fa-balance-scale"></i>
                    <span>Legal & System</span>
                </div>
                <div class="settings-nav-item" data-target="audit">
                    <i class="fas fa-history"></i>
                    <span>Audit Trail</span>
                </div>
                <div class="settings-nav-item" data-target="customization">
                    <i class="fas fa-paint-brush"></i>
                    <span>Customizations</span>
                </div>
            </div>

            <!-- Settings Panels -->
            <div class="settings-content">
                <!-- General Settings -->
                <div class="settings-section" id="general">
                    <h2 class="settings-section-title">
                        <i class="fas fa-sliders-h"></i>
                        General Platform Settings
                    </h2>

                    <div class="form-group">
                        <label class="form-label">Site Name</label>
                        <input type="text" class="form-control" value="Street & Ink">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Site URL</label>
                        <input type="url" class="form-control" value="https://streetandink.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Meta Description (for SEO)</label>
                        <textarea class="form-control form-textarea">Dear {user_name},

Welcome to Street & Ink! We're thrilled to have you join our community of street art enthusiasts, artists, and explorers.

Here's what you can do:
- Discover amazing street art from around the world
- Connect with artists and fellow enthusiasts
- Share your own finds and creations
- Participate in discussions and events

Get started by completing your profile and exploring the map.

Happy exploring!
The Street & Ink Team</textarea>
                    </div>

<form action="{{ route('changeLang') }}" method="POST">
    @csrf
    <select name="locale" onchange="this.form.submit()" class="form-control">
        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
        <option value="es" {{ app()->getLocale() === 'es' ? 'selected' : '' }}>Spanish</option>
        <option value="fr" {{ app()->getLocale() === 'fr' ? 'selected' : '' }}>French</option>
    </select>
</form>




                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Timezone</label>
                                <select class="form-control">
                                    <option>(UTC-05:00) Eastern Time (US & Canada)</option>
                                    <option>(UTC-08:00) Pacific Time (US & Canada)</option>
                                    <option>(UTC+00:00) London</option>
                                    <option>(UTC+01:00) Berlin</option>
                                    <option>(UTC+08:00) Beijing</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Admin Contact Email</label>
                        <input type="email" class="form-control" value="admin@streetandink.com">
                    </div>

                    <div class="toggle-label">
                        <label>Enable Dark Mode by Default</label>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <p class="toggle-description">When enabled, new users will see the dark theme by default.</p>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </div>

                <!-- Admin Accounts -->
                <div class="settings-section" id="admins" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-user-shield"></i>
                        Admin Accounts & Roles
                    </h2>

                    <div class="data-table">
                        <div class="table-header">
                            <h3 class="table-title">Current Admins</h3>
                            <div class="table-actions">
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Admin
                                </button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar-sm">
                                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                                                </div>
                                                <div class="user-info">
                                                    <div class="user-name-sm">Sarah Lee</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>sarah@admin.com</td>
                                        <td>Super Admin</td>
                                        <td><span class="status active">Active</span></td>
                                        <td>Apr 7, 2025</td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="action-btn" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn" title="Deactivate">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                                <button class="action-btn" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar-sm">
                                                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Admin">
                                                </div>
                                                <div class="user-info">
                                                    <div class="user-name-sm">David Peterson</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>david@admin.com</td>
                                        <td>Content Manager</td>
                                        <td><span class="status active">Active</span></td>
                                        <td>Apr 6, 2025</td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="action-btn" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn" title="Deactivate">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                                <button class="action-btn" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar-sm">
                                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Admin">
                                                </div>
                                                <div class="user-info">
                                                    <div class="user-name-sm">Lena Kowalski</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>lena@admin.com</td>
                                        <td>Moderator</td>
                                        <td><span class="status active">Active</span></td>
                                        <td>Apr 5, 2025</td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="action-btn" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn" title="Deactivate">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                                <button class="action-btn" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <div class="user-avatar-sm">
                                                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Admin">
                                                </div>
                                                <div class="user-info">
                                                    <div class="user-name-sm">James Lee</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>james@admin.com</td>
                                        <td>Developer</td>
                                        <td><span class="status active">Active</span></td>
                                        <td>Apr 4, 2025</td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="action-btn" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="action-btn" title="Deactivate">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                                <button class="action-btn" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h3 style="margin-top: 30px; margin-bottom: 15px;">Add New Admin</h3>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="Enter full name">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter email address">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <select class="form-control">
                                    <option>Super Admin</option>
                                    <option>Moderator</option>
                                    <option>Content Manager</option>
                                    <option>Developer</option>
                                    <option>Support</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Temporary Password</label>
                                <input type="password" class="form-control" placeholder="Generate password">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Permissions</label>
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px;">
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" checked> User Management
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" checked> Content Moderation
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox"> System Settings
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox"> Email Templates
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" checked> Reports Review
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox"> Backup Management
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Create Admin Account</button>
                    </div>
                </div>

                <!-- Feature Toggles -->
                <div class="settings-section" id="features" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-toggle-on"></i>
                        Feature Toggles
                    </h2>
                    <p style="margin-bottom: 20px;">Enable or disable major platform features. Changes may affect user experience.</p>

                    <div class="settings-grid">
                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Artist Verification System</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Allow artists to apply for verified status with portfolio review.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Map View</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Show interactive map for discovering street art locations.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Article Publishing</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Enable editorial content and artist interviews.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>"Support the Project" Button</label>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Show donation options to support the platform.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Public Comments on Artworks</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Allow users to comment on street art submissions.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Social Feed Page</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Show recent activity from community members.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Partner Requests</label>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Allow organizations to request partnerships.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Backup Notifications</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Send email alerts for successful/failed backups.</p>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Discard Changes</button>
                        <button class="btn btn-primary">Save Feature Settings</button>
                    </div>
                </div>

                <!-- Email & Notifications -->
                <div class="settings-section" id="email" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-envelope"></i>
                        Email & Notification Settings
                    </h2>

                    <div class="form-group">
                        <label class="form-label">System Email Address</label>
                        <input type="email" class="form-control" value="noreply@streetandink.com">
                        <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">This address will be used for all outgoing system emails.</p>
                    </div>

                    <h3 style="margin-top: 30px; margin-bottom: 15px;">Email Templates</h3>

                    <div class="form-group">
                        <label class="form-label">Select Template</label>
                        <select class="form-control">
                            <option>Welcome Email (New Users)</option>
                            <option>Password Reset</option>
                            <option>Account Verification</option>
                            <option>Artist Application Received</option>
                            <option>Artist Application Approved</option>
                            <option>Content Removal Notification</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Subject</label>
                        <input type="text" class="form-control" value="Welcome to Street & Ink!">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Content</label>
                        <textarea class="form-control form-textarea">Dear {user_name},

Welcome to Street & Ink! We're thrilled to have you join our community of street art enthusiasts, artists, and explorers.

Here's what you can do:
- Discover amazing street art from around the world
- Connect with artists and fellow enthusiasts
- Share your own finds and creations
- Participate in discussions and events

Get started by completing your profile and exploring the map.

Happy exploring!
The Street & Ink Team</textarea>
                    </div>

                    <h3 style="margin-top: 30px; margin-bottom: 15px;">Notification Preferences</h3>

                    <div class="settings-grid">
                        <div class="form-group">
                            <div class="toggle-label">
                                <label>New Artist Applications</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Receive alerts when artists apply for verification.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>New Reports</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Get notified when users report content.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Backup Status</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Receive notifications about backup success/failure.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Email Confirmation for Signups</label>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Require email confirmation for new user accounts.</p>
                        </div>

                        <div class="form-group">
                            <div class="toggle-label">
                                <label>Weekly Admin Digest</label>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="toggle-description">Receive weekly summary of platform activity.</p>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Save Email Settings</button>
                    </div>
                </div>

                <!-- Moderation Rules -->
                <div class="settings-section" id="moderation" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-gavel"></i>
                        Content Moderation Rules
                    </h2>

                    <div class="form-group">
                        <div class="toggle-label">
                            <label>Profanity Filter</label>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <p class="toggle-description">Automatically flag and hide content containing profanity.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Auto-hide threshold</label>
                        <select class="form-control">
                            <option>Hide content after 3 reports</option>
                            <option>Hide content after 5 reports</option>
                            <option>Hide content after 10 reports</option>
                            <option>Never auto-hide (manual review only)</option>
                        </select>
                        <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">Content will be hidden from public view but remain accessible to moderators.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Auto-delete inactive accounts</label>
                        <select class="form-control">
                            <option>Never delete inactive accounts</option>
                            <option>After 1 year of inactivity</option>
                            <option>After 2 years of inactivity</option>
                            <option>After 5 years of inactivity</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="toggle-label">
                            <label>Require approval before publishing</label>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <p class="toggle-description">All new artwork submissions will require moderator approval before appearing publicly.</p>
                    </div>

                    <h3 style="margin-top: 30px; margin-bottom: 15px;">Banned Words List</h3>

                    <div class="form-group">
                        <label class="form-label">Add banned words (comma separated)</label>
                        <textarea class="form-control form-textarea" placeholder="hate, violence, racism, etc."></textarea>
                        <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">These words will trigger automatic content flags.</p>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Save Moderation Rules</button>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="settings-section" id="security" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-lock"></i>
                        Security Settings
                    </h2>

                    <div class="form-group">
                        <div class="toggle-label">
                            <label>Enable 2FA for Admins</label>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <p class="toggle-description">Require two-factor authentication for all admin accounts.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Admin Session Timeout</label>
                        <select class="form-control">
                            <option>15 minutes</option>
                            <option>30 minutes</option>
                            <option>1 hour</option>
                            <option>2 hours</option>
                            <option>Never (not recommended)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">IP Whitelist (comma separated)</label>
                        <textarea class="form-control form-textarea" placeholder="192.168.1.1, 10.0.0.1"></textarea>
                        <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">Only allow admin access from these IP addresses (leave empty to allow all).</p>
                    </div>

                    <div class="form-group">
                        <div class="toggle-label">
                            <label>Password Complexity Requirements</label>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <p class="toggle-description">Require passwords to contain uppercase, lowercase, numbers, and special characters.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password Expiration</label>
                        <select class="form-control">
                            <option>Never expire</option>
                            <option>Every 30 days</option>
                            <option>Every 60 days</option>
                            <option>Every 90 days</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Save Security Settings</button>
                    </div>
                </div>

                <!-- SEO & Social -->
                <div class="settings-section" id="seo" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-search"></i>
                        SEO & Social Media Settings
                    </h2>

                    <div class="form-group">
                        <label class="form-label">Default Meta Title</label>
                        <input type="text" class="form-control" value="Street & Ink | Discover Urban Art Worldwide">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Default Meta Description</label>
                        <textarea class="form-control form-textarea">Street & Ink is the premier platform for discovering and sharing urban art from around the world. Connect with artists, explore street art locations, and contribute to the global street art community.</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Default Social Share Image</label>
                        <div class="file-upload">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="file-upload-text">Drag & drop your image here or click to browse</div>
                            <input type="file" class="file-upload-input" accept="image/*">
                        </div>
                        <div class="preview-box">
                            <img src="https://images.unsplash.com/photo-1517404215738-15263e18f937?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Current Social Image" class="preview-image">
                            <button class="btn btn-secondary btn-sm">Remove Image</button>
                        </div>
                    </div>

                    <h3 style="margin-top: 30px; margin-bottom: 15px;">Social Media Accounts</h3>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" class="form-control" placeholder="https://facebook.com/streetandink">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" class="form-control" placeholder="https://instagram.com/streetandink">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Twitter URL</label>
                                <input type="url" class="form-control" placeholder="https://twitter.com/streetandink">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">YouTube URL</label>
                                <input type="url" class="form-control" placeholder="https://youtube.com/streetandink">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Save SEO Settings</button>
                    </div>
                </div>

                <!-- Legal & System -->
                <div class="settings-section" id="legal" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-balance-scale"></i>
                        Legal & System Settings
                    </h2>

                    <div class="form-group">
                        <label class="form-label">Terms of Service</label>
                        <textarea class="form-control form-textarea" style="min-height: 300px;">By using Street & Ink ("the Service"), you agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, please do not use the Service.

1. User Responsibilities
You are responsible for all content you post on the Service. You must not post content that is illegal, harmful, threatening, abusive, harassing, defamatory, vulgar, obscene, or otherwise objectionable.

2. Intellectual Property
All content posted remains the property of its respective owners. By posting content, you grant Street & Ink a non-exclusive, worldwide, royalty-free license to use, display, and distribute your content in connection with the Service.

3. Privacy
Your privacy is important to us. Please review our Privacy Policy to understand how we collect, use, and disclose information about you.

4. Modifications
We reserve the right to modify or terminate the Service for any reason, without notice at any time.

5. Governing Law
These Terms shall be governed by the laws of the State of California without regard to its conflict of law provisions.</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Privacy Policy</label>
                        <textarea class="form-control form-textarea" style="min-height: 300px;">Street & Ink ("we", "us", or "our") operates the Street & Ink website (the "Service").

This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.

1. Information Collection
We collect several different types of information for various purposes to provide and improve our Service to you. This may include, but is not limited to:
- Personal Data (email address, name, etc.)
- Usage Data (pages visited, features used)
- Cookies and Tracking Data

2. Use of Data
We use the collected data for various purposes:
- To provide and maintain our Service
- To notify you about changes to our Service
- To allow you to participate in interactive features
- To provide customer support
- To gather analysis or valuable information
- To monitor the usage of our Service
- To detect, prevent and address technical issues

3. Data Security
The security of your data is important to us but remember that no method of transmission over the Internet is 100% secure.</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Cookie Policy</label>
                        <textarea class="form-control form-textarea">Our website uses cookies to distinguish you from other users of our website. This helps us to provide you with a good experience when you browse our website and also allows us to improve our site.

What are cookies?
Cookies are small text files that are placed on your computer by websites that you visit. They are widely used in order to make websites work, or work more efficiently, as well as to provide information to the owners of the site.

How we use cookies
We use cookies for the following purposes:
- To enable certain functions of the Service
- To provide analytics
- To store your preferences
- To enable advertisements delivery

You can control or delete cookies as you wish - for details, see aboutcookies.org.</textarea>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Save Legal Documents</button>
                    </div>
                </div>

                <!-- Audit Trail -->
                <div class="settings-section" id="audit" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-history"></i>
                        System Audit Trail
                    </h2>

                    <div class="data-table">
                        <div class="table-header">
                            <h3 class="table-title">Recent Activity</h3>
                            <div class="table-actions">
                                <button class="btn btn-secondary btn-sm">
                                    <i class="fas fa-download"></i> Export Logs
                                </button>
                                <button class="btn btn-secondary btn-sm">
                                    <i class="fas fa-trash"></i> Clear Logs
                                </button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Timestamp</th>
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Details</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Apr 8, 2025 14:32</td>
                                        <td>Sarah Lee</td>
                                        <td>User banned</td>
                                        <td>Banned user ID 3482 for repeated violations</td>
                                        <td>192.168.1.45</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 8, 2025 13:18</td>
                                        <td>David Peterson</td>
                                        <td>Settings changed</td>
                                        <td>Modified email notification settings</td>
                                        <td>10.0.0.12</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 8, 2025 11:05</td>
                                        <td>System</td>
                                        <td>Backup completed</td>
                                        <td>Database backup to S3 completed successfully</td>
                                        <td>N/A</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 8, 2025 09:42</td>
                                        <td>Lena Kowalski</td>
                                        <td>Content removed</td>
                                        <td>Removed artwork ID 8923 for copyright violation</td>
                                        <td>172.16.0.34</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 7, 2025 22:15</td>
                                        <td>James Lee</td>
                                        <td>System update</td>
                                        <td>Updated to v2.3.1 from v2.2.9</td>
                                        <td>192.168.1.100</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 30px;">
                        <label class="form-label">Filter Logs</label>
                        <div class="form-row">
                            <div class="form-col">
                                <input type="date" class="form-control" placeholder="From date">
                            </div>
                            <div class="form-col">
                                <input type="date" class="form-control" placeholder="To date">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Action Type</label>
                        <select class="form-control">
                            <option>All actions</option>
                            <option>User management</option>
                            <option>Content changes</option>
                            <option>System changes</option>
                            <option>Security events</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Reset Filters</button>
                        <button class="btn btn-primary">Apply Filters</button>
                    </div>
                </div>

                <!-- Customizations -->
                <div class="settings-section" id="customization" style="display: none;">
                    <h2 class="settings-section-title">
                        <i class="fas fa-paint-brush"></i>
                        Platform Customizations
                    </h2>

                    <div class="form-group">
                        <label class="form-label">Primary Brand Color</label>
                        <div class="color-picker">
                            <div class="color-option active" style="background-color: #ff5e5b;" data-color="#ff5e5b"></div>
                            <div class="color-option" style="background-color: #4e73df;" data-color="#4e73df"></div>
                            <div class="color-option" style="background-color: #1cc88a;" data-color="#1cc88a"></div>
                            <div class="color-option" style="background-color: #f6c23e;" data-color="#f6c23e"></div>
                            <div class="color-option" style="background-color: #e74a3b;" data-color="#e74a3b"></div>
                            <input type="text" class="form-control" style="width: 100px; margin-left: 10px;" placeholder="#ff5e5b">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Logo</label>
                        <div class="file-upload">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="file-upload-text">Drag & drop your logo here or click to browse</div>
                            <input type="file" class="file-upload-input" accept="image/*">
                        </div>
                        <div class="preview-box">
                            <img src="https://via.placeholder.com/200x80?text=Street+%26+Ink+Logo" alt="Current Logo" class="preview-image">
                            <button class="btn btn-secondary btn-sm">Remove Logo</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Favicon</label>
                        <div class="file-upload">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="file-upload-text">Drag & drop your favicon here or click to browse</div>
                            <input type="file" class="file-upload-input" accept="image/*">
                        </div>
                        <div class="preview-box">
                            <img src="https://via.placeholder.com/32x32?text=S+I" alt="Current Favicon" class="preview-image">
                            <button class="btn btn-secondary btn-sm">Remove Favicon</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Custom CSS</label>
                        <textarea class="form-control form-textarea" placeholder="Add your custom CSS here..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Custom JavaScript</label>
                        <textarea class="form-control form-textarea" placeholder="Add your custom JavaScript here..."></textarea>
                        <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">Warning: Adding custom JavaScript can affect site functionality and security.</p>
                    </div>

                    <div class="form-actions">
                        <button class="btn btn-secondary">Cancel</button>
                        <button class="btn btn-primary">Save Customizations</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
