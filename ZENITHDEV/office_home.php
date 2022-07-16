<?php
session_start();

	include("connect.php");
	include("functions.php");

	$user_data = check_office_login($link);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/officehome_style.css">
    <title>Office Portal</title>
  </head>
  <body>

    <header>

			<nav>
				<a class='logout' href="logout.php" id="out">LOGOUT</a>
				<a class='profile2' href="office_profile.php"><img class='profile'  src="image/clientprofile.png" alt=""  ></a>
			</nav>

    </header>
		<div class="content">
			<h2>Welcome</h2>
			<h1>College of Engineering</h1>
			<br><br><br>
			<img src="image/box.png" alt="" id="pic">
			<h3>Feedbacks</h3>
			<p>Would you like to read some of the feedback? </p>
			<a class='button' href="feedbacks.php">VIEW NOW</a>
		</div>

  </body>
</html>
