<?php
require "functions.php";

$con = open_con();
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Closet</title>
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <header class="bg-gray pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-5">

                    <h1 class="fs-5 mb-0">
                        Name :
                    </h1>
                    <strong>Roll No. :</strong>
                </div>
                <div class="col-md-7">
                    <ul class="list-unstyled d-flex justify-content-end gap-4">
                        <li><a href="add_product.php">Add Product</a></li>
                        <li><a href="cart.php">Cart</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </header>
    <hr>