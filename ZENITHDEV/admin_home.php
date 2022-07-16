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
		<link rel="stylesheet" href="css/admin_home_style.css">
    <title>ADMIN</title>
  </head>
  <body>
		<header>
			<nav>
				<a class="logout" href="logout.php">LOGOUT</a>
				<a class="profile2" href="admin_profile.php"><img class="profile" src="image/clientprofile.png" height="80" width="80"></a>
			</nav>
		</header>
		<h1>DIGITALIZED FEEDBACK SYSTEM</h1>
		<h2>ADMIN</h2> <br> <br>
		<h3>CLICK THE ICON TO:</h3> <br>

		<div class="container">
			<div class="box">
				<a href="post_announcement.php">
					<img src="image/post.jpg" alt="">
				</a>
				<p>POST <br> ANNOUNCEMENT <br> </p>
			</div>
				<div class="box">
					<a href="admin_resetrequest.php">
						<img src="image/notification.png" alt="">
					</a>
					<p>SEE RESET <br> REQUEST <br> </p>
				</div>
			<div class="box">
				<a href="clients_information.php">
					<img src="image/clientinfo.jpg" alt="">
				</a>
				<p>SEE CLIENT <br> INFORMATION </p>
			</div>
			<div class="box">
				<a href="admin_clientsfeedback.php">
					<img src="image/clientfeedback.png" alt="">
				</a>
				<p>SEE CLIENT'S <br> FEEDBACK  </p>
			</div>

		</div>


  </body>
</html>
