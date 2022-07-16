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
		<link rel="stylesheet" href="css/clientinfo_style.css">
    <title>USERS</title>
  </head>
  <body>
		<a href="admin_home.php" class="back">HOME</a>
    <h1>CLIENTS</h1>
    <div class="records">

          <?php

            echo "<form  method='post'>
              <input class='searchbox' type='search' name='searchuser'  placeholder='USERNAME'>
              <input type='submit' name='submit' value='SEARCH'> <br><br>
            </form>";
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                echo '<h4> RESULT </h4>';
                echo "<table align= 'center'>";
                $user= $_POST['searchuser'];
                $query = "select * from user where username = '$user' limit 1";
          			$result = mysqli_query($link, $query);
                if($result){
          				if($result && mysqli_num_rows($result) > 0){
          					$userdata = mysqli_fetch_assoc($result);
                    $username= $userdata['username'];
                    $fname= $userdata['firstname'];
                    $lname = $userdata['lastname'];
                    $gender = $userdata['gender'];
                    $email = $userdata['email'];
                    $number= $userdata['contact_number'];

                    echo "<tr>";
                    echo "<td> $username </td>";
                    echo "<td> $fname </td>";
                    echo "<td> $lname </td>";
                    echo "<td> $gender </td>";
                    echo "<td> $email </td>";
                    echo "<td> $number </td>";
                    echo "</tr>";


                  }

                }
                echo "</table>";
                echo "<br>";
            }

            echo "<table align= 'center'>
              <tr>
                <th>USERNAME</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>GENDER</th>
                <th>EMAIL</th>
                <th>CONTACT NUMBER</th>
              </tr>";
            $sql = "SELECT * FROM user";
            $data = mysqli_query($link, $sql) or die(mysqli_error($link));
            while($row = mysqli_fetch_array($data)){
              $username= $row['username'];
              $fname= $row['firstname'];
              $lname = $row['lastname'];
              $gender = $row['gender'];
              $email = $row['email'];
              $number= $row['contact_number'];

              echo "<tr>";
              echo "<td> $username </td>";
              echo "<td> $fname </td>";
              echo "<td> $lname </td>";
              echo "<td> $gender </td>";
              echo "<td> $email </td>";
              echo "<td> $number </td>";
              echo "</tr>";
            }
            mysqli_close($link);
           ?>
      </table>
    </div>
  </body>
</html>
