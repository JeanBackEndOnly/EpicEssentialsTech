<?php
    require_once 'EET_LoginSignup/session.php';
    require_once 'EET_LoginSignup/signup_view.php';
    require_once 'EET_LoginSignup/login_view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_Signup</title>
</head>
<body>
<?php
    if(!isset($_SESSION["user_id"])){ ?>
<div>
    <h1>LOGIN</h1>

    <form action="EET_LoginSignup/login.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="userpassword" placeholder="Userpassword">
        <button>Login</button>
    </form>
</div>
    <?php } ?>
    
    <?php
        check_login_errors();
    ?>

    <h1>Signup</h1>
    <form action="EET_LoginSignup/signup.php" method="post">
        <?php
            signup_inputs();
        ?>
        <button class="Signup_button">Signup</button>
    </form>
    
    <?php
        check_signup_errors();
    ?>

</body>
</html>