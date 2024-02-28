<?php
require 'header.php';

if($_SERVER['REQUEST_METHOD']=='POST'):
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];

    $message = user_auth($username, $password);
endif;
?>



<section class="col-12">
    <div class="container">
        <form method="POST" class="d-flex flex-column align-items-center">
            <div class="mb-3 w-50">
                <label for="user_name" class="form-label">User Name</label>
                <input type="text" name="user_name" class="form-control" id="user_name" aria-describedby="userName">
            </div>
            <div class="mb-3 w-50">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" name="user_password" class="form-control" id="user_password">
            </div>
            <p>
                Don't have an account yet? then <a href="login.php">click here.</a>
            </p>
            <button type="submit" class="btn btn-primary w-25">Login</button>
        </form>
    </div>
</section>