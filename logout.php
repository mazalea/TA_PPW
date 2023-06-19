<?php
session_start();
$_SESSION = array(); // Clear all session variables
session_destroy();

echo "<script>alert('You are successfully logged out');</script>";
echo "<script>window.location.href = 'habitica.html';</script>";
?>