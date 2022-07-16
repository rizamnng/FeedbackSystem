<?php
session_start();

	include("connect.php");
  include("functions.php");

	$user_data = check_office_login($link);
  $message= '';
	if($_SERVER['REQUEST_METHOD'] == "POST"){
    $old = $_POST['old'];
    $new = $_POST['new'];
    $confirm_new = $_POST['confirm_new'];
		$id = $user_data['id'];
		$hashed_password= password_hash($new, PASSWORD_DEFAULT);
    if($new == $confirm_new && strlen($new)>=8){

      if( !empty($new) && password_verify($old, $user_data['password'])){
        $query = "update authorities set password= '$hashed_password' where id= $id ";
        mysqli_query($link, $query);
        header("Location: office_profile.php");
        die;
      }
			else{
				$message = "<p>Incorrect Current Password</p>";
			}
    }
    else{
      $message = "<p>Password not match / Password must contain atleast 8 characters</p>";
    }
   }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/changepassword_style.css">
    <title>Change Password</title>
  </head>
  <body>
		<div class="log">
			<h2>CHANGE PASSWORD</h2>
			<span>  <?php
					echo $message;
				 ?></span>

			<form  method="post">

	      <input class="form-control" type="password" name="old" placeholder="Enter Current Password" required ><br><br>

	      <input class="form-control" type="password" name="new" placeholder="Enter New Password" required><br><br>

        <input class="form-control"  type="password" name="confirm_new" placeholder="Confirm New Password" required> <br><br>
	      <input  class="btn btn-primary submit" type="submit" name="submit" value="SUBMIT">
	    </form>
		</div>


  </body>
</html>
