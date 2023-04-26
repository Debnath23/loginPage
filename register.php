<?php

@include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);


$select = "SELECT * FROM user_db WHERE email = '$email' && password = '$pass' ";

$result = mysqli_query($conn,$select);

if(mysqli_num_rows($result) > 0){
    $error[] = 'user already exist!';
}else{
    $insert = "INSERT INTO user_db(username, email, password) VALUES('$name','$email','$pass')";
    mysqli_query($conn,$insert);
    header('location:login.php');
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
    <title>Register</title>
</head>
<body>
        <div class="from-box-register">
            <h2>Registration</h2>
            <form action="" method="post">
                <?php

                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg>'.$error.'</span>';
                    };
                };

                ?>
                <div class="input-box">
                    <input type="text" name="name" required >
                    <label for="username">Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required >
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required >
                    <label for="password">Password</label>
                </div>
                <div class="remember-forgot">
                    <label for="checkbox"><input type="checkbox">I agree to the terms & conditions</label>
                </div>
                <button type="submit" name="submit" class="button-loin-form">Register</button>
                <div class="login-register">
                    <p>Allready have an account? <a href="login.php" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>