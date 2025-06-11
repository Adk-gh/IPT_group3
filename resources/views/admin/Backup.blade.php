<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | Admin - Data & Backup</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin-backup.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-backup.js') }}" defer></script>
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
                <div class="stat-icon art">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div class="stat-title">Total Artworks</div>
                <div class="stat-value">25,189</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8.3% from last month
                </div>
            </div>
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
                <div class="stat-icon database">
                    <i class="fas fa-database"></i>
                </div>
                <div class="stat-title">Database Size</div>
                <div class="stat-value">1.8 GB</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 0.4% from last week
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon backup">
                    <i class="fas fa-history"></i>
                </div>
                <div class="stat-title">Last Backup</div>
                <div class="stat-value">Jun 15, 2023</div>
                <div class="stat-change">
                    <i class="fas fa-clock"></i> 2 days ago
                </div>
            </div>
        </div>

        <!-- Manual Backup Tools -->
        <div class="backup-tools">
            <div class="backup-tool">
                <div class="backup-tool-header">
                    <div class="backup-tool-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div>
                        <h3 class="backup-tool-title">Download Full Backup</h3>
                        <p class="backup-tool-desc">Complete backup of all database tables and media files</p>
                    </div>
                </div>
                <div class="backup-tool-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-file-archive"></i> Download SQL
                    </button>
                    <button class="btn btn-secondary">
                        <i class="fas fa-file-code"></i> Download JSON
                    </button>
                </div>
            </div>

            <div class="backup-tool">
                <div class="backup-tool-header">
                    <div class="backup-tool-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div>
                        <h3 class="backup-tool-title">Custom Backup</h3>
                        <p class="backup-tool-desc">Select specific data types to backup</p>
                    </div>
                </div>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="backup-users" checked>
                        <label for="backup-users">Users</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="backup-art" checked>
                        <label for="backup-art">Artworks</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="backup-comments" checked>
                        <label for="backup-comments">Comments</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="backup-locations" checked>
                        <label for="backup-locations">Locations</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="backup-reports">
                        <label for="backup-reports">Reports</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="backup-artists">
                        <label for="backup-artists">Artists & Partners</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Format</label>
                    <select class="form-control">
                        <option>CSV</option>
                        <option>JSON</option>
                        <option>SQL Dump</option>
                        <option>Encrypted ZIP</option>
                    </select>
                </div>
                <div class="backup-tool-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-download"></i> Generate Backup
                    </button>
                </div>
            </div>

            <div class="backup-tool">
                <div class="backup-tool-header">
                    <div class="backup-tool-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div>
                        <h3 class="backup-tool-title">Run System Backup</h3>
                        <p class="backup-tool-desc">Trigger automatic full backup process</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Backup Destination</label>
                    <select class="form-control">
                        <option>Local Server</option>
                        <option>Google Drive</option>
                        <option>Amazon S3</option>
                        <option>Dropbox</option>
                    </select>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="notify-backup" checked>
                    <label for="notify-backup">Notify me when complete</label>
                </div>
                <div class="backup-tool-actions">
                    <button class="btn btn-primary btn-lg">
                        <i class="fas fa-play"></i> Run Backup Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Backup History Log -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Backup History</h3>
                <div class="table-actions">
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-download"></i> Export Log
                    </button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Backup Name</th>
                            <th>Type</th>
                            <th>Date & Time</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>full_backup_06152023.sql</td>
                            <td>Full</td>
                            <td>Jun 15, 2023 - 2:10AM</td>
                            <td>126MB</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>users_backup_06122023.json</td>
                            <td>Partial</td>
                            <td>Jun 12, 2023 - 11:30PM</td>
                            <td>42MB</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>full_backup_06082023.sql</td>
                            <td>Full</td>
                            <td>Jun 8, 2023 - 2:15AM</td>
                            <td>124MB</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>art_locations_06052023.csv</td>
                            <td>Partial</td>
                            <td>Jun 5, 2023 - 3:45PM</td>
                            <td>18MB</td>
                            <td><span class="status completed">Completed</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>full_backup_06012023.sql</td>
                            <td>Full</td>
                            <td>Jun 1, 2023 - 2:05AM</td>
                            <td>123MB</td>
                            <td><span class="status failed">Failed</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn" title="Retry">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                    <button class="action-btn" title="View Log">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div class="pagination-info">Showing 1 to 5 of 24 backups</div>
                <div class="pagination-btns">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn">5</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        <!-- Cloud Storage Integration -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cloud Storage Integration</h3>
            </div>
            <div class="card-body">
                <div class="cloud-status">
                    <div class="cloud-status-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <div class="cloud-status-text">
                        Google Drive Connected (Active)
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Encryption Status</label>
                    <input type="text" class="form-control" value="Enabled (AES-256)" readonly>
                </div>

                <div class="progress-container">
                    <div class="progress-label">
                        <span>Storage Usage</span>
                        <span>1.2GB of 10GB (12%)</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 12%;"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Last Cloud Sync</label>
                    <input type="text" class="form-control" value="Jun 15, 2023 - 2:15AM" readonly>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i> Sync Now
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-cog"></i> Cloud Settings
                </button>
            </div>
        </div>

        <!-- Auto Backup Settings -->
        <div class="form-container">
            <h3 class="section-title">Auto Backup Settings</h3>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Backup Frequency</label>
                        <select class="form-control">
                            <option>Daily</option>
                            <option selected>Weekly</option>
                            <option>Monthly</option>
                        </select>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Time of Day</label>
                        <select class="form-control">
                            <option>12:00 AM</option>
                            <option>1:00 AM</option>
                            <option>2:00 AM</option>
                            <option selected>3:00 AM</option>
                            <option>4:00 AM</option>
                            <option>5:00 AM</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Storage Type</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" id="storage-local" name="storage-type" checked>
                        <label for="storage-local">Local Server</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="storage-cloud" name="storage-type">
                        <label for="storage-cloud">Cloud Storage (Google Drive)</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="storage-both" name="storage-type">
                        <label for="storage-both">Both Local and Cloud</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Backup Retention</label>
                <input type="text" class="form-control" placeholder="10" value="10">
                <small class="form-text text-muted">Number of backups to keep (older backups will be automatically deleted)</small>
            </div>

            <div class="checkbox-item">
                <input type="checkbox" id="email-notifications" checked>
                <label for="email-notifications">Enable email notifications for backup results</label>
            </div>

            <div class="form-actions">
                <button class="btn btn-secondary">
                    Cancel
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </div>
        </div>

        <!-- Restore Data (Advanced) -->
        <div class="form-container">
            <h3 class="section-title">Restore Data (Advanced)</h3>
            <div class="alert alert-warning" style="background-color: #fff3cd; color: #856404; padding: 15px; border-radius: var(--border-radius); margin-bottom: 20px; border-left: 4px solid #ffeeba;">
                <i class="fas fa-exclamation-triangle"></i> <strong>Warning:</strong> Restoring data will overwrite existing records. This action cannot be undone.
            </div>

            <div class="form-group">
                <label class="form-label">Select Backup to Restore</label>
                <select class="form-control">
                    <option>-- Select a backup --</option>
                    <option>full_backup_06152023.sql (Jun 15, 2023 - 2:10AM)</option>
                    <option>users_backup_06122023.json (Jun 12, 2023 - 11:30PM)</option>
                    <option>full_backup_06082023.sql (Jun 8, 2023 - 2:15AM)</option>
                    <option>art_locations_06052023.csv (Jun 5, 2023 - 3:45PM)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Restore Mode</label>
                <select class="form-control">
                    <option>Complete Restore (All Data)</option>
                    <option>Partial Restore (Selected Tables Only)</option>
                    <option>Merge Data (Keep Existing Records)</option>
                </select>
            </div>

            <div class="checkbox-item">
                <input type="checkbox" id="confirm-restore">
                <label for="confirm-restore">I understand this will overwrite existing data</label>
            </div>

            <div class="form-actions">
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-history"></i> Restore Data
                </button>
            </div>
        </div>

        <!-- Export Tools -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">Export Tools</h3>
                <div class="table-actions">
                    <button class="btn btn-secondary btn-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Data Type</label>
                            <select class="form-control">
                                <option>Users List</option>
                                <option>Art Uploads</option>
                                <option>Locations & GPS Data</option>
                                <option>Report History</option>
                                <option>Artist Profiles</option>
                                <option>Comments</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Format</label>
                            <select class="form-control">
                                <option>CSV</option>
                                <option>JSON</option>
                                <option>Encrypted ZIP</option>
                                <option>SQL Dump</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Date Range</label>
                    <div class="form-row">
                        <div class="form-col">
                            <input type="date" class="form-control" placeholder="Start Date">
                        </div>
                        <div class="form-col">
                            <input type="date" class="form-control" placeholder="End Date">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-file-export"></i> Generate Export
                    </button>
                </div>
            </div>
        </div>
    </div>


<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
