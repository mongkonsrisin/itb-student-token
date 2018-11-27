<?php
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = 'root';
  $dbname = 'student';
  $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  mysqli_set_charset($con,"utf8");
 ?>
