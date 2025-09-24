<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="importModalLabel">Import Meter Histories</h5>
               <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <form action="{{ route('meter_histories.import') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="modal-body">
                   <div class="mb-3">
                       <label for="importFile" class="form-label">Choose Excel/CSV File <span class="text-danger">*</span></label>
                       <input type="file" class="form-control" id="importFile" name="file" accept=".xlsx,.xls,.csv" required>
                       <div class="form-text">Supported formats: .xlsx, .xls, .csv. Maximum file size: 10MB</div>
                   </div>
                   
                   <div class="import-sample">
                       <i class="bi bi-info-circle"></i>
                       <div class="ms-2">
                           <strong>Download sample template:</strong>
                           <p class="mb-1 small">Use this template to ensure proper formatting of your data.</p>
                           <a href="{{ route('meter_histories.download_sample') }}" id="downloadSample" class="btn btn-sm btn-outline-primary">
                             <i class="bi bi-download me-1"></i> Download Template
                           </a>
                       </div>
                   </div>
                   
                   <div class="mt-3">
                       <div class="form-check">
                           <input class="form-check-input" type="checkbox" id="overwriteData" name="overwrite">
                           <label class="form-check-label" for="overwriteData">
                               Overwrite existing records (truncate table before import)
                           </label>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-success">
                       <i class="bi bi-upload me-1"></i> Import Data
                   </button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Record</button>
                </form>
            </div>
        </div>
    </div>
</div>