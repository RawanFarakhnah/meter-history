@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1">Edit Meter History Record</h1>
            <p class="text-muted mb-0">Update meter history record #{{ $meterHistory->id }}</p>
        </div>
        <div>
            <a href="{{ route('meter_histories.index') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('meter_histories.show', $meterHistory) }}" class="btn btn-outline-primary">
                <i class="bi bi-eye me-1"></i> View
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('meter_histories.update', $meterHistory) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Basic Information</h5>
                    
                    <div class="mb-3">
                        <label for="meter_number" class="form-label">Meter Number *</label>
                        <input type="text" class="form-control" id="meter_number" name="meter_number" 
                               value="{{ old('meter_number', $meterHistory->meter_number) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="community" class="form-label">Community</label>
                        <input type="text" class="form-control" id="community" name="community" 
                               value="{{ old('community', $meterHistory->community) }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Become a shared" {{ old('status', $meterHistory->status) == 'Become a shared' ? 'selected' : '' }}>Become a shared</option>
                            <option value="Replaced" {{ old('status', $meterHistory->status) == 'Replaced' ? 'selected' : '' }}>Replaced</option>
                            <option value="Used by other" {{ old('status', $meterHistory->status) == 'Used by other' ? 'selected' : '' }}>Used by other</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="english_name" class="form-label">English Name</label>
                        <input type="text" class="form-control" id="english_name" name="english_name" 
                               value="{{ old('english_name', $meterHistory->english_name) }}">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5 class="mb-3">Additional Information</h5>
                    
                    <div class="mb-3">
                        <label for="changed_date" class="form-label">Changed Date *</label>
                        <input type="date" class="form-control" id="changed_date" name="changed_date" 
                               value="{{ old('changed_date', $meterHistory->changed_date) }}" required>
                    </div>
                    
                     <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <select class="form-select" id="reason" name="reason">
                            <option value="">Select Reason</option>
                            <option value="Burned" {{ old('reason', $meterHistory->reason) == 'Burned' ? 'selected' : '' }}>Burned</option>
                            <option value="Disfunctional" {{ old('reason', $meterHistory->reason) == 'Disfunctional' ? 'selected' : '' }}>Disfunctional</option>
                            <option value="Incident" {{ old('reason', $meterHistory->reason) == 'Incident' ? 'selected' : '' }}>Incident</option>
                            <option value="Socail" {{ old('reason', $meterHistory->reason) == 'Socail' ? 'selected' : '' }}>Socail</option>
                            <option value="Test Meter" {{ old('reason', $meterHistory->reason) == 'Test Meter' ? 'selected' : '' }}>Test Meter</option>
                            <option value="User Left" {{ old('reason', $meterHistory->reason) == 'User Left' ? 'selected' : '' }}>User Left</option>
                        </select>
                    </div>
                                      
                    <div class="mb-3">
                        <label for="household_status" class="form-label">Household Status</label>
                        <select class="form-select" id="household_status" name="household_status">
                            <option value="">Select Household Status</option>
                            <option value="Displaced" {{ old('household_status', $meterHistory->household_status) == 'Displaced' ? 'selected' : '' }}>Displaced</option>
                            <option value="Left" {{ old('household_status', $meterHistory->household_status) == 'Left' ? 'selected' : '' }}>Left</option>
                            <option value="Low Usage" {{ old('household_status', $meterHistory->household_status) == 'Low Usage' ? 'selected' : '' }}>Low Usage</option>
                            <option value="Served" {{ old('household_status', $meterHistory->household_status) == 'Served' ? 'selected' : '' }}>Served</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comet_id" class="form-label">COMET ID</label>
                        <input type="text" class="form-control" id="comet_id" name="comet_id" 
                               value="{{ old('comet_id', $meterHistory->comet_id) }}">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $meterHistory->notes) }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('meter_histories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Record</button>
            </div>
        </form>
    </div>
</div>
@endsection