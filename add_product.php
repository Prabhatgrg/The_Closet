<?php
require 'header.php';
?>

<section class="add_product">
    <div class="container">
        <h2>Enter Product Detail</h2>
        <form>
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
            <label for="product_image" class="form-label">Product Code</label>
                <input type="file" class="form-control" id="product_image">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</section>