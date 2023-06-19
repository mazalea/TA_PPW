<?php
session_start();
require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['task_name'])) {
    // Retrieve the task name from the URL parameter
    $taskName = $_GET['task_name'];

    // Delete the task from the database
    $sql = "DELETE FROM tasks WHERE task_name = '$taskName'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Task deleted successfully!');</script>";
        echo "<script>window.location.href = 'tasklist.php';</script>";
        exit;
    } else {
        echo "Error deleting task: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>
