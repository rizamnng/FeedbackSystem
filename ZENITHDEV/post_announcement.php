<?php
session_start();

	include("connect.php");
	include("functions.php");

	$user_data = check_admin_login($link);

  date_default_timezone_set('Asia/Hong_Kong');
  $message= '';

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $announcement= $_POST['message'];
		if (!empty($announcement)){
			$date_time = date('Y-m-d H:i:s');
			$sql = "SELECT * FROM portal";
			$data = mysqli_query($link, $sql) or die(mysqli_error($link));
			while($row = mysqli_fetch_array($data)){
				$id= $row['id'];
				if($row['status'] == 0){
					$query = "update portal set
					status = '1'
					where id= $id ";
					mysqli_query($link, $query);
				}
			}
			$query = "insert into portal(message, date, status)
					values ('$announcement', '$date_time','0')";
			mysqli_query($link, $query);
		}
		header("Location: post_announcement.php");
		die;
  }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" href="css/post_announcement_style.css">
    <title>ANNOUNCEMENT</title>
  </head>
  <body>
		<br>
    &nbsp&nbsp&nbsp<a  class='home' href="admin_home.php">HOME</a>
		<div class="contents">
			<img src="image/adminhome.png" height="120" width="120"><br><br>
			<h3>CREATE ANNOUNCEMENT</h3>
			<form method="post">
				<textarea name="message" rows="7" cols="60" required></textarea><br>
				<input type="submit" name="submit" value="POST">
			</form>
			<br><br> <br>
			<h3 class='previous'>PREVIOUS ANNOUNCEMENT</h3> <br>
			<?php
					$announce= array();
					$dateandtime= array();
					$sql = "SELECT * FROM portal";
					$data = mysqli_query($link, $sql) or die(mysqli_error($link));
					while($row = mysqli_fetch_array($data)){

							$announcement = $row['message'];
							$date= $row['date'];
							array_push($announce, $announcement);
							array_push($dateandtime, $date);

					}

					$reverse = array_reverse($announce);
					$reversedt = array_reverse($dateandtime);
					for($i=0; $i<count($reverse) ; $i++){
						echo "<table style='width:60%'>";
						echo "<tr>";
						echo "<td class= 'date'>";
						echo $reversedt[$i];
						echo "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>";
						echo "<br>";
						echo $reverse[$i];
						echo "<br>";
						echo "<br>";
						echo "</td>";
						echo "</tr>";
						echo "</table>";
						echo "<br>";
					}


					mysqli_close($link);

			 ?>
		</div>


  </body>
</html>
