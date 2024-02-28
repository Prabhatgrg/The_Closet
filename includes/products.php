<?php
function get_products()
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM products");
    if ($stmt->execute()) :
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    else :
        $data['error'] = 'Something went wrong while fetching products.';
    endif;

    return $data;
}
