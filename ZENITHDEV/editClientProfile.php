<?php
session_start();

	include("connect.php");
  include("functions.php");

	$user_data = check_login($link);
  $message= '';
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$old_username= $user_data['username'];
		$username = $_POST['username'];
    $new_email= $_POST['email'];
    $fname= $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $user_data['email'];
    $contact_number= $_POST['number'];
    $id= $user_data ['id_index'];
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
          $query = "update user set

            firstname= '$fname',
            lastname= '$lname',
            gender= '$gender',
            email= '$new_email',
            contact_number= '$contact_number',
            username= '$username'
            where id_index= $id ";
        		mysqli_query($link, $query,  $link);
						edit_sender($username, $old_username);
        		header("Location: clientProfile.php");
        		die;
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
       $query = "update user set

         firstname= '$fname',
         lastname= '$lname',
         gender= '$gender',
         email= '$email',
         contact_number= '$contact_number',
         username= '$username'
         where id_index= $id ";
         mysqli_query($link, $query);
				 edit_sender($username, $old_username, $link);
         header("Location: clientProfile.php");
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
    <link rel="stylesheet" href="css/editClientprofile_style.css">
    <title>Edit Information</title>
  </head>
  <body>

    <div class="row">
        <div class="column left first">
          <img src="image/officehomeprofile.png" alt="">
          <h2>CLIENT</h2>

        </div>
        <div class="column right">
          <form method='post'>
            <br> <h2>EDIT PROFILE</h2><br>
            <p><?php
              echo $message;
             ?></p>

            <label>NAME:</label>
              <input class="name" type="text" name="fname" required value= "<?php echo$user_data['firstname']; ?>" required>
    	        <input class="name" type="text" name="lname" required required value= "<?php echo$user_data['lastname']; ?>" required><br>
            <label>USERNAME:</label>
              <input class="" type="text" name="username" required value= "<?php echo$user_data['username']; ?>" required><br>
            <label>EMAIL:</label>
              <input class="" type="email" name="email" required value= "<?php echo$user_data['email']; ?>" required><br>
            <label>PHONE NO.:</label>
              <input class="" type="text" name="number"  required value= "<?php echo$user_data['contact_number']; ?>" required><br>
            <label>GENDER:</label>
              <input  type="radio" id="genderChoice1" name="gender" value="Male" required>
              <label class='genderlabel' for="genderChoice1">Male </label>
              <input type="radio" id="genderChoice2" name="gender" value="Female" required>
              <label class='genderlabel' for="genderChoice2">Female </label> <br><br>
              <input  class="button" type="submit" name="submit" value="SUBMIT">
          </form>
        </div>
      </div>
  </body>
</html>
