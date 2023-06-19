<?php
session_start();
require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reminder_name'])) {
    // Retrieve the reminder name from the URL parameter
    $reminderName = $_GET['reminder_name'];

    $sql = "DELETE FROM reminders WHERE reminder_name = '$reminderName'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Reminder deleted successfully!');</script>";
        echo "<script>window.location.href = 'tasklist.php';</script>";
        exit;
    } else {
        echo "Error deleting reminder: " . $con->error;
    }
}

$con->close();
?>
