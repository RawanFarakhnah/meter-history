@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1">Meter History Details</h1>
            <p class="text-muted mb-0">View detailed information about this meter record</p>
        </div>
        <div>
            <a href="{{ route('meter_histories.index') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('meter_histories.edit', $meterHistory) }}" class="btn btn-primary me-2">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <button class="btn btn-danger delete-record" 
                    data-id="{{ $meterHistory->id }}" 
                    data-url="{{ route('meter_histories.destroy', $meterHistory) }}">
                <i class="bi bi-trash me-1"></i> Delete
            </button>
        </div>
    </div>
</div>

<!-- Details Card -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Basic Information</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="40%"><strong>Meter Number:</strong></td>
                        <td>{{ $meterHistory->meter_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Community:</strong></td>
                        <td>{{ $meterHistory->community ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @php
                                $statusClass = 'status-active';
                                if($meterHistory->status == 'inactive') $statusClass = 'status-inactive';
                                elseif($meterHistory->status == 'pending') $statusClass = 'bg-warning text-dark';
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $meterHistory->status ?? 'N/A' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>English Name:</strong></td>
                        <td>{{ $meterHistory->english_name ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5 class="mb-3"><i class="bi bi-calendar-event me-2"></i>History Details</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="40%"><strong>Changed Date:</strong></td>
                        <td>{{ $meterHistory->changed_date ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Reason:</strong></td>
                        <td>{{ $meterHistory->reason ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Household Status:</strong></td>
                        <td>{{ $meterHistory->household_status ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>COMET ID:</strong></td>
                        <td>{{ $meterHistory->comet_id ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        @if($meterHistory->notes)
        <div class="row mt-4">
            <div class="col-12">
                <h5><i class="bi bi-journal-text me-2"></i>Notes</h5>
                <div class="border rounded p-3 bg-light">
                    {{ $meterHistory->notes }}
                </div>
            </div>
        </div>
        @endif
        
        <div class="row mt-4">
            <div class="col-12">
                <small class="text-muted">
                    <i class="bi bi-clock me-1"></i>
                    Created: {{ $meterHistory->created_at->format('M j, Y g:i A') }} | 
                    Updated: {{ $meterHistory->updated_at->format('M j, Y g:i A') }}
                </small>
            </div>
        </div>
    </div>
</div>

@include('meter_histories.partials.modals')

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-record').on('click', function() {
            const deleteUrl = $(this).data('url');
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmModal').modal('show');
        });
    });
</script>
@endpush