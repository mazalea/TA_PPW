<?php

session_start(); 
require_once("connect.php");

$title = $_POST['rem-title'];
$startDate = $_POST['rem-startdt'];
$endDate = $_POST['rem-enddt'];
$startTime = $_POST['rem-starttm'];

$sql = "INSERT INTO reminders (reminder_name, start_date, end_date, start_time) 
VALUES ('$title', '$startDate', '$endDate', '$startTime')";

if ($con->query($sql) === TRUE) {
    echo "<script>alert('Reminder added successfully!');</script>";
    echo "<script>window.location.href = 'habitica-home.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
    echo "<script>window.location.href = 'habitica-home.php';</script>";
}

$con->close();
?>
<?php
