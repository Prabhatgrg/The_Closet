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
                    global $con;
                    $stmt = $con->prepare("SELECT * FROM cart");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = 0;
                    if ($result->num_rows > 0) :
                        $index = 1;
                        while ($data = $result->fetch_all(MYSQLI_ASSOC)) {
                            $price = $data['cart_price'] * $data['cart_qty'];
                            $total += $price;
                            $product_title = get_product_by_id($data['product_id']);
                    ?>

                            <li class="list-group-item d-flex justify-content-between list-item">
                                <span><?php echo $product_title ?></span>
                                <span>
                                    <span><?php echo $data['cart_qty']; ?></span>
                                    <span><?php echo $data['cart_price']; ?></span>
                                </span>
                                <strong>Rs <?php echo $total; ?></strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between list-item-total">
                                <h5>Total Price: </h5>
                                <h5>$<?php echo $totalPrice; ?></h5>
                            </li>

                    <?php $index++;
                        }
                    endif;

                    ?>
                    ?>
                </ul>
            </div>
        </form>
    </div>
</section>