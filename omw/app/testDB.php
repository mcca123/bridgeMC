<?php 
    // session_start();
    // error_reporting(0);
    $conn = mysql_connect("localhost", "root", "", "loginadminuser");

    if (!$conn) {
        die("Failed to connec to databse " . mysqli_error($conn));
        echo("i'm dead");
    }
    echo "Connected successfully";

?>