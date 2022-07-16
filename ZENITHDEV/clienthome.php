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
    <title>Office Home Page</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/clienthome_style.css">
  </head>
  <body>
      <header>
				<a class='logout' href="logout.php" id="out">LOGOUT</a>
				<h2>

				</h2>
          <nav>
            <a href="clientProfile.php">
              <img class='profile' src="image/clientprofile.png" alt="" id="log">
            </a>
						<p class='name'><?php
							echo strtoupper($user_data['firstname']) ;
							echo " ";
							echo strtoupper($user_data['lastname']);
						 ?></p>

          </nav>
          </header>
          <h1>WELCOME TO DIGITALIZED FEEDBACK SYSTEM</h1>
					<br><br>
						<div class="container">
				      <div class="box">

				          <img class='feed' src="image/postfeedback.png" alt="">

								<p>We value your feed and love to hear your thoughts.</p>
								<a href="addfeedback.php">FEEDBACK</a>
				      </div>

				      <div class="box">

				          <img src="image/history.png" alt="">

								<p>See Previouse Feedbacks</p>
								<a href="clientHistory.php">HISTORY</a>
				      </div>

				    </div>

			<br> <br>
			<img class='scroll' src="image/scrolldown.png" alt="" height="120px" width="120px">
			<br>
			<div class="announcement">
				<h2>ANNOUNCEMENT</h2> <br>
				<?php
					$sql = "SELECT * FROM portal";
	        $data = mysqli_query($link, $sql) or die(mysqli_error($link));
					$announcement = '';
					$date = '';
	        while($row = mysqli_fetch_array($data)){
						if($row['status'] == 0){
							$announcement= $row['message'];
							$date = $row['date'];
						}
					}
				 ?>
				 <table>
				 	<tr>
				 		<th><?php echo $date;  ?></th>
				 	</tr>
					<tr>
						<td><?php echo "<br>"; echo  $announcement; echo "<br>"; ?> <br> </td>
					</tr>
				 </table>
			</div>
			<br><br> <br><br>
  </body>
</html>
