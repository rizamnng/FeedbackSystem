<?php
session_start();

	include("connect.php");
	include("functions.php");

	$user_data = check_admin_login($link);

	 if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username= $_POST['action'];
        if(!is_numeric($username)){

          $query = "select * from user where username= '$username' limit 1";
          $result = mysqli_query($link, $query);
          if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            $hashed_password= password_hash($user_data['registration_date'], PASSWORD_DEFAULT);
            if($username == $user_data['username']){
              $idd= $user_data['id_index'];
              $query = "update user set password='$hashed_password' where id_index= $idd  ";
              mysqli_query($link, $query);
            }
          }
					$query = "select * from password_reset where username= '$username' limit 1";
	        $result = mysqli_query($link, $query);
	        $user_data = mysqli_fetch_assoc($result);
	        $id= $user_data['id'];
	        $query = "update password_reset set status='1' where id= $id ";
	        mysqli_query($link, $query);
	        header("Location: admin_resetrequest.php");
	        die;
        }
				else{
					$query = "select * from password_reset where id= '$username' limit 1";
	        $result = mysqli_query($link, $query);
	        $user_data = mysqli_fetch_assoc($result);
	        $query = "update password_reset set status='1' where id= $username ";
	        mysqli_query($link, $query);
	        header("Location: admin_resetrequest.php");
	        die;
				}


    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" href="css/admin_resetrequest_style.css">
    <title> Requests</title>
  </head>
  <body>
		<br>
    <a class='home' href="admin_home.php">HOME</a> <br><br>


      <?php
        $sql = "SELECT * FROM password_reset";
        $data = mysqli_query($link, $sql) or die(mysqli_error($link));

        echo '<table>';
				echo "<tr>";
				echo "<th colspan='3'>NEW REQUEST</th>";
				echo "</tr>";
        while($row = mysqli_fetch_array($data)){
          if($row['status'] == 0){
            $sender = $row['username'];
            $email = $row['email'];
            $date= $row['date_time'];
            $id= $row['id'];
            echo "<tr>";
            echo "<td> $date </td>";
            echo "<td> $sender </td>";
            echo "<td> $email </td>";
            echo "<td> <form method='post'>
            <input type='submit' name='ac' value='RESET' >
						<input type='hidden' name='action' value='$sender' >
            <br><br>
            </form> </td>";
						echo "<td>
						<form method='post'>
            <input type='submit' name='ac' value='DECLINE' >
						<input type='hidden' name='action' value='$id' >
            <br><br>
            </form> </td>";
            echo "</tr>";
          }
        }
				echo "</table>";

				$sender = array();
				$email = array();
				$date = array();
				$id = array();

        $sql = "SELECT * FROM password_reset";
        $data = mysqli_query($link, $sql) or die(mysqli_error($link));
        while($row = mysqli_fetch_array($data)){
          if($row['status'] != 0){
            $s = $row['username'];
            $e = $row['email'];
            $d= $row['date_time'];
            $i= $row['id'];
						array_push($sender, $s);
						array_push($email, $e);
						array_push($date, $d);
						array_push($id, $i);
          }
        }
				echo "<br> <br>";
				echo '<table>';
				echo "<tr>";
				echo "<th colspan='3'>PREVIOUS REQUESTS</th>";
				echo "</tr>";
				$reverse_sender = array_reverse($sender);
				$reverse_date = array_reverse($date);
				$reverse_email = array_reverse($email);
				$reverse_id = array_reverse($id);
				for($i=0; $i<count($reverse_sender) ; $i++){
					echo "<tr>";
					echo "<td>";
					echo $reverse_date[$i];
					echo "</td>";
					echo "<td>";
					echo $reverse_sender[$i];
					echo "</td>";
					echo "<td>";
					echo $reverse_email[$i];
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
      ?>




  </body>
</html>
