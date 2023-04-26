<?php
error_reporting(0);

@include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);


$select = "SELECT email,password FROM user_db WHERE email = '{$email}' AND password = '{$pass}' ";

$result = mysqli_query($conn,$select) or die("Query Failed.");

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION["email"] = $row['email'];
        $_SESSION["password"] = $row['password'];
    }

    header('location:user.php');
    
}else{
    //$error[] = 'Incorrect email or password';
    echo '<div class="alert alert-danger>Email and Password are not matched.</div>';
}
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
        <div class="from-box-login">
            <h2>Login</h2>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

            <?php
            if(isset($error)){
            foreach($error as $error){
            echo '<span class="error-msg>'.$error.'</span>';
             };
            };
          ?>
                <div class="input-box">
                    <input type="email" name="email"required >
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required >
                    <label for="password">Password</label>
                </div>
                <div class="remember-forgot">
                    <label for="checkbox"><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" name="submit" class="button-loin-form">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="register.php" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
</body>
</html>