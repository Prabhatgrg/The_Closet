<?php
function get_products()
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM products");
    if ($stmt->execute()) :
        $result = $stmt->get_result();

        if ($result->num_rows > 0) :
            $data = $result->fetch_all(MYSQLI_ASSOC);
        else :
            $data['error'] = 'There are no producsts.';
        endif;
    else :
        $data['error'] = 'Something went wrong while fetching products.';
    endif;

    return $data;
}

function get_cart_products()
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM cart");
    if ($stmt->execute()) :
        $result = $stmt->get_result();

        if ($result->num_rows > 0) :
            $data = $result->fetch_all(MYSQLI_ASSOC);
        else :
            $data['error'] = 'Your cart is empty.';
        endif;
    else :
        $data['error'] = 'Something went wrong while fetching products.';
    endif;

    return $data;
}

function get_product_by_id($product_id)
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('s', $product_id);
    if ($stmt->execute()) :
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
    else :
        $data['error'] = 'Something went wrong while fetching product.';
    endif;

    return $data;
}

function clear_cart()
{
    global $con;

    $user_id = get_user_id();

    if ($user_id == null) :
        header("Location: index.php");
    endif;

    $stmt = $con->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
}
