<?php
session_start();

	include("connect.php");
	include("functions.php");

	$user_data = check_login($link);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" href="css/clientprofile.css">
    <title>PROFILE</title>

  </head>
  <body>
		<div class="top">
			<a class='home' href="clienthome.php">HOME</a><br>
		</div>

    <?php
      $fname= $user_data['firstname'];
      $lname= $user_data['lastname'];
      $gender= $user_data['gender'];
      $email= $user_data['email'];
      $contact_number = $user_data['contact_number'];
			$username= $user_data['username'];
     ?>
    <div class="row items">
	    <div class="column left first">
		    <img src="image/officehomeprofile.png" alt=""> <br>
		    <h2>CLIENT</h2>

	    </div>

		  <div class="column right second"><br>
		    <h2>MY PROFILE</h2> <br>
				<p>
		    Name:  <?php echo $fname ; echo " "; echo $lname; ?> <br>
				Gender: <?php echo $gender; ?> <br>
				Email: <?php echo $email; ?><br>
				 Number:<?php echo $contact_number; ?> <br>
				Username: <?php echo $username; ?> <br>
				</p> <br>
				<br>
				<div class="buttons">
					<a class="button" href="editClientProfile.php"><button type="button" name="button">EDIT INFORMATION </button></a>
					<a class="button" href="changepassword.php"> <button class='button2' type="button" name="button">CHANGE PASSWORD </button></a>
				</div>

		  </div>

	  </div>



  </body>
</html>
