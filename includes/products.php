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
            $data['error'] = 'There are no products.';
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

function add_product($product_title, $product_price, $product_code, $product_image){
    global $con;

    $message = [];

    $pname = rand(1000, 10000) . '-' . $product_image['name'];
    $tname = $product_image['tmp_name'];
    $upload_dir = 'uploads/';
    move_uploaded_file($tname, $upload_dir . $pname);

    $stmt = $con->prepare("INSERT INTO products(product_title, product_price, product_code, product_image)VALUES(?, ?, ?, ?)");
    $stmt->bind_param("siss",$product_title, $product_price, $product_code, $pname);
    if($stmt->execute()):
        $message['success'] = 'Product Added Successfully';
    else:
        $message['error'] = 'Error Adding Product';
    endif;
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
