<?php
  session_start();
    include("connect.php");
    include("functions.php");
    date_default_timezone_set('Asia/Hong_Kong');
    $message= '';
    $user_data = check_login($link);
    if($_SERVER['REQUEST_METHOD'] == "POST"){

      $username = $user_data['username'];
      $message= $_POST['message'];
      $identity = $_POST['identity'];
      $username_un= 'unknown_';
      $username_un.=$user_data['id_index'];
      $date_time = date('Y-m-d H:i:s');
      if($identity == 'YES'){
        $username_new = $username_un;
      }
      else{
        $username_new =  $user_data['username'];
      }
      $mins=6;
      $sql = "SELECT * FROM message";
      $data = mysqli_query($link, $sql) or die(mysqli_error($link));
      while($row = mysqli_fetch_array($data)){

        if ($row['sender'] === $username_un or $row['sender'] === $username ){
          $start = strtotime($row['date_time']);
          $end = strtotime(date('Y-m-d H:i:s'));
          $mins = (int)(($end - $start) / 60);
          if($mins<5){
            $mins = $mins;
          }
        }
      }
      if ($mins>=5){

        $query = "insert into message(sender, message, read_status, date_time)
            values ('$username_new', '$message','0','$date_time')";
        mysqli_query($link, $query);

        header("Location: clienthome.php");
        die;
      }
      else{
        $remaining= 5-$mins;
        $message="<p>Please try again after $remaining minutes</p>";
      }

    }
    mysqli_close($link);


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/addfeedback_style.css">
    <title>Add Feedback</title>
  </head>
  <body>
  <a href="clienthome.php">HOME</a>
  <h1>FEEDBACK FORM</h1>
   <p>We would like to have your suggestions and recommendations, concerns or issues about
   our services so we could improve. Thank you!</p>
    <form class="feedback" method="post">
      <h2>Input Your Feedback Here!</h2>
      <textarea class='message' name="message"  required></textarea>
      <label for="conceal">Conceal Identity: </label>
      <input type="radio" id="conceal" name="identity" value="YES" required>
      <label for="conceal">YES </label>
      <input type="radio" id="conceal" name="identity" value="NO" required>
      <label for="conceal">NO  </label> <br>
      <input class="btn btn-primary submit" type="submit" name="submit" value="SUBMIT">
    </form>
    <?php
      echo $message;
     ?>

  </body>
</html>
