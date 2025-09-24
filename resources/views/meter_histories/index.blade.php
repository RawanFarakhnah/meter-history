@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1">Meter Histories</h1>
            <p class="text-muted mb-0">Manage and monitor all meter history records</p>
        </div>
        <div>
            <a href="{{ route('meter_histories.create') }}" class="btn btn-primary me-2">
                <i class="bi bi-plus-circle me-1"></i> Add Record
            </a>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="bi bi-upload me-1"></i> Import File
            </button>
        </div>
    </div>
</div>

<!-- Search Section -->
@include('meter_histories.partials.search')

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
                    @forelse($meterHistories as $history)
                        <tr>
                            <td>{{ $history->id }}</td>
                            <td>{{ $history->meter_number ?? 'N/A' }}</td>
                            <td>{{ $history->community ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $statusClass = 'status-active';
                                    if($history->status == 'inactive') $statusClass = 'status-inactive';
                                    elseif($history->status == 'pending') $statusClass = 'bg-warning text-dark';
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $history->status ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $history->reason ?? 'N/A' }}</td>
                            <td>{{ $history->changed_date ?? 'N/A' }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('meter_histories.show', $history) }}" class="btn btn-sm btn-outline-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('meter_histories.edit', $history) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger delete-record" 
                                        data-id="{{ $history->id }}" 
                                        data-url="{{ route('meter_histories.destroy', $history) }}"
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox display-4 text-muted"></i>
                                <p class="mt-2 text-muted">No meter history records found.</p>
                                @if(request()->anyFilled(['search', 'status', 'changed_date']))
                                    <a href="{{ route('meter_histories.index') }}" class="btn btn-primary mt-2">
                                        Clear Filters
                                    </a>
                                @else
                                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#importModal">
                                        <i class="bi bi-upload me-1"></i> Import Your First Records
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($meterHistories->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted">
            Showing {{ $meterHistories->firstItem() }} to {{ $meterHistories->lastItem() }} of {{ $meterHistories->total() }} entries
        </div>
        <div>
            {{ $meterHistories->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endif

<!-- Modals -->
@include('meter_histories.partials.modals')

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Delete record functionality
        $('.delete-record').on('click', function() {
            const deleteUrl = $(this).data('url');
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmModal').modal('show');
        });

        // Filter tag close functionality
        $('.filter-tag .close').on('click', function() {
            const filterName = $(this).data('filter');
            $('[name="' + filterName + '"]').val('');
            $('#searchForm').submit();
        });

        // Simple sorting functionality (for demonstration)
        $('.sortable').on('click', function() {
            const column = $(this).data('sort');
            const currentUrl = new URL(window.location.href);
            const currentSort = currentUrl.searchParams.get('sort');
            const currentDirection = currentUrl.searchParams.get('direction');
            
            let newDirection = 'asc';
            if (currentSort === column && currentDirection === 'asc') {
                newDirection = 'desc';
            }
            
            currentUrl.searchParams.set('sort', column);
            currentUrl.searchParams.set('direction', newDirection);
            window.location.href = currentUrl.toString();
        });

        // Update sort indicators
        const urlParams = new URLSearchParams(window.location.search);
        const currentSort = urlParams.get('sort');
        const currentDirection = urlParams.get('direction');
        
        if (currentSort) {
            $(`[data-sort="${currentSort}"]`).addClass(currentDirection);
        }

        // Import form handling
        $('#importForm').on('submit', function(e) {
            const fileInput = $('#importFile')[0];
            if (fileInput.files.length === 0) {
                e.preventDefault();
                alert('Please select a file to import.');
                return false;
            }
            
            const file = fileInput.files[0];
            const fileSize = file.size / 1024 / 1024; // MB
            if (fileSize > 10) {
                e.preventDefault();
                alert('File size must be less than 10MB.');
                return false;
            }
            
            // Show loading state
            $('.btn-success', this).html('<i class="bi bi-arrow-repeat spinner"></i> Importing...').prop('disabled', true);
        });
    });
</script>
@endpush