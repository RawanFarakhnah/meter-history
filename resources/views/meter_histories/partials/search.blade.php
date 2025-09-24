<!-- Search and Filter Section -->
<div class="search-box mb-4">
    <form id="searchForm" method="GET" action="{{ route('meter_histories.index') }}">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Search</label>
                <input type="text" name="search" class="form-control" placeholder="Search by meter number, community, status..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label for="statusFilter" class="form-label">Status</label>
                <select name="status" class="form-select" id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="Become a shared" {{ request('status') == 'Become a shared' ? 'selected' : '' }}>Become a shared</option>
                    <option value="Replaced" {{ request('status') == 'Replaced' ? 'selected' : '' }}>Replaced</option>
                    <option value="Used by other" {{ request('status') == 'Used by other' ? 'selected' : '' }}>Used by other</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dateFilter" class="form-label">Changed Date</label>
                <input type="date" name="changed_date" class="form-control" id="dateFilter" value="{{ request('changed_date') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>
        </div>
        
        <!-- Active Filters -->
        <div class="filter-tags mt-3" id="activeFilters">
            @if(request('search'))
                <div class="filter-tag">
                    Search: {{ request('search') }}
                    <span class="close" data-filter="search">&times;</span>
                </div>
            @endif
            @if(request('status'))
                <div class="filter-tag">
                    Status: {{ ucfirst(request('status')) }}
                    <span class="close" data-filter="status">&times;</span>
                </div>
            @endif
            @if(request('changed_date'))
                <div class="filter-tag">
                    Date: {{ request('changed_date') }}
                    <span class="close" data-filter="changed_date">&times;</span>
                </div>
            @endif
        </div>
    </form>
</div>