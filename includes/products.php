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

function move_uploaded_post_images($file_array)
{
    $file_data_array = array(); // Array to store file data

    foreach ($file_array as $file) {
        // File details
        $file_name = rand(1000, 10000) . '-' . $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_type = $file['type'];

        // Move uploaded file to desired location (optional)
        $upload_dir = "frontend/uploads/";
        $file_path = $upload_dir . $file_name;
        move_uploaded_file($file_tmp, $file_path);

        // Store file details in array
        $file_data = array("name" => $file_name, "path" => $file_path);
        $file_data_array[] = $file_data;
    }

    // Encode file data array as JSON
    return $json_file_data = json_encode($file_data_array);
}

function reorganize_files_array($files)
{
    $file_array = array();
    $file_count = count($files['name']);
    $file_keys = array_keys($files);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_array[$i][$key] = $files[$key][$i];
        }
    }

    return $file_array;
}

function add_product($product_title, $product_price, $product_code, $product_image){
    global $con;

    $message = [];

    $pname = rand(1000, 10000) . '-' . $product_image['name'];
    $tname = $product_image['tmp_name'];
    $upload_dir = 'uploads';
    move_uploaded_file($tname, $upload_dir . $pname);

    $stmt = $con->prepare("INSERT INTO products(product_title, product_price, product_code, product_image)VALUES(?, ?, ?, ?)");
    $stmt->bind_param("siss",$product_title, $product_price, $product_code, $product_image);
    if($stmt->execute()):
        $message['success'] = 'Product Added Successfully';
    else:
        $message['error'] = 'Error Adding Product';

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
