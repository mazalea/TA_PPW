<?php
session_start();
require_once('connect.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the form data
$username = $_POST['username-lg'];
$email = $_POST['email-lg'];
$password = $_POST['password-lg'];

// Check if the user with the same email already exists
$checkQuery = "SELECT * FROM users WHERE email = '$email' AND user_password='$password'";
$checkResult = mysqli_query($con, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    $userRow = mysqli_fetch_assoc($checkResult);
    $loggedInUsername = $userRow['username'];

    // Store the username in the session
    $_SESSION["username"] = $loggedInUsername;

    echo "<script>alert('You are successfully logged in.');</script>";
    echo "<script>window.location.href = 'habitica-home.php';</script>";

} else {
    echo "<script>alert('Invalid email or password.');</script>";
    echo "<script>window.location.href = 'habitica.html';</script>";
    exit();
}
?>