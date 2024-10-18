<?php

require 'login/connection.php'; // Include the connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if all necessary POST variables are set
    if (isset($_POST["username"], $_POST["useremail"], $_POST["userpass"], $_POST["usercpass"], $_POST["usercontact"])) {
        $username = $_POST["username"];
        $useremail = $_POST["useremail"];
        $password = $_POST["userpass"];
        $confirmpassword = $_POST["usercpass"];
        $contact = $_POST["usercontact"];

        // Check if the email already exists
        $sqlemail = "SELECT * FROM logins WHERE Email='$useremail'";
        $result = mysqli_query($connection, $sqlemail);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            echo "The email already exists";
        } else {
            if ($password == $confirmpassword) {
                $hashpasss = password_hash($password, PASSWORD_DEFAULT);

                $sqlinsert = "INSERT INTO `logins`(`Name`, `Email`, `Pass`, `Contect`) VALUES ('$username','$useremail','$hashpasss','$contact')";

                $resultins = mysqli_query($connection, $sqlinsert);
                if ($resultins) {
                    // Redirect to login.php after successful signup
                    header("Location: login.php");
                    exit(); // Make sure to call exit after header to stop further script execution
                } else {
                    echo "Error inserting data.";
                }
            } else {
                echo "Passwords do not match.";
            }
        }
    } else {
        echo "Please fill out all the fields.";
    }
}

// You should close the connection after all operations are done.

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
                    <h3 class="title">Sign In</h3>
                    <span class="create-account"><a href="login.php">Login</a></span>
                    <form class="form-horizontal clearfix" action="signup.php" method="post">
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
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="usercpass" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-phone"></i></span>
                            <input type="tel" name="usercontact" class="form-control" placeholder="Your Contact Number" required>
                        </div>

                        <button type="submit" class="btn btn-default"><i class="fa fa-arrow-right"></i> Sign In</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
