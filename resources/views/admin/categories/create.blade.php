<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm" class="form-inline" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createCategoryName" class="form-label">Category Name</label>
                            <input id="createCategoryName" class="form-control" name="category_name" type="text" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createCategoryIcon" class="form-label">Category Icon (Image)</label>
                            <input id="createCategoryIcon" class="form-control" name="icon" type="file" accept="image/*" required>
                            <small class="form-text text-muted">Upload an image for the icon.</small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createCategoryStatus" class="form-label">Status</label>
                            <select id="createCategoryStatus" class="form-control" name="status" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
