<?php
require 'header.php'; ?>



<section class="cart py-3">
    <div class="container">
        <div class="row">
            <?php if (is_login()) : ?>
                <div class="col-12 text-end">
                    <?php
                    $cart_products = get_cart_products();
                    if (!isset($cart_products['error'])) : ?>
                        <a href="clear_cart.php" class="btn btn-danger">Empty Cart</a>
                        <a href="orders.php" class="me-2 btn btn-danger">View my orders</a>
                </div>
            <?php endif; ?>
            <div class="col-12">
                <?php
                $cart_products = get_cart_products();
                if (!isset($cart_products['error'])) : ?>

                    <table class="table table-hover table-striped table-dark mt-2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($cart_products as $cart_product) :
                                $total = 0;
                                $total += $cart_product['total_price'];
                                $product = get_product_by_id($cart_product['product_id']);
                            ?>

                                <tr>
                                    <td><img style="width: 4rem; aspect-ratio: 1; object-fit-cover;" class="rounded-circle me-2" src="./uploads/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_title'] ?>"> <?php echo $product['product_title'] ?></td>
                                    <td><?php echo $product['product_code'] ?></td>
                                    <td><?php echo $cart_product['cart_qty'] ?></td>
                                    <td>Rs. <?php echo $cart_product['cart_price'] ?></td>
                                    <td>Rs. <?php echo $total ?></td>
                                    <td>
                                        <a href="remove_cart.php?cart_id=<?php echo $cart_product['cart_id'] ?>" class="btn-close btn-close-white" aria-label="Close">
                                            <span class="d-none">close</span>
                                        </a>
                                    </td>
                                    <!-- <td><a href="remove_cart.php?cart_id=<?php echo $cart_product['cart_id'] ?>" class="btn-close btn-close-white" aria-label="Close"><span class="d-none">close</span></a></td> -->
                                </tr>

                            <?php endforeach; ?>

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (NPR)</span>
                                <strong>Rs.<?php echo number_format($total, 2); ?></strong>
                            </li>

                            <form action="checkout.php" method="POST">

                            </form>

                        </tbody>

                    </table>

                <?php else : ?>
                    <p class="text-center">Your cart is empty.</p>
                <?php endif;
                ?>
            </div>
        <?php else : ?>
            <p class="text-center">Login to shop</p>
        <?php endif; ?>
        </div>
    </div>
</section>