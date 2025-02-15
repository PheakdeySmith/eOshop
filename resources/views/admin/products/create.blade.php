<!-- Create Product Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Create New Product</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createProductForm" class="form-inline" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createProductCode" class="form-label">Product Code</label>
                            <input id="createProductCode" class="form-control" name="product_code" type="text" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="createProductName" class="form-label">Product Name</label>
                            <input id="createProductName" class="form-control" name="product_name" type="text" required>
                        </div>
                        <div class="col-md-6">
                            <label for="createProductPrice" class="form-label">Price</label>
                            <input id="createProductPrice" class="form-control" name="price" type="number" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="createProductCategory">Category</label>
                            <select id="createProductCategory" class="form-control" name="category_id" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="createProductStock">Stock Quantity</label>
                            <input type="number" class="form-control" id="createProductStock" name="stock_quantity" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="createProductDescription">Description</label>
                            <textarea class="form-control" id="createProductDescription" name="description" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="createProductSalePrice">Sale Price</label>
                            <input type="number" class="form-control" id="createProductSalePrice" name="discount_price" step="0.01">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="createProductStatus">Status</label>
                            <select id="createProductStatus" class="form-control" name="status" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="createProductSlug">Slug</label>
                            <input type="text" class="form-control" id="createProductSlug" name="slug" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="createProductWeight">Weight (kg)</label>
                            <input type="number" class="form-control" id="createProductWeight" name="weight" step="0.01" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="createProductDimensions">Dimensions (cm)</label>
                            <input type="text" class="form-control" id="createProductDimensions" name="dimensions" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="createProductOnSale">On Sale</label>
                            <input type="checkbox" class="form-check-input" id="createProductOnSale" name="on_sale">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="createProductImage">Product Image</label>
                            <input type="file" class="form-control" id="createProductImage" name="image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
