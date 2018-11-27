<?php
  session_start();
  require('dbconfig.php');
  $json = array();
  if($_SERVER['REQUEST_METHOD']=='POST') {
    $password1 = trim(htmlspecialchars($_POST['password']));
    $password2 = trim(htmlspecialchars($_SESSION['stu_citizenid']));
    if($password1 != $password2) {
      $json['success'] = false;
      $json['data'] = 'Invalid password';
    } else {
      $id = trim(htmlspecialchars($_SESSION['stu_id']));
      $id = mysqli_real_escape_string($con,$id);
      $new_key = generateRandomString();
      $sql = "UPDATE tbl_student SET stu_key='$new_key' WHERE stu_id='$id'";
      $result = mysqli_query($con,$sql);
      if (mysqli_affected_rows($con) == 1) {
        $json['success'] = true;
        $json['data'] = 'New token is regenerated';
      } else {
        $json['success'] = false;
        $json['data'] = 'Unknown Error, Please try again';
      }
    }
  } else {
    $json['success'] = false;
    $json['data'] = 'Access Denied';
  }
  echo json_encode($json);
  mysqli_close($con);

  function generateRandomString() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 16; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
 ?>
