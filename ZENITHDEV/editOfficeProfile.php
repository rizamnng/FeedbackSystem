<?php
session_start();

	include("connect.php");
  include("functions.php");

	$user_data = check_office_login($link);
  $message= '';
	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$username = $_POST['username'];
    $new_email= $_POST['email'];
    $email = $user_data['email'];
    $contact_number= $_POST['number'];
    $id= $user_data ['id'];
    if($email != $new_email){
      if (filter_var($new_email, FILTER_VALIDATE_EMAIL)) {

				$api_key = "b821b3edb1524020afbbad79ca9e7fc0";
				$ch = curl_init();
				curl_setopt_array($ch, [
						CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1?api_key=$api_key&email=$new_email",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_FOLLOWLOCATION => true
				]);
				$response = curl_exec($ch);
				curl_close($ch);
				$data = json_decode($response, true);

				if ($data['deliverability'] === "DELIVERABLE" ) {
            $query = "update authorities set
            email= '$new_email',
            contact_number= '$contact_number',
            username= '$username'
            where id= $id ";
        		mysqli_query($link, $query);
        		header("Location: office_profile.php");
        		die;
        }
        else{
					$message= "<p>Email is Undeliverable/Disposable</p>" ;
				}
      }
      else{
        $message= "<p>Invalid email format</p>" ;
      }
	   }
     else{
       $query = "update authorities set
       email= '$new_email',
       contact_number= '$contact_number',
       username= '$username'
       where id= $id ";
       mysqli_query($link, $query);
       header("Location: office_profile.php");
       die;
     }
		 	mysqli_close($link);
   }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/officeprofile_style.css">
    <title>Edit Information</title>
  </head>
  <body>
		<br><br>
		<div class="information">
			<img src="image/clientprofile.png"  height="100" width="100"> <br>
			<h3>College of Engineering</h3><br>
			<span>
				<?php
					echo $message;
				 ?>
			</span>

			<form  method="post">

        <input class="form-control " type="text" name="username" required value= "<?php echo$user_data['username']; ?>" placeholder="username"><br>
	      <input class="form-control" type="email" name="email" required value= "<?php echo$user_data['email']; ?>" placeholder="email"><br>
	      <input class="form-control" type="text" name="number"  required value= "<?php echo$user_data['contact_number']; ?>" placeholder="contact number"><br>

	      <input  class="btn btn-primary edit" type="submit" name="submit" value="SUBMIT">
	    </form>
		</div>

  </body>
</html>
