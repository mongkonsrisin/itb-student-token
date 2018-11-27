<?php
  session_start();
  require('dbconfig.php');
  $json = array();
  if($_SERVER['REQUEST_METHOD']=='POST') {
    $id = trim(htmlspecialchars($_SESSION['stu_id']));
    $id = mysqli_real_escape_string($con,$id);
    $sql = "SELECT * FROM tbl_student WHERE stu_id='$id'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $token = $row['stu_id'].$row['stu_citizenid'].$row['stu_key'];
      $token = md5($token);
      $json['success'] = true;
      $json['data'] = $token;
    } else {
      $json['success'] = false;
      $json['data'] = 'Unknown Error, Please try again';
    }
  } else {
    $json['success'] = false;
    $json['data'] = 'Access Denied';
  }
  echo json_encode($json);
  mysqli_close($con);
 ?>
