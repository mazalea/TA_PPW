<?php
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "db_uas_todos_dummy";

    $con = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>