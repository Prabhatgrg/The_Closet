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

                ?>

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <img src="./uploads/<?php echo $product['product_image']; ?>" class="card-img-top" alt="<?php echo $product['product_title'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['product_title']; ?></h5>
                                <span class="fs-6 d-inline-block mb-3">Rs. <?php echo $product['product_price']; ?></span>

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
