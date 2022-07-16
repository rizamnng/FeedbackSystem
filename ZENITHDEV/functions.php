<?php
  function check_login($link)
  {

    if(isset($_SESSION['user_id']))
    {

      $id = $_SESSION['user_id'];
      $query = "select * from user where id_index = '$id' limit 1";

      $result = mysqli_query($link,$query);

      if($result && mysqli_num_rows($result) > 0)
      {

        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
      }
    }

    //redirect to login
    header("Location: login.php");
    die;

  }

  function edit_sender($username, $old_username, $link){
    if($username != $old_username){

      $sql = "SELECT * FROM message";
      $data = mysqli_query($link, $sql) or die(mysqli_error($link));
      while($row = mysqli_fetch_array($data)){
        if ($row['sender'] == $old_username ){
          $id= $row['id'];
          $query = "update message set sender= '$username' where id= $id ";
          mysqli_query($link, $query);
        }
      }
    }
    return;
  }


  function check_office_login($link)
  {

    if(isset($_SESSION['user_id']))
    {

      $id = $_SESSION['user_id'];
      $query = "select * from authorities where id = '$id' limit 1";

      $result = mysqli_query($link,$query);

      if($result && mysqli_num_rows($result) > 0)
      {

        $user_data = mysqli_fetch_assoc($result);
        if($user_data['type']== 0){
          return $user_data;
        }
      }
    }

    //redirect to login
    header("Location: office_login.php");
    die;

  }


  function check_admin_login($link)
  {

    if(isset($_SESSION['user_id']))
    {

      $id = $_SESSION['user_id'];
      $query = "select * from authorities where id = '$id' limit 1";

      $result = mysqli_query($link,$query);

      if($result && mysqli_num_rows($result) > 0)
      {

        $user_data = mysqli_fetch_assoc($result);
        if($user_data['type']== -1){
          return $user_data;
        }
      }
    }

    //redirect to login
    header("Location: admin_login.php");
    die;

  }

 ?>
