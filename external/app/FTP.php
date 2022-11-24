<?php 
    include('connection.php');

    if ($_SESSION['userlevel'] != '0') {
      header("Location: index.php");
      exit();
    }
    else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>
   <link rel="stylesheet" href="css/email.css">

</head>
<body>
   
<div class="update-profile">

   <form action="" method="post">
      <div class="flex">
         <div class="inputBox">
            <span>Server :</span>
            <input type="text" name="FTP_server" value="localhost" class="box">
            <span>Username :</span>
            <input type="text" name="FTP_name" value="master-mc" class="box">
            <span>Password :</span>
            <input type="password" name="FTP_password" value="P@ssw0rd" class="box">
         </div>
      </div>
      <input type="submit" value="Test Connect FTP" name="update_profile" class="btn">
      <a href="index.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>

<?php } ?>