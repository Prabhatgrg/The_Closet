<?php
require 'header.php'; ?>

<section class="products py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Products</h2>
            </div>

            <?php
            $products = get_products();
            if (!isset($products['error'])) : ?>

                <?php foreach ($products as $product) :
                    $is_wishlisted = is_wishlisted($product['product_id']) ? 'false' : 'true';
                ?>

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <img src="./uploads/<?php echo $product['product_image']; ?>" class="card-img-top" alt="<?php echo $product['product_title'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['product_title']; ?></h5>
                                <span class="fs-6 d-inline-block mb-3">Rs. <?php echo $product['product_price']; ?></span>

                                <a href="post?id=<?php echo urlencode($product['product_id']); ?>&wishlist=<?php echo urlencode($is_wishlisted); ?>" <?php echo is_wishlisted($product['product_id']) ? 'class="saved"' : null; ?> aria-label="wishlist link">
                                    <svg width="50" height="20" viewBox="0 0 125 185" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 175V5H120V175L61 138L5 175Z" stroke="black" stroke-width="10" />
                                    </svg>
                                </a>

                                <form action="add_to_cart.php">
                                    <input type="hidden" name="cart_price" value="<?php echo $product['product_price']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <div class="d-flex">
                                        <input class="form-control" type="number" name="cart_qty" min='1' max='10' value="1">
                                        <button class="btn btn-primary ms-3 flex-shrink-0 " type="submit">Add to cart</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>


            <?php else : ?>
                <p class="text-center">There are no products.</p>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php
require 'footer.php';
