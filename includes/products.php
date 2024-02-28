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
    $stmt->bind_param('i', $product_id);
    if ($stmt->execute()) :
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    else :
        $data['error'] = 'Something went wrong while fetching product.';
    endif;

    return $data;
}

function add_product($product_title, $product_price, $product_code, $product_image){
    global $con;

    $message = [];
    $post_id = rand(time(), 10000000);

    $file_array = reorganize_files_array($post_image_upload);

    $file_data = move_uploaded_post_images($file_array);

    $stmt = $con->prepare("INSERT INTO TABLE products(product_id, product_title, product_price, product_code, product_iamge)VALUES(?, ?, ?, ?, ?)");
    $stmt->bind_param()
}
