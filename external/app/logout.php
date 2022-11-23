<?php 
    include 'connection.php';
    session_destroy();
    header("Location: login.php");
    echo json_encode(array('message' => 'logout successfully' ));

?>