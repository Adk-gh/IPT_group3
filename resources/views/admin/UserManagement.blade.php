<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street & Ink | User Management</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/admin-usermanagement.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin-usermanagement.js') }}" defer></script>
      <!-- Inside <head> -->
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
</head>
<body>
   @include('admin.adminsidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
         @include('admin.adminnavbar')


        <!-- User Table -->
        <div class="data-table">
            <div class="table-container">
                @php
            $users = isset($users) ? $users : []; // Fallback to avoid undefined variable
        @endphp
                @include('admin.user.table')
            </div>


            <div class="pagination">
                <div class="pagination-info">Showing 1 to 8 of 8,742 users</div>
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
    </div>

    <!-- User Profile Modal -->
    <div class="modal" id="userModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">User Profile</h3>
                <button class="modal-close" onclick="closeUserModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" id="modalUserAvatar">
                    </div>
                    <div class="profile-info">
                        <h2 class="profile-name" id="modalUserName">Sarah Johnson</h2>
                        <div class="profile-username" id="modalUserUsername">@sarah_artist</div>
                        <div class="profile-badges">
                            <span class="badge badge-success" id="modalUserRole">Artist</span>
                            <span class="badge badge-primary" id="modalUserStatus">Active</span>
                        </div>
                        <div class="profile-stats">
                            <div class="profile-stat">
                                <div class="profile-stat-value" id="modalUserArtworks">42</div>
                                <div class="profile-stat-label">Artworks</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-value" id="modalUserFollowers">1.2k</div>
                                <div class="profile-stat-label">Followers</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-value" id="modalUserFollowing">356</div>
                                <div class="profile-stat-label">Following</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab active" data-target="profileDetails">Details</div>
                    <div class="tab" data-target="profileArtworks">Artworks</div>
                    <div class="tab" data-target="profileActivity">Activity</div>
                    <div class="tab" data-target="profileReports">Reports</div>
                    <div class="tab" data-target="profileAdmin">Admin</div>
                </div>

                <div class="tab-content active" id="profileDetails">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="Sarah Johnson" id="modalUserFullName">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="sarah.j@example.com" id="modalUserEmail">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="+1 555-123-4567" id="modalUserPhone">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" value="London, UK" id="modalUserLocation">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Joined Date</label>
                                <input type="text" class="form-control" value="June 12, 2023" readonly id="modalUserJoined">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Active</label>
                                <input type="text" class="form-control" value="2 hours ago" readonly id="modalUserLastActive">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control form-textarea" id="modalUserBio">Street artist based in London. Specializing in large-scale murals and stencil work. Passionate about urban art and community projects.</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Social Links</label>
                        <div class="form-row">
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Instagram" value="@sarah_artist" id="modalUserInstagram">
                            </div>
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Twitter" value="@sarah_art" id="modalUserTwitter">
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 10px;">
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Website" value="sarahjohnsonart.com" id="modalUserWebsite">
                            </div>
                            <div class="form-col">
                                <input type="text" class="form-control" placeholder="Portfolio" value="behance.net/sarahjohnson" id="modalUserPortfolio">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileArtworks">
                    <p>User's uploaded artworks would be displayed here in a grid or list view.</p>
                    <div class="card-grid" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-body">
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-vincent-gerbouin-445991-2263686.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Urban Dreams</div>
                                        <div class="art-artist">Shoreditch, London</div>
                                        <div class="art-artist"><small>Uploaded: 3 days ago</small></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-secondary btn-sm">View</button>
                                <button class="btn btn-primary btn-sm">Feature</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="art-cell">
                                    <div class="art-thumb">
                                        <img src="img/pexels-conojeghuo-173301.jpg" alt="Artwork">
                                    </div>
                                    <div class="art-info">
                                        <div class="art-title">Color Explosion</div>
                                        <div class="art-artist">Camden, London</div>
                                        <div class="art-artist"><small>Uploaded: 1 week ago</small></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-secondary btn-sm">View</button>
                                <button class="btn btn-primary btn-sm">Feature</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileActivity">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-upload"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">Today, 10:15 AM</div>
                                <div class="timeline-text">Uploaded new artwork "Urban Dreams"</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">Yesterday, 5:30 PM</div>
                                <div class="timeline-text">Commented on artwork "Neon Installation" by @dface</div>
                                <div class="timeline-user">
                                    <div class="timeline-user-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User">
                                    </div>
                                    <div class="timeline-user-name">David Peterson</div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">Yesterday, 3:20 PM</div>
                                <div class="timeline-text">Liked artwork "Abstract Flow" by @felipe_pantone</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">2 days ago</div>
                                <div class="timeline-text">Started following @banksy</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileReports">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-flag"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">3 days ago</div>
                                <div class="timeline-text">Reported for inappropriate content</div>
                                <div class="timeline-text"><strong>Status:</strong> <span class="badge badge-warning">Pending Review</span></div>
                                <div class="timeline-user">
                                    <div class="timeline-user-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User">
                                    </div>
                                    <div class="timeline-user-name">Emma Wilson</div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">1 week ago</div>
                                <div class="timeline-text">Warning issued for spam behavior</div>
                                <div class="timeline-text"><strong>Admin:</strong> Michael Chen</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">
                                <i class="fas fa-flag"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-date">2 weeks ago</div>
                                <div class="timeline-text">Report filed for incorrect location</div>
                                <div class="timeline-text"><strong>Status:</strong> <span class="badge badge-success">Resolved</span></div>
                                <div class="timeline-user">
                                    <div class="timeline-user-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User">
                                    </div>
                                    <div class="timeline-user-name">Marcus Taylor</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="profileAdmin">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Account Status</label>
                                <select class="form-control" id="modalUserAccountStatus">
                                    <option value="active">Active</option>
                                    <option value="banned">Banned</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Role</label>
                                <select class="form-control" id="modalUserAccountRole">
                                    <option value="user">Basic User</option>
                                    <option value="artist" selected>Artist</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label">Verification Status</label>
                                <select class="form-control" id="modalUserVerification">
                                    <option value="verified" selected>Verified Artist</option>
                                    <option value="unverified">Not Verified</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Featured Status</label>
                                <select class="form-control" id="modalUserFeatured">
                                    <option value="featured">Featured</option>
                                    <option value="regular" selected>Regular</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Admin Notes</label>
                        <textarea class="form-control form-textarea" id="modalUserAdminNotes">User has been active and contributing quality content. No issues reported except one minor location correction needed.</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Actions</label>
                        <div class="form-row">
                            <div class="form-col">
                                <button class="btn btn-secondary" style="width: 100%;">
                                    <i class="fas fa-key"></i> Reset Password
                                </button>
                            </div>
                            <div class="form-col">
                                <button class="btn btn-secondary" style="width: 100%;">
                                    <i class="fas fa-envelope"></i> Send Message
                                </button>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 10px;">
                            <div class="form-col">
                                <button class="btn btn-warning" style="width: 100%;">
                                    <i class="fas fa-exclamation-triangle"></i> Issue Warning
                                </button>
                            </div>
                            <div class="form-col">
                                <button class="btn btn-danger" style="width: 100%;">
                                    <i class="fas fa-trash"></i> Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeUserModal()">Cancel</button>
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal" id="addUserModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New User</h3>
                <button class="modal-close" onclick="closeAddUserModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="First name">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Email address">
                </div>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <select class="form-control">
                                <option>Basic User</option>
                                <option>Artist</option>
                                <option>Moderator</option>
                                <option>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control">
                                <option>Active</option>
                                <option>Pending</option>
                                <option>Banned</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea class="form-control form-textarea" placeholder="Short bio..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeAddUserModal()">Cancel</button>
                <button class="btn btn-primary">Create User</button>
            </div>
        </div>
    </div>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
