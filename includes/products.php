<?php

if (isset($_GET['bookmark'])) :
    switch ($_GET['bookmark']):
        case 'true':
            $wishlist_message = wishlist($_GET['product_id'], $_SESSION['user_id']);
            echo '<script>alert("This post is saved.");document.location.href = "post?id=' . urlencode($_GET['product_id']) . '"</script>';
            break;
        case 'false':
            $wishlist_message = remove_wishlist($produc_id, $_SESSION['user_id']);
            echo '<script>alert("The saved post is removed.");document.location.href = "post?id=' . urlencode($_GET['product_id']) . '"</script>';
            break;
        default:
            break;
    endswitch;

endif;

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

    $user_id = get_user_id();

    if ($user_id == null) {
        return $data['error'] = 'Something went wrong while fetching products.';
    }

    $stmt = $con->prepare("SELECT * FROM cart where user_id = ?");
    $stmt->bind_param('i', $user_id);
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

function add_product($product_title, $product_price, $product_code, $product_image)
{
    global $con;

    $message = [];

    $pname = rand(1000, 10000) . '-' . $product_image['name'];
    $tname = $product_image['tmp_name'];
    $upload_dir = 'uploads/';
    move_uploaded_file($tname, $upload_dir . $pname);

    $stmt = $con->prepare("INSERT INTO products(product_title, product_price, product_code, product_image)VALUES(?, ?, ?, ?)");
    $stmt->bind_param("siss", $product_title, $product_price, $product_code, $pname);
    if ($stmt->execute()) :
        $message['success'] = 'Product Added Successfully';
    else :
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

function add_to_cart($product_id, $user_id, $qty, $price, $total_price)
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) :
        $data = $result->fetch_array(MYSQLI_ASSOC);

        $qty += $data['cart_qty'];
        $total_price += $data['total_price'];


        $cart = $con->prepare("UPDATE cart SET cart_qty = ? ,total_price = ? WHERE cart_id = ?");
        $cart->bind_param("isi",  $qty, $total_price, $data['cart_id']);
        if ($cart->execute()) :
            echo '<script>alert("Product added to cart successfully.")</script>';
        else :
            echo '<script>alert("There is some issue to add product.")</script>';
        endif;
        header("Location: index.php");

    else :

        $cart = $con->prepare("INSERT INTO cart(product_id, user_id, cart_qty, cart_price, total_price)VALUES(?,?, ?, ?, ?)");
        $cart->bind_param("iiiis", $product_id, $user_id, $qty, $price, $total_price);
        if ($cart->execute()) :
            echo '<script>alert("Product added to cart successfully.")</script>';
        else :
            echo '<script>alert("There is some issue to add product.")</script>';
        endif;
        header("Location: index.php");
    endif;
}

function remove_cart($cart_id)
{
    global $con;


    $cart = $con->prepare("DELETE FROM cart WHERE cart_id = ?");
    $cart->bind_param("i", $cart_id);
    if ($cart->execute()) :
        echo '<script>alert("Product removed from cart.")</script>';
    else :
        echo '<script>alert("There is some issue to remove product.")</script>';
    endif;
    header("Location: index.php");
}

function check_cart() {
    global $con;

    $stmt = $con->prepare("SELECT * FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    if($stmt->execute()):
        return true;
    endif;
}

// function to check if post is booked or not
function is_wishlisted($product_id, $user_id)
{
    global $con;

    $stmt = $con->prepare("SELECT * FROM wishlist WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param('ii', $product_id, $user_);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
        return true;
    return false;
}

function wishlist($product_id){
    global $con;

    $message = [];
    $is_wishlisted = is_wishlisted($product_id, $_SESSION['user_id']);

    if($is_wishlisted):
        $message['error'] = 'The product is already on your wishlist';
    else:
        $stmt = $con->prepare("INSERT INTO wishlist(user_id, product_id) VALUES(?, ?)");
        $stmt->bind_param("ii", $product_id, $_SESSION['user_id']);
        $message['error'] = 'There is an error wishlisting the product';
    endif;

    return $message;
}

function remove_wishlist($product_id)
{
    global $conn;

    $message = [];

    $is_wishlisted = is_wishlisted($product_id, $_SESSION['user_id']);

    if (!$is_wishlisted) {
        $message['error'] = "This post is already not saved.";
        return $message;
    }

    $stmt = $conn->prepare("DELETE FROM wislist WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param('ii', $product_id, $_SESSION['user_id']);
    if ($stmt->execute()) :
        $message['success'] = 'The post is successfully removed from saved list.';
    else :
        $message['error'] = 'There is an error while removing the saved post. Please try again later.';
    endif;
}