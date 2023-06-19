<?php

session_start(); 
require_once("connect.php");

$username = $_SESSION['username'];
$taskName = $_POST['todo-title'];
$description = $_POST['todo-desc'];
$dueDate = $_POST['todo-due'];
$taskStatus = $_POST['status'];

// Retrieve the user_id from the database based on the username
$userID = null;
$query = "SELECT user_id FROM users WHERE username = '$username'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userID = $row['user_id'];
} else {
    echo "User not found.";
    exit();
}

$sql = "INSERT INTO tasks (user_id, task_name, deskripsi, due, task_status)
        VALUES ('$userID', '$taskName', '$description', '$dueDate', '$taskStatus')";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Task added successfully!');</script>";
    echo "<script>window.location.href = 'habitica-home.php';</script>";
} else {
    echo "Error: " . mysqli_error($con);
    echo "<script>window.location.href = 'habitica-home.php';</script>";
}

$con->close();
?>
