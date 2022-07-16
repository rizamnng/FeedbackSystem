<?php
  include("connect.php");
  $message='';
  date_default_timezone_set('Asia/Hong_Kong');
  if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $date  = date('Y-m-d H:i:s');
    $query = "select * from user where username = '$username' limit 1";
    $result = mysqli_query($link, $query);
    if($result && mysqli_num_rows($result) > 0){
      $user_data = mysqli_fetch_assoc($result);
      if($username == $user_data['username'] && $email == $user_data['email']){
        $query = "insert into password_reset (username, date_time, email)
            values ('$username', '$date', '$email')";
        mysqli_query($link, $query);
        header("Location: index.php");
        die;
      }
      else{
        $message='Username/Email Does not Exist';
      }
    }
    else{
      $message='Please Input Information Correctly';
    }
    mysqli_close($link);
  }
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
     <link rel="stylesheet" href="css/client_resetpassword_style.css">
     <title>Request Reset</title>
   </head>
   <body>
     <div class="log">
       <h2>PASSWORD RESET</h2>
       <p class='message'><?php echo $message; ?></p>

       <form method="post">
         <input class="form-control" type="text" name="username" placeholder="Enter Username" required ><br><br>
         <input class="form-control" type="email" name="email" placeholder="Enter Email" required><br><br>
         <input  class="btn btn-primary submit" type="submit" name="submit" value="SUBMIT">
       </form>
       <br>

     </div> <br>
     <p>note: If your request is accepted your new password will be <br>
       reseted into the date of your registration.</p>

   </body>
 </html>
