<?php
require 'header.php';

if($_SERVER['REQUEST_METHOD']=='POST'):
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_code = $_POST['product_code'];
    $product_image = $_FILES['product_image'];
endif;
?>

<section class="add_product">
    <div class="container">
        <h2>Enter Product Detail</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" class="form-control" id="product_title" aria-describedby="productTitle">
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="product_price">
            </div>
            <div class="mb-3">
                <label for="product_code" class="form-label">Product Code</label>
                <input type="text" class="form-control" id="product_code">
            </div>
            <div class="mb-3">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" name="product_image[]" class="form-file" id="product_image" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</section>

<?php 
require 'footer.php';
?>