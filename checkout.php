<?php
require 'header.php';
?>

<section class="checkout">
    <div class="container">
        <form method="POST" action="https://www.sandbox.paypal.com/cgi-bin/webscr" enctype="multipart/form-data">
            <div class="col-md-8">
                <div class="mb-3">
                    Your Products:
                </div>
                <ul class="list-group mb-4">
                    <?php
                    $grand_total = 0;
                    $cart_products = get_cart_products();
                    if (!isset($cart_products['error'])) :
                        $index = 1;
                        foreach ($cart_products as $cart_product) :
                            // $total = 0;
                            $price = $cart_product['cart_price'] * $cart_product['cart_qty'];
                            $grand_total += $price;

                            $product = get_product_by_id($cart_product['product_id']);
                    ?>

                            <li class="list-group-item d-flex justify-content-between list-item">
                                <span><?php echo $product['product_title']; ?></span>
                                <span>
                                    <span><?php echo $cart_product['cart_qty']; ?></span>
                                    <span><?php echo $cart_product['cart_price']; ?></span>
                                </span>
                                <strong>$ <?php echo $price; ?></strong>

                                <!-- Include hidden input fields for each item -->
                                <input type="hidden" name="item_name_<?php echo $index; ?>" value="<?php echo $product['product_title']; ?>">
                                <input type="hidden" name="item_number_<?php echo $index; ?>" value="<?php echo $product['product_id']; ?>">
                                <input type="hidden" name="amount_<?php echo $index; ?>" value="<?php echo $cart_product['cart_price']; ?>">
                                <input type="hidden" name="quantity_<?php echo $index; ?>" value="<?php echo $cart_product['cart_qty']; ?>">
                            </li>
                    <?php
                            $index++;
                        endforeach;

                    endif;


                    ?>
                    <li class="list-group-item d-flex justify-content-between list-item-total">
                        <h5>Total Price: </h5>
                        <h5>$ <?php echo $grand_total; ?></h5>

                        <!-- PayPal form fields -->
                        <input type="hidden" name="business" value="sb-yzu3x29802408@business.example.com">
                        <input type="hidden" name="cmd" value="_cart">
                        <input type="hidden" name="upload" value="1">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="return" value="http://localhost/The_Closet/success.php">
                        <input type="hidden" name="cancel_return" value="http://localhost/The_Closet/cancel.php">

                        <!-- Include the total price as a hidden input field -->
                        <input type="hidden" name="total_price" value="<?php echo $grand_total; ?>">

                        <!-- Submit button -->
                        <button class="btn btn-success" type="submit" name="paypal_checkout">
                            Checkout with PayPal
                        </button>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</section>