        <!-- Edit product Modal Start -->
        <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">image:</label>
                    <input type="file" name="product_thumb" accept="image/png, image/jpg, image/jpge, image/gif" />
                 
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Product Title:</label>
                    <input type="text"  class="form-control" name="product-title" value="<?php echo $edit_product['product_title'] ?>" id="recipient-name">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description:</label>
                    <textarea class="form-control" name="product-description" id="message-text"><?php echo $edit_product['product_description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Price:</label>
                    <input type="text" class="form-control" name="product-price" value="<?php echo $edit_product['product_price'] ?>" id="recipient-name">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="update_product" data-bs-dismiss="modal">Save</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- Edit Product Modal End -->