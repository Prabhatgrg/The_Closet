<?php
require 'header.php';
?>

<section class="checkout">
    <div class="container">
        <form action="">
            <div class="col-md-8">
                <div class="mb-3">
                    Your Products:
                </div>
                <ul class="list-group mb-4">
                    <?php
                    $grand_total = 0;
                    $cart_products = get_cart_products();
                    if (!isset($cart_products['error'])) :

                        foreach ($cart_products as $cart_product) :
                            $total = 0;
                            $price = $cart_product['cart_price'] * $cart_product['cart_qty'];
                            $total += $price;
                            $grand_total += $total;

                            $product = get_product_by_id($cart_product['product_id']);
                    ?>

                            <li class="list-group-item d-flex justify-content-between list-item">
                                <span><?php echo $product['product_title']; ?></span>
                                <span>
                                    <span><?php echo $cart_product['cart_qty']; ?></span>
                                    <span><?php echo $cart_product['cart_price']; ?></span>
                                </span>
                                <strong>Rs <?php echo $total; ?></strong>
                            </li>



                    <?php
                        endforeach;

                    endif;


                    ?>
                    <li class="list-group-item d-flex justify-content-between list-item-total">
                        <h5>Total Price: </h5>
                        <h5>Rs. <?php echo $grand_total; ?></h5>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</section>