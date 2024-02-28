<?php
require "functions.php";
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
                        <button type="button" class="btn btn-light">
                            <li><a href="index.php" class="text-decoration-none">Home</a></li>
                        </button>
                        <?php if (!is_login()) : ?>
                            <button type="button" class="btn btn-primary">
                                <li><a href="login.php" class="text-decoration-none text-white">Login</a></li>
                            </button>
                            <button type="button" class="btn btn-primary">
                                <li><a href="signup.php" class="text-decoration-none text-white">Sign Up</a></li>
                            </button>
                        <?php endif; ?>
                        <?php if (is_login()) : ?>
                            <button type="button" class="btn btn-light">
                                <li><a href="add_product.php" class="text-decoration-none">Add Product</a></li>
                            </button>
                            <button type="button" class="btn btn-danger">
                                <li><a href="logout.php" class="text-decoration-none text-white">Logout</a></li>
                            </button>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </header>
    <hr>