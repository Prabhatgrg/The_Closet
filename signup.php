<?php
require 'header.php';

if($_SERVER['REQUEST_METHOD']=='POST'):
    $fullname = $_POST['full_name'];
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];
    $validate = validate_user($fullname, $username, $password);
    if(count($validate) == 0):
        $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $msg = register_user($fullname, $username, $password);
    endif;
endif;
?>

<?php if (isset($msg['success'])) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $msg['success']; ?>
    </div>
<?php endif; ?>

<?php if (isset($msg['error'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $msg['error']; ?>
    </div>
<?php endif; ?>

<section class="col-12">
    <div class="container">
        <form method="POST" class="d-flex flex-column align-items-center">
            <div class="mb-3 w-50">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" id="full_name">
            </div>
            <div class="mb-3 w-50">
                <label for="user_name" class="form-label">User Name</label>
                <input type="text" name="user_name" class="form-control" id="user_name" aria-describedby="userName">
            </div>
            <div class="mb-3 w-50">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" name="user_password" class="form-control" id="user_password">
            </div>
            <p>
                Already have an account? then <a href="login.php">click here.</a>
            </p>
            <button type="submit" class="btn btn-primary w-25">Login</button>
        </form>
    </div>
</section>