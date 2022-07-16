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
		<link rel="stylesheet" href="css/clientHistory_style.css">
    <title>Your Feedbacks</title>
  </head>
  <body>
		<div class="upper">
			<a href="clienthome.php">HOME</a> <br>
	    <h1>FEEDBACK HISTORY</h1>
		</div>


      <?php
				$senders=array();
				$messages= array();
				$dates= array();
        $sql = "SELECT * FROM message";
        $data = mysqli_query($link, $sql) or die(mysqli_error($link));
        while($row = mysqli_fetch_array($data)){
          $username = $user_data['username'];
          $username_un= 'unknown_';
          $username_un.=$user_data['id_index'];
          if ($row['sender'] == $username or $row['sender'] == $username_un){
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

      ?>



  </body>
</html>
