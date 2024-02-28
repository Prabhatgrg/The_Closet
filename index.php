<?php
require 'header.php'; ?>

<section class="cart">
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
                                    <td><img class="rounded-circle" src="" alt=""> <?php echo $product['title'] ?></td>
                                    <td><?php echo $product['code'] ?></td>
                                    <td><?php echo $cart_product['cart_qty'] ?></td>
                                    <td><?php echo $cart_product['price'] ?></td>
                                    <td><?php echo $cart_product['total_price'] ?></td>
                                    <td><a href="?remove=<?php echo $cart_product['id'] ?>" class="btn-close" aria-label="Close"><span class="d-none">close</span></a></td>
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

<section class="products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Products</h2>
            </div>

            <?php
            $cart_products = get_cart_products();
            if (!isset($cart_products['error'])) : ?>

                <?php foreach ($cart_products as $cart_product) :
                    $product = get_product_by_id($cart_product['product_id']);
                ?>

                    <div class="col-md-6 col-lg-3">

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
