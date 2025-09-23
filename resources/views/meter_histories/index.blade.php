@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Meter Histories</h2>
    <div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">Import File</button>
    </div>
</div>

<!-- Search form -->
<form method="GET" action="{{ route('meter_histories.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>

<!-- Table -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>Changed Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($meterHistories as $history)
                    <tr>
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->status }}</td>
                        <td>{{ $history->reason }}</td>
                        <td>{{ $history->changed_date }}</td>
                        <td>
                            <a href="{{ route('meter_histories.edit', $history) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('meter_histories.destroy', $history) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $meterHistories->links('pagination::bootstrap-5') }}
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('meter_histories.import.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Meter Histories File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="file" class="form-label">Choose Excel/CSV File <span class="text-danger">*</span></label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Import</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection
