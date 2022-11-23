<?php 
    session_start();
    // error_reporting(0);
    $conn = mysqli_connect("localhost", "masterDB", "IRkrgnBtdfgPdGx2", "loginadminuser");

    if (!$conn) {
        echo("i'm dead");
        die("Failed to connec to databse " . mysqli_error($conn));
    }

?>