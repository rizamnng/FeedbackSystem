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
		<link rel="stylesheet" href="css/feedbacks_style.css">
    <title>Feedbacks</title>
  </head>
  <body>
    <a href="admin_home.php">HOME</a> <br>
    <h1>FEEDBACKS</h1>


      <?php
        $sql = "SELECT * FROM message";
        $data = mysqli_query($link, $sql) or die(mysqli_error($link));
        echo "<h2>NEW</h2>";

        while($row = mysqli_fetch_array($data)){
          if($row['read_status'] == 0){
            $sender = $row['sender'];
            $message = $row['message'];
            $date= $row['date_time'];
            $id= $row['id'];
						echo '<table>';
            echo "<tr>";
            echo "<td class='top'> $sender </td>";
						echo "<td class='top'> $date </td>";
						echo "</tr>";
						echo "<tr>";
            echo "<td colspan='2'> $message <br> <br> </td>";
          	echo "</tr>";
						echo "</table>";
            }
          }
				echo "<br><br>";
        echo "<h2>OLD</h2>";
				$senders=array();
				$messages= array();
				$dates= array();

        $sql = "SELECT * FROM message";
        $data = mysqli_query($link, $sql) or die(mysqli_error($link));
        while($row = mysqli_fetch_array($data)){
          if($row['read_status'] != 0){
            $sender = $row['sender'];
            $message = $row['message'];
            $date= $row['date_time'];
						array_push($senders, $sender);
						array_push($messages, $message);
						array_push($dates, $date);
          }
        }
				$senders_rev= array_reverse($senders);
				$messages_rev= array_reverse($messages);
				$dates_rev= array_reverse($dates);
				for($i=0; $i<count($senders_rev) ; $i++){
					echo "<table>";
					echo "<tr>";
					echo "<td class='top'> $senders_rev[$i] </td>";
					echo "<td class='top'> $dates_rev[$i] </td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td colspan='2'> $messages_rev[$i] </td>";
					echo "</tr>";
					echo "</table>";
				}

        mysqli_close($link);
      ?>
			<br><br>
  </body>
</html>
