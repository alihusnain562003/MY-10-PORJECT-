<?php

// Database connection parameters
$server = "localhost";
$username = "root";
$password = ""; // Changed from $pass to $password for clarity
$db = "myloginsystem";

// Create connection
$connection = mysqli_connect($server, $username, $password);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sqldb = "CREATE DATABASE IF NOT EXISTS myloginsystem";
if (!mysqli_query($connection, $sqldb)) {
    die("Error creating database: " . mysqli_error($connection));
}

// Select the database
mysqli_select_db($connection, $db);

// Create table if it doesn't exist
$sqltbl = "CREATE TABLE IF NOT EXISTS logins (
    Id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Contact VARCHAR(255)
)";

if (!mysqli_query($connection, $sqltbl)) {
    die("Error creating table: " . mysqli_error($connection));
}

// Close the connection


echo "Database and table created successfully.";

?>
