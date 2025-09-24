<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meter Histories Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #f8961e;
            --info-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --gray-color: #6c757d;
        }
        
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .table th {
            border: none;
            padding: 15px 12px;
            font-weight: 600;
        }
        
        .table td {
            padding: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }
        
        .btn-success {
            background-color: var(--success-color);
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
        }
        
        .badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .status-active {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success-color);
        }
        
        .status-inactive {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger-color);
        }
        
        .search-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .page-header {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 12px 12px 0 0;
            border: none;
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: var(--primary-color);
        }
        
        .pagination .page-link {
            border-radius: 6px;
            margin: 0 3px;
            border: none;
            color: var(--gray-color);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
        }
        
        .action-buttons .btn {
            margin-right: 5px;
        }
        
        .import-sample {
            display: flex;
            align-items: center;
            margin-top: 10px;
            color: var(--gray-color);
            font-size: 0.9rem;
        }
        
        .import-sample a {
            margin-left: 5px;
            text-decoration: none;
        }
        
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        }
        
        .filter-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        
        .filter-tag {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }
        
        .filter-tag .close {
            margin-left: 5px;
            cursor: pointer;
        }
        
        .advance-search-toggle {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .advance-search-toggle i {
            margin-right: 5px;
            transition: transform 0.3s;
        }
        
        .advance-search-toggle.collapsed i {
            transform: rotate(0deg);
        }
        
        .advance-search-toggle:not(.collapsed) i {
            transform: rotate(180deg);
        }
        
        .sortable {
            cursor: pointer;
            user-select: none;
            position: relative;
            padding-right: 20px !important;
        }
        
        .sortable:after {
            content: "↕";
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.5;
        }
        
        .sortable.asc:after {
            content: "↑";
            opacity: 1;
        }
        
        .sortable.desc:after {
            content: "↓";
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Alert Container for Notifications -->
        <div class="alert-container">
            <!-- Success/Error alerts will appear here -->
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Meter Histories</h1>
                    <p class="text-muted mb-0">Manage and monitor all meter history records</p>
                </div>
                <div>
                    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                        <i class="bi bi-plus-circle me-1"></i> Add Record
                    </button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="bi bi-upload me-1"></i> Import File
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Search and Filter Section -->
        <div class="search-box mb-4">
            <form id="searchForm" method="GET" action="#">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search by meter number, community, status..." value="">
                    </div>
                    <div class="col-md-3">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select name="status" class="form-select" id="statusFilter">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="dateFilter" class="form-label">Changed Date</label>
                        <input type="date" name="changed_date" class="form-control" id="dateFilter">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </div>
                
                <!-- Advance Search Toggle -->
                <a class="advance-search-toggle" data-bs-toggle="collapse" href="#advanceSearch" role="button" aria-expanded="false">
                    <i class="bi bi-chevron-down"></i> Advanced Search Options
                </a>
                
                <!-- Advance Search Options -->
                <div class="collapse mt-3" id="advanceSearch">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="communityFilter" class="form-label">Community</label>
                            <select name="community" class="form-select" id="communityFilter">
                                <option value="">All Communities</option>
                                <option value="community1">Community 1</option>
                                <option value="community2">Community 2</option>
                                <option value="community3">Community 3</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="meterNumberFilter" class="form-label">Meter Number</label>
                            <input type="text" name="meter_number" class="form-control" id="meterNumberFilter" placeholder="Enter meter number">
                        </div>
                        <div class="col-md-4">
                            <label for="reasonFilter" class="form-label">Reason</label>
                            <input type="text" name="reason" class="form-control" id="reasonFilter" placeholder="Enter reason">
                        </div>
                    </div>
                </div>
                
                <!-- Active Filters -->
                <div class="filter-tags" id="activeFilters">
                    <!-- Active filter tags will appear here -->
                </div>
            </form>
        </div>
        
        <!-- Records Table -->
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="sortable" data-sort="id">#</th>
                                <th class="sortable" data-sort="meter_number">Meter Number</th>
                                <th class="sortable" data-sort="community">Community</th>
                                <th class="sortable" data-sort="status">Status</th>
                                <th class="sortable" data-sort="reason">Reason</th>
                                <th class="sortable" data-sort="changed_date">Changed Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>MTR-001</td>
                                <td>Community 1</td>
                                <td><span class="badge status-active">Active</span></td>
                                <td>Installation</td>
                                <td>2023-05-15</td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary view-record" data-id="1">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary edit-record" data-id="1">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-record" data-id="1">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>MTR-002</td>
                                <td>Community 2</td>
                                <td><span class="badge status-inactive">Inactive</span></td>
                                <td>Maintenance</td>
                                <td>2023-05-10</td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary view-record" data-id="2">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary edit-record" data-id="2">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-record" data-id="2">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>MTR-003</td>
                                <td>Community 3</td>
                                <td><span class="badge status-active">Active</span></td>
                                <td>Replacement</td>
                                <td>2023-05-05</td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary view-record" data-id="3">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary edit-record" data-id="3">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-record" data-id="3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- More rows would be dynamically generated -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Showing 1 to 10 of 50 entries
            </div>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <!-- Add Record Modal -->
    <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel">Add New Meter History Record</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addRecordForm">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="meterNumber" class="form-label">Meter Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="meterNumber" name="meter_number" required>
                            </div>
                            <div class="col-md-6">
                                <label for="community" class="form-label">Community <span class="text-danger">*</span></label>
                                <select class="form-select" id="community" name="community" required>
                                    <option value="">Select Community</option>
                                    <option value="community1">Community 1</option>
                                    <option value="community2">Community 2</option>
                                    <option value="community3">Community 3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="changedDate" class="form-label">Changed Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="changedDate" name="changed_date" required>
                            </div>
                            <div class="col-12">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Meter Histories</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="importForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="importFile" class="form-label">Choose Excel/CSV File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="importFile" name="file" accept=".xlsx,.xls,.csv" required>
                            <div class="form-text">Supported formats: .xlsx, .xls, .csv. Maximum file size: 10MB</div>
                        </div>
                        <div class="import-sample">
                            <i class="bi bi-download"></i>
                            <span>Download sample file: </span>
                            <a href="#" id="downloadSample">meter_history_template.xlsx</a>
                        </div>
                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="overwriteData" name="overwrite">
                                <label class="form-check-label" for="overwriteData">
                                    Overwrite existing records
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Import Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- View Record Modal -->
    <div class="modal fade" id="viewRecordModal" tabindex="-1" aria-labelledby="viewRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRecordModalLabel">Meter History Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Basic Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Meter Number:</strong></td>
                                    <td id="viewMeterNumber">MTR-001</td>
                                </tr>
                                <tr>
                                    <td><strong>Community:</strong></td>
                                    <td id="viewCommunity">Community 1</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td><span class="badge status-active" id="viewStatus">Active</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>History Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Changed Date:</strong></td>
                                    <td id="viewChangedDate">2023-05-15</td>
                                </tr>
                                <tr>
                                    <td><strong>Reason:</strong></td>
                                    <td id="viewReason">Installation</td>
                                </tr>
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td id="viewCreatedAt">2023-05-15 10:30 AM</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6>Notes</h6>
                            <p id="viewNotes">No additional notes provided.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editFromView">Edit Record</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Record Modal -->
    <div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRecordModalLabel">Edit Meter History Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editRecordForm">
                    <input type="hidden" id="editRecordId" name="id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="editMeterNumber" class="form-label">Meter Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editMeterNumber" name="meter_number" required>
                            </div>
                            <div class="col-md-6">
                                <label for="editCommunity" class="form-label">Community <span class="text-danger">*</span></label>
                                <select class="form-select" id="editCommunity" name="community" required>
                                    <option value="">Select Community</option>
                                    <option value="community1">Community 1</option>
                                    <option value="community2">Community 2</option>
                                    <option value="community3">Community 3</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editStatus" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="editStatus" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editChangedDate" class="form-label">Changed Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="editChangedDate" name="changed_date" required>
                            </div>
                            <div class="col-12">
                                <label for="editReason" class="form-label">Reason</label>
                                <textarea class="form-control" id="editReason" name="reason" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="editNotes" class="form-label">Notes</label>
                                <textarea class="form-control" id="editNotes" name="notes" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this meter history record? This action cannot be undone.</p>
                    <div class="alert alert-warning mt-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Warning:</strong> Deleting this record will permanently remove it from the database.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete Record</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Sample data for demonstration
            const sampleRecords = [
                { id: 1, meter_number: 'MTR-001', community: 'Community 1', status: 'active', reason: 'Installation', changed_date: '2023-05-15', notes: 'New installation completed successfully.' },
                { id: 2, meter_number: 'MTR-002', community: 'Community 2', status: 'inactive', reason: 'Maintenance', changed_date: '2023-05-10', notes: 'Scheduled maintenance.' },
                { id: 3, meter_number: 'MTR-003', community: 'Community 3', status: 'active', reason: 'Replacement', changed_date: '2023-05-05', notes: 'Replaced old meter with new model.' }
            ];
            
            let currentSort = { column: 'id', direction: 'asc' };
            let recordToDelete = null;
            
            // Show alert function
            function showAlert(message, type = 'success') {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
                
                const alertHtml = `
                    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                        <i class="bi ${icon} me-2"></i>
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                
                $('.alert-container').html(alertHtml);
                
                // Auto dismiss after 5 seconds
                setTimeout(() => {
                    $('.alert').alert('close');
                }, 5000);
            }
            
            // Update active filters display
            function updateActiveFilters() {
                const formData = new FormData(document.getElementById('searchForm'));
                let activeFiltersHtml = '';
                
                for (let [key, value] of formData.entries()) {
                    if (value && key !== 'search') {
                        activeFiltersHtml += `
                            <div class="filter-tag">
                                ${key}: ${value}
                                <span class="close" data-filter="${key}">&times;</span>
                            </div>
                        `;
                    }
                }
                
                $('#activeFilters').html(activeFiltersHtml);
                
                // Add event listeners to filter close buttons
                $('.filter-tag .close').on('click', function() {
                    const filterName = $(this).data('filter');
                    $(`[name="${filterName}"]`).val('');
                    $('#searchForm').submit();
                });
            }
            
            // Initialize active filters
            updateActiveFilters();
            
            // Table sorting functionality
            $('.sortable').on('click', function() {
                const column = $(this).data('sort');
                
                // Update sort direction
                if (currentSort.column === column) {
                    currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSort.column = column;
                    currentSort.direction = 'asc';
                }
                
                // Update UI
                $('.sortable').removeClass('asc desc');
                $(this).addClass(currentSort.direction);
                
                // In a real application, you would send an AJAX request or reload the page with sort parameters
                showAlert(`Table sorted by ${column} (${currentSort.direction})`);
            });
            
            // View record functionality
            $('.view-record').on('click', function() {
                const recordId = $(this).data('id');
                const record = sampleRecords.find(r => r.id === recordId);
                
                if (record) {
                    $('#viewMeterNumber').text(record.meter_number);
                    $('#viewCommunity').text(record.community);
                    $('#viewStatus').text(record.status).removeClass('status-active status-inactive').addClass(`status-${record.status}`);
                    $('#viewChangedDate').text(record.changed_date);
                    $('#viewReason').text(record.reason);
                    $('#viewNotes').text(record.notes || 'No additional notes provided.');
                    $('#viewCreatedAt').text('2023-05-15 10:30 AM'); // This would come from the database
                    
                    // Set up the edit button in the view modal
                    $('#editFromView').data('id', recordId);
                    
                    $('#viewRecordModal').modal('show');
                }
            });
            
            // Edit record functionality
            $('.edit-record').on('click', function() {
                const recordId = $(this).data('id');
                const record = sampleRecords.find(r => r.id === recordId);
                
                if (record) {
                    $('#editRecordId').val(record.id);
                    $('#editMeterNumber').val(record.meter_number);
                    $('#editCommunity').val(record.community.toLowerCase().replace(' ', ''));
                    $('#editStatus').val(record.status);
                    $('#editChangedDate').val(record.changed_date);
                    $('#editReason').val(record.reason);
                    $('#editNotes').val(record.notes || '');
                    
                    $('#editRecordModal').modal('show');
                }
            });
            
            // Edit from view modal
            $('#editFromView').on('click', function() {
                const recordId = $(this).data('id');
                $('#viewRecordModal').modal('hide');
                
                // Trigger edit for the same record
                $(`.edit-record[data-id="${recordId}"]`).click();
            });
            
            // Delete record functionality
            $('.delete-record').on('click', function() {
                recordToDelete = $(this).data('id');
                $('#deleteConfirmModal').modal('show');
            });
            
            // Confirm delete
            $('#confirmDelete').on('click', function() {
                if (recordToDelete) {
                    // In a real application, you would send an AJAX request to delete the record
                    showAlert(`Record #${recordToDelete} has been deleted successfully.`, 'success');
                    $('#deleteConfirmModal').modal('hide');
                    recordToDelete = null;
                }
            });
            
            // Add record form submission
            $('#addRecordForm').on('submit', function(e) {
                e.preventDefault();
                
                // In a real application, you would send an AJAX request to add the record
                showAlert('New meter history record has been added successfully.', 'success');
                $('#addRecordModal').modal('hide');
                $(this).trigger('reset');
            });
            
            // Edit record form submission
            $('#editRecordForm').on('submit', function(e) {
                e.preventDefault();
                
                // In a real application, you would send an AJAX request to update the record
                showAlert('Meter history record has been updated successfully.', 'success');
                $('#editRecordModal').modal('hide');
            });
            
            // Import form submission
            $('#importForm').on('submit', function(e) {
                e.preventDefault();
                
                // In a real application, you would send an AJAX request to import the file
                const fileInput = document.getElementById('importFile');
                if (fileInput.files.length > 0) {
                    showAlert('File has been imported successfully. 3 new records added.', 'success');
                    $('#importModal').modal('hide');
                    $(this).trigger('reset');
                }
            });
            
            // Download sample file
            $('#downloadSample').on('click', function(e) {
                e.preventDefault();
                showAlert('Sample file download started.', 'success');
                // In a real application, this would trigger a file download
            });
            
            // Search form submission
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                updateActiveFilters();
                showAlert('Search filters applied successfully.');
                // In a real application, you would send an AJAX request or reload the page with search parameters
            });
        });
    </script>
</body>
</html>