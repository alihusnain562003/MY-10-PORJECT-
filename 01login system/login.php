
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'login/connection.php';

    $username = $_POST["username"];
    $useremail = $_POST["useremail"];
    $password = $_POST["userpass"];




    $sqlemail = "select * from logins where Email='$useremail'";

    $result = mysqli_query($connection, $sqlemail);

    $row = mysqli_num_rows($result);


    if ($row ==1) {
       

     while ($item = mysqli_fetch_assoc($result)) {
            
           password_verify($password,$item["Password"]);
           session_start();
           $_SESSION["login"]=true;
           $_SESSION["email"]=$useremail;
           $_SESSION["name"]=$username;
         header("location:loginwelcome.php");
        }

    } 
   
}


?>





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link rel="stylesheet" href="login.css">

</head>

<body>

<?php include "login/navbar.php"; ?>



<div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-container">
                    <div class="form-icon"><i class="fa fa-user"></i></div>
                    <h3 class="title">Login</h3>
                    <span class="create-account"><a href="signup.php">Create Account</a></span>
                    <form class="form-horizontal clearfix" action="login.php" method="post">
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-user"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="useremail" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="userpass" class="form-control" placeholder="Your Password" required>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-arrow-right"></i> login</button>
                        <span class="forgot"><a href="#">Forgot Password?</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
