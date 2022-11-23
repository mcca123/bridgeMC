<?php 
    include('connection.php');

    $errors = array();

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;
        
        $row = $result->fetch_assoc();
       
        if($num_rows >= 1 && password_verify($password, $row['password'])){
            $_SESSION['userid'] = $row['id'];
            $_SESSION['userlevel'] = $row['userlevel'];
            header("Location: index.php");
            echo json_encode(array('message' => 'login successfully' ));
        } else {
            array_push($errors, "Wrong Username or Password");
            $_SESSION['error'] = "Wrong Username or Password!";
            header("location: login.php");
            echo json_encode(array('message' => 'Wrong Username or Password!' ));
            exit();
        }
    } else {
        array_push($errors, "Username & Password is required");
        $_SESSION['error'] = "Username & Password is required";
        header("location: login.php");
        http_response_code(405);
        exit();
    }
?>