<?php
session_start();


if (!isset($_SESSION["login"]) || $_SESSION["login"] != true) {


    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="loginwell.css">
</head>

<body>
    <div class="welcome-container">
        <div class="welcome-content">
            <h1 class="welcome-text">Welcome to Our Website!</h1>
            <p class="sub-text">We are glad to have you here. Let's get started!</p>
            <button class="explore-btn" id="exploreBtn">Explore Now</button>
        </div>
        <div class="animation-bg"></div>
    </div>

    <script src="script.js"></script>
</body>

</html>

