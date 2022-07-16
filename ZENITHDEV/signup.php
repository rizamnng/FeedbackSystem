<?php
session_start();
	date_default_timezone_set('Asia/Hong_Kong');
	include("connect.php");
	$message= '';
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

    $type= 0;
    $fname= $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $currentDate= date('Y/m/d');
    $username = $_POST['username'];
		$password = $_POST['password'];
    $confirm_pass= $_POST['confirm_pass'];
		$hashed_password= password_hash($password, PASSWORD_DEFAULT);



		if(!empty($username) && !empty($password) && !is_numeric($username) )
		{

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$api_key = "b821b3edb1524020afbbad79ca9e7fc0";
				$ch = curl_init();
				curl_setopt_array($ch, [
						CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1?api_key=$api_key&email=$email",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_FOLLOWLOCATION => true
				]);
				$response = curl_exec($ch);
				curl_close($ch);
				$data = json_decode($response, true);

				if ($data['deliverability'] === "DELIVERABLE" ) {

					if ($password == $confirm_pass && strlen($password)>=8 ){
						$sql_u = "SELECT * FROM user WHERE username='$username'";
						$res_u = mysqli_query($link, $sql_u);
						if (mysqli_num_rows($res_u) === 0) {
							$query = "insert into user (type,firstname, lastname, gender, email, contact_number, registration_date, username, password)
							values ('$type','$fname','$lname', '$gender' , '$email' ,'$number','$currentDate' ,'$username','$hashed_password')";
							mysqli_query($link, $query);
							mysqli_close($link);
							header("Location: login.php");
  						die;
						}
						else{
							$message= "<p>Sorry username is already taken</p>" ;
						}

					}
					else{
						$message= "<p>Password not match / Password must contain atleast 8 characters</p>" ;
					}

				}
				else{
					$message= "<p>Email is Undeliverable</p>" ;
				}

			}
			else{
				$message= "<p>Invalid email format</p>" ;
			}

		}
    else{
			$message= "<p>Please enter some valid information!</p>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/sign-up_style.css">
    <title>SIGNUP</title>
  </head>
  <body>
    <div class="row">
        <div class="column left first">
          <img src="image/officehomeprofile.png" alt="">
          <h2>CLIENT</h2>

        </div>
      <div class="column right">
			<form  method="post">
        <br> <h2>FILL UP FORM</h2><br>
        <p><?php
          echo $message;
         ?></p>
	      <input class="form-control" type="text" name="fname" required placeholder="First Name"><br>

	      <input class="form-control" type="text" name="lname" required placeholder="Last Name"><br>


	      <input class="form-control" type="email" name="email" required placeholder="Email"><br>

	      <input class="form-control" type="text" name="number" required placeholder="Contact Number"><br>

	      <input class="form-control" type="text" name="username" required placeholder="Username"><br>

	      <input class="form-control" type="password" name="password" required placeholder="Password"><br>

	      <input class="form-control" type="password" name="confirm_pass"required placeholder="Confirm Password"><br>
        <input type="radio" id="genderChoice1" name="gender" value="Male" required>
	      <label class="genderlabel" for="genderChoice1">Male </label>
	      <input  type="radio" id="genderChoice2" name="gender" value="Female" required>
	      <label class="genderlabel" for="genderChoice2">Female </label> <br><br>
        <input class="button"  type="submit" name="submit" value="SUBMIT">
	    </form>
		</div>

  </div>
<br><br><br><br>
  </body>
</html>
