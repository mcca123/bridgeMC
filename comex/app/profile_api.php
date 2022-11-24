<?php 
    include('connection.php');

    $userid = $_SESSION['userid'];
    
    if(isset($_POST['update_profile'])){
        $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
        $userlevel = '1';    
    
        if(isset($_POST['userlevel'])){
       $userlevel = $_POST['userlevel'];
    }
    
    //prepared statement
    $stmt = $conn->prepare("UPDATE `user` SET email = ? , userlevel = ? WHERE id = '$userid'");
    $stmt->bind_param('ss', $update_email, $userlevel);
    $stmt->execute();
    $_SESSION['userlevel'] = $userlevel;
    header("Location: profile.php");
    echo json_encode(array('email' => $update_email , "userlevel" => $userlevel));
    exit();
    }

?>