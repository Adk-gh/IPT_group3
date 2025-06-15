<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Street & Ink | Reports & Moderation</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

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
         @include('admin.adminnavbar')



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
                @foreach($reports as $report)
                <tr>
                    <td>
                        <span class="report-type art">
                            <i class="fas fa-paint-brush"></i> Artwork
                        </span>
                    </td>
                    <td>
                        <div class="art-cell">
                            @if($report->post->image)
                            <div class="art-thumb">
                                <img src="{{ asset('storage/' . $report->post->image_url) }}" alt="Artwork">
                                 <img src="{{ asset('storage/' . $report->post->image_url) }}"
                                    class="img-fluid rounded clickable-image"
                                    alt="Post Image">
                            </div>
                            @endif
                            <div class="art-info">
                                <div class="art-title">{{ Str::limit($report->post->title, 20) }}</div>
                                  <img src="{{ asset('storage/' . $report->post->image_url) }}"
     class="img-thumbnail"
     style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
     alt="Post Image">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm">
                                <img src="{{ $report->user->profile_picture ? asset('storage/' . $report->user->profile_picture) : asset('img/default.jpg') }}" alt="User Avatar">
                            </div>
                            <div class="user-info">
                                <div class="user-name-sm">{{ $report->user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar-sm">
                                <img src="{{ $report->post->user->profile_picture ? asset('storage/' . $report->post->user->profile_picture) : asset('img/default.jpg') }}" alt="User Avatar">
                            </div>
                            <div class="user-info">
                                <div class="user-name-sm">{{ $report->post->user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $report->created_at->format('M j, g:i A') }}</td>
                    <td>
                        @if($report->status == 'resolved')
                            <span class="status resolved">Resolved</span>
                        @elseif($report->status == 'reviewed')
                            <span class="status reviewed">Reviewed</span>
                        @else
                            <span class="status open">Pending</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn view" title="View" data-report-id="{{ $report->id }}">
    <i class="fas fa-eye"></i>
</button>
                            <button class="action-btn resolve" title="Resolve" data-id="{{ $report->id }}">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="action-btn ignore" title="Ignore" data-id="{{ $report->id }}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <div class="pagination-info">Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} reports</div>
        <div class="pagination-btns">
            @if($reports->onFirstPage())
                <button class="page-btn disabled"><i class="fas fa-chevron-left"></i></button>
            @else
                <a href="{{ $reports->previousPageUrl() }}" class="page-btn"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach(range(1, $reports->lastPage()) as $page)
                @if($page == $reports->currentPage())
                    <button class="page-btn active">{{ $page }}</button>
                @else
                    <a href="{{ $reports->url($page) }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach

            @if($reports->hasMorePages())
                <a href="{{ $reports->nextPageUrl() }}" class="page-btn"><i class="fas fa-chevron-right"></i></a>
            @else
                <button class="page-btn disabled"><i class="fas fa-chevron-right"></i></button>
            @endif
        </div>
    </div>
</div>



<div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Report Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<script>
// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Use event delegation for view buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.action-btn.view')) {
            const button = e.target.closest('.action-btn.view');
            currentReportId = button.getAttribute('data-report-id');
            loadReportDetails(currentReportId);
        }
    });

    // Initialize modal
    const reportModal = new bootstrap.Modal(document.getElementById('reportModal'));

    window.openModal = function() {
        reportModal.show();
    };

    window.closeModal = function() {
        reportModal.hide();
    };
});
// Store the current report ID
let currentReportId = null;

// Initialize modal functionality
function initModal() {
    // Close modal when clicking the X button
    document.getElementById('modalClose').addEventListener('click', closeModal);

    // Close modal when clicking outside
    document.getElementById('reportModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Attach click handlers to all view buttons
    document.querySelectorAll('.action-btn.view').forEach(button => {
        button.addEventListener('click', function() {
            currentReportId = this.getAttribute('data-report-id');
            loadReportDetails(currentReportId);
        });
    });
}

// Function to load report details
function loadReportDetails(reportId) {
    fetch(`/admin/reports/${reportId}/details`)
        .then(response => response.json())
        .then(data => {
            populateModal(data);
            openModal();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load report details');
        });
}

// Function to populate modal content
function populateModal(report) {
    const modalBody = document.getElementById('modalBody');

    // Build the HTML content
    modalBody.innerHTML = `
        <div class="modal-section">
            <h4 class="section-title">
                <i class="fas fa-flag"></i> Reported Content
            </h4>
            <div class="report-content">
                ${report.post && report.post.image_url ?
                    `<img src="/storage/${report.post.image_url}" alt="Reported Artwork" class="report-preview">` : ''}
                <div class="report-reason">Reason: ${report.reason}</div>
                <div class="report-description">
                    ${report.additional_info || 'No additional details provided'}
                </div>
            </div>
        </div>

        <!-- Other modal sections (reporter info, reported user, etc.) -->
        <!-- ... (include all your modal sections from previous example) ... -->

        <div class="modal-footer">
            <button class="btn btn-secondary" id="dismissBtn">
                <i class="fas fa-times"></i> Dismiss Report
            </button>
            <button class="btn btn-warning" id="warnBtn">
                <i class="fas fa-exclamation-triangle"></i> Warn User
            </button>
            ${report.post ? `
            <button class="btn btn-danger" id="deleteBtn">
                <i class="fas fa-trash"></i> Delete Content
            </button>
            ` : ''}
            <button class="btn btn-success" id="resolveBtn">
                <i class="fas fa-check"></i> Resolve Report
            </button>
        </div>
    `;

    // Attach event listeners to action buttons
    document.getElementById('dismissBtn')?.addEventListener('click', () => dismissReport(report.id));
    document.getElementById('warnBtn')?.addEventListener('click', () => warnUser(report.reported_user?.id));
    document.getElementById('deleteBtn')?.addEventListener('click', () => deleteContent(report.post?.id));
    document.getElementById('resolveBtn')?.addEventListener('click', () => {
        const notes = document.getElementById('reportNotes')?.value || '';
        resolveReport(report.id, notes);
    });
}

// Modal control functions
function openModal() {
    document.getElementById('reportModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent scrolling
}

function closeModal() {
    document.getElementById('reportModal').style.display = 'none';
    document.body.style.overflow = ''; // Restore scrolling
    currentReportId = null;
}

// Action functions
function dismissReport(reportId) {
    console.log('Dismissing report:', reportId);
    // Add your AJAX call here
    closeModal();
}

function warnUser(userId) {
    console.log('Warning user:', userId);
    // Add your AJAX call here
}

function deleteContent(postId) {
    console.log('Deleting content:', postId);
    // Add your AJAX call here
    closeModal();
}

function resolveReport(reportId, notes) {
    console.log('Resolving report:', reportId, 'with notes:', notes);
    // Add your AJAX call here
    closeModal();
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initModal);

// Reinitialize when content is loaded via AJAX (if needed)
document.addEventListener('ajaxComplete', initModal);
</script>

    <script src="resources/js/admin-reports.js"></script>

<!-- Before closing </body> -->
<script src="{{ asset('js/loading.js') }}"></script>
</body>
</html>
