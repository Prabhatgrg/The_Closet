<?php
define('DB_NAME', 'the_closet');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

function open_con()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    //Check Connection
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
    return $conn;
}

function close_con($conn)
{
    $conn->close();
}