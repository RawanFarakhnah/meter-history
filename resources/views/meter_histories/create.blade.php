@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1">Add Meter History Record</h1>
            <p class="text-muted mb-0">Create a new meter history record</p>
        </div>
        <div>
            <a href="{{ route('meter_histories.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('meter_histories.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Basic Information</h5>
                    
                    <div class="mb-3">
                        <label for="meter_number" class="form-label">Meter Number *</label>
                        <input type="text" class="form-control" id="meter_number" name="meter_number" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="community" class="form-label">Community</label>
                        <input type="text" class="form-control" id="community" name="community">
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Become a shared">Become a shared</option>
                            <option value="Replaced">Replaced</option>
                            <option value="Used by other">Used by other</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="english_name" class="form-label">English Name</label>
                        <input type="text" class="form-control" id="english_name" name="english_name">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5 class="mb-3">Additional Information</h5>
                    
                    <div class="mb-3">
                        <label for="changed_date" class="form-label">Changed Date *</label>
                        <input type="date" class="form-control" id="changed_date" name="changed_date" required>
                    </div>
                                       
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <select class="form-select" id="reason" name="reason">
                            <option value="">Select Reason</option>
                            <option value="Burned">Burned</option>
                            <option value="Disfunctional">Disfunctional</option>
                            <option value="Incident">Incident</option>
                            <option value="Socail">Socail</option>
                            <option value="Test Meter">Test Meter</option>
                            <option value="User Left">User Left</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="household_status" class="form-label">Household Status</label>
                        <select class="form-select" id="household_status" name="household_status">
                            <option value="">Select Household Status</option>
                            <option value="Displaced">Displaced</option>
                            <option value="Left">Left</option>
                            <option value="Low Usage">Low Usage</option>
                            <option value="Served">Served</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="comet_id" class="form-label">COMET ID</label>
                        <input type="text" class="form-control" id="comet_id" name="comet_id">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('meter_histories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Record</button>
            </div>
        </form>
    </div>
</div>
@endsection