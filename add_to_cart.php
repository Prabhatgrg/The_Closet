<?php
require_once "functions.php";
$user_id = get_user_id();

if (!is_login()) {
    echo '<script>alert("Please Login")</script>';
    header('Location: index.php');
}

if (isset($_GET['cart_qty'])) :
    $product_id = $_GET['product_id'];
    $qty = $_GET['cart_qty'];
    $price = $_GET['cart_price'];
    $total_price = floatval($price) * intval($qty);

    add_to_cart($product_id, $user_id, $qty, $price, $total_price);
endif;
