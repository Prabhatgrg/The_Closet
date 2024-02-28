<?php
require 'header.php'; ?>

<section class="cart py-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-end">
                <a href="clear_cart.php" class="btn btn-danger">Empty Cart</a>
                <a href="orders.php" class="me-2 btn btn-danger">View my orders</a>
            </div>
            <div class="col-12">
                <?php
                $cart_products = get_cart_products();
                if (!isset($cart_products['error'])) : ?>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Quantity</th>
                                <th>Unit price</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($cart_products as $cart_product) :
                                $product = get_product_by_id($cart_product['product_id']);
                            ?>

                                <tr>
                                    <td><img style="width: 4rem; aspect-ratio: 1; object-fit-cover;" class="rounded-circle me-2" src="./uploads/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_title'] ?>"> <?php echo $product['product_title'] ?></td>
                                    <td><?php echo $product['product_code'] ?></td>
                                    <td><?php echo $cart_product['cart_qty'] ?></td>
                                    <td><?php echo $cart_product['cart_price'] ?></td>
                                    <td><?php echo $cart_product['total_price'] ?></td>
                                    <td><a href="remove_cart.php?cart_id=<?php echo $cart_product['cart_id'] ?>" class="btn-close" aria-label="Close"><span class="d-none">close</span></a></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                <?php else : ?>
                    <p class="text-center">Your cart is empty.</p>
                <?php endif;
                ?>
            </div>
        </div>
    </div>
</section>

<hr>

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
