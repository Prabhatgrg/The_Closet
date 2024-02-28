<?php

// Get User ID
function get_user_id()
{
    if (isset($_SESSION['user_id'])) :
        return $_SESSION['user_id'];
    endif;

    return null;
}

function is_login()
{
    if (isset($_SESSION['user_id'])) :
        return true;
    else :
        return false;
    endif;
}

function user_auth($username, $password){
    global $con;

    $message = [];
    
    $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    if($stmt->execute()):
        $result = $stmt->get_result();
        if($result->num_rows == 0):
            $message['usermsg'] = 'Username does not exists';
        else:
            $user = $result->fetch_array(MYSQLI_ASSOC);
            if($user['username'] == $username && password_verify($password, $user['password'])):
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['username'];
                header('Location: index.php' );
            else:
                $message['error'] = 'Incorrect username or password';
            endif;
        endif;
    endif;
    return $message;
}

function validate_user(string $fullname, string $username, string $password)
{
    global $con;

    $message = [];
    if (empty($fullname)) {
        $message['fullname'] = 'Full Name is empty';
    }
    if (empty($username)) {
        $message['username'] = 'Username is empty';
    } else {
        $stmt = $con->prepare('SELECT * FROM users WHERE username=?');
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $users = $result->fetch_array(MYSQLI_ASSOC);

        if (isset($users)) {
            $message['username'] = "Username Already Exists";
        }
    }
    if (empty($password)) {
        $message['password'] = "Password is empty";
    }
    return $message;
}

function register_user($fullname, $username, $password)
{
    global $con;
    $message = [];

    $stmt = $con->prepare("INSERT INTO users(fullname, username, password)VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $username, $password);

    if ($stmt->execute()) {
        $message['success'] = "User Registered Successfully";
        header('Location: ' .  'index.php');
    } else {
        $message['error'] = "Error Registering User";
    }
    $stmt->close();
    return $message;
}