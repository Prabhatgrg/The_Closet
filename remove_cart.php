<?php
require_once "functions.php";

if (isset($_GET['cart_id'])) :
    remove_cart($_GET['cart_id']);
endif;
