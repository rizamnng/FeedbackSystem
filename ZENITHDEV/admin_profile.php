<?php
session_start();

	include("connect.php");
	include("functions.php");

	$user_data = check_admin_login($link);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" href="css/officeprofile_style.css">
    <title>PROFILE</title>

  </head>
  <body>

		 <a class="home"  href="admin_home.php">HOME </a><br><br>
     <?php
       $email= $user_data['email'];
       $contact_number = $user_data['contact_number'];
 			$username= $user_data['username'];
      ?>
 		 <div class="information">
        <img src="image/clientprofile.png"  height="100" width="100"> <br>
        <h3>ADMIN</h3>
 			 <p>
 				 <?php echo 'username: '; echo $username; ?><br><br>
          <?php echo $email; ?><br>
          <?php echo $contact_number; ?><br>
  	    </p> <br>

  	    <a class="edit" href="edit_adminInformation.php" ><button type="button" >EDIT INFORMATION</button></a> <br><br>
 			<a class="edit" href="admin_changepassword.php"><button type="button" >CHANGE PASSWORD</button></a> <br><br>


 		 </div>
 		 <br>

  </body>
</html>
