<?php
session_start();
require_once('connect.php');

// Retrieve the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the user with the same email already exists
$checkQuery = "SELECT * FROM users WHERE email = '$email'";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo "<script>alert('User with the same email already exists. Please login.');</script>";
    echo "<script>window.location.href = 'habitica.html';</script>";
    exit();
} else {
    $sql = "INSERT INTO users (username, email, user_password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('You are successfully signed up. Please login.');</script>";
        echo "<script>window.location.href = 'habitica.html';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        exit();
    }
}

mysqli_close($con);
?>
