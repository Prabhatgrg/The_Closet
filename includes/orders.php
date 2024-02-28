<?php 

function get_orders() {
    global $con;

    $stmt = $con->prepare("SELECT * FROM order_product");
    if($stmt->execute()):
        $result = $stmt->get_result();

        if($result->num_rows>0): 
            $data = $result->fetch_all(MYSQLI_ASSOC);
        else:
            $data['error'] = 'There are no order lists.';
        endif;
    else:
        $data['error'] = 'Error fetching order data';
    endif;
    return $data;
}

function get_order_by_id($order_id){
    global $con;
    
    $stmt = $con->prepare("SELECT * FROM order_products WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    if($stmt->execute()):
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
    else:
        $data['error'] = 'Error fetching order_id';
    endif;

    return $data;
}

?>