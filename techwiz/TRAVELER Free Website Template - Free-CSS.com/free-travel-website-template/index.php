<?php
session_start();  // Start the session to store user data

$server = "localhost";
$user = "root"; // Update with your MySQL username
$pass = "";     // Update with your MySQL password
$database = "expense_voyage";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle the Signup Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userpass = $_POST['userpass'];
    $usercpass = $_POST['usercpass'];
    $usercontact = $_POST['usercontact'];

    if ($userpass !== $usercpass) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($userpass, PASSWORD_DEFAULT);

        // Check if the email is already taken
        $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $useremail);
        $checkEmail->execute();
        $result = $checkEmail->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, contact) VALUES (?,?, ?, ?)");
            $stmt->bind_param("ssss", $username, $useremail, $hashed_password, $usercontact);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "<script>alert('Error registering user.');</script>";
            }
        }
        $checkEmail->close();
    }
}

// Handle the Login Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $loginemail = $_POST['loginemail'];
    $loginpass = $_POST['loginpass'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $loginemail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($loginpass, $user['password'])) {
            // Store user details in session and redirect to welcome page
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            // Redirect to the navbar.html page
            header("Location: home.html");
            exit();
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('Email not registered!');</script>";
    }

    $stmt->close();
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> Login and Registration Form in HTML & CSS | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/Leonardo_Phoenix_A_solitary_commercial_airliner_with_a_silver_2 (2).jpg" alt="">
        <div class="text">
          <span class="text-1">Explore More, Spend Less <br> </span>
          <span class="text-2">Your Journey Begins with Expense Voyage</span>
        </div>
      </div>
    </div>

    <div class="forms">
      <div class="form-content">
        <!-- Login Form -->
        <div class="login-form">
          <div class="title">Login</div>
          <form method="POST" action="index.php">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="loginemail" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="loginpass" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="#">Forgot password</a></div>
              <div class="button input-box">
                <input type="submit" name="login" value="Submit">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
          </form>
        </div>

        <!-- Signup Form -->
        <div class="signup-form">
          <div class="title">Signup</div>
          <form method="POST" action="index.php">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="useremail" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="userpass" placeholder="Enter your password" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="usercpass" placeholder="Confirm your password" required>
              </div>
              <div class="input-box">
                <i class="fas fa-phone"></i>
                <input type="text" name="usercontact" placeholder="Enter your contact number" required>
              </div>
              <div class="button input-box">
                <input type="submit" name="signup" value="Signup">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
