<?php
  session_start();
    include('connect.php');

    $message='';
    if($_SERVER['REQUEST_METHOD'] == "POST"){

      $username = $_POST['username'];
		  $password = $_POST['password'];
      if(!empty($username) && !empty($password) && !is_numeric($username)){
  			$query = "select * from user where username = '$username' limit 1";
  			$result = mysqli_query($link, $query);
        mysqli_close($link);
  			if($result){
  				if($result && mysqli_num_rows($result) > 0){

  					$user_data = mysqli_fetch_assoc($result);

  					if(password_verify($password, $user_data['password'])) {

  						$_SESSION['user_id'] = $user_data['id_index'];
              header("Location: clienthome.php");
  						die;
  					}
  				}
  			}

  			$message =  " <p>Incorrect username/password!</p> ";
  		}
    }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/login_style.css">
    <title>LOGIN</title>
  </head>
  <body>
    <br>
    <form method="post">
          <img src="image/clientprofile.png" alt="">
        <h2>LOGIN</h2>
        <br>
        <?php
            echo $message;
         ?>
        <input class="form-control" id="_username" type="text" name="username" placeholder="username" required ><br>

        <input class="form-control" id="_password" type="password" name="password" placeholder="password" required><br>

        <input class="btn btn-primary submit" type="submit" name="submit" value="LOGIN">

            <br>
            <br><br>
            <a href="signup.php" >CREATE AN ACCOUNT</a>
            <br>
            <br>

            <a href="client_resetpassword.php"><center>Forgot Password?</a>
            <br>

    </form>












  </body>
</html>
