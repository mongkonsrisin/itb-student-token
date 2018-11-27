<?php
  session_start();
  require('dbconfig.php');
  $json = array();
  if($_SERVER['REQUEST_METHOD']=='POST') {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    $username = mysqli_real_escape_string($con,$username);
    $password = mysqli_real_escape_string($con,$password);
    $sql = "SELECT * FROM tbl_student WHERE stu_id='$username' AND stu_citizenid='$password'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $json['success'] = true;
      $json['data'] = $row['stu_fname'].' '.$row['stu_lname'];
      $_SESSION['login'] = true;
      $_SESSION['stu_id'] = $row['stu_id'];
      $_SESSION['stu_fname'] = $row['stu_fname'];
      $_SESSION['stu_lname'] = $row['stu_lname'];
      $_SESSION['stu_citizenid'] = $row['stu_citizenid'];
      $_SESSION['stu_birthday'] = $row['stu_birthday'];
    } else {
      $json['success'] = false;
      $json['data'] = 'Invalid Student ID or Password';
      $_SESSION['login'] = false;
    }
  } else {
    $json['success'] = false;
    $json['data'] = 'Access Denied';
    $_SESSION['login'] = false;
  }
  echo json_encode($json);
  mysqli_close($con);
 ?>
