<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>SSRU</title>
  </head>
  <body class="text-center auth">
    <form class="form-signin" action="" method="post">
      <img class="mb-4" src="assets/img/student.png" alt="" width="72" height="72">
      <h3 class="h3 mb-3 font-weight-bold">SSRU</h3>
      <label for="username" class="sr-only">Student ID</label>
      <input type="text" id="username" class="form-control" placeholder="Student ID" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" class="form-control" placeholder="Password" required>
      <button id="login" class="btn btn-lg btn-primary btn-block" type="button">Log in</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <script>
    $(document).ready(function() {
      $("#login").click(function(){
          var username = $("#username").val().trim();
          var password = $("#password").val().trim();
          $.ajax({
                 type: "POST",
                 url: 'ajax/auth.php',
                 dataType: "json",
                 data: { username:username,password:password },
                 success: function(data) {
                   if(data.success) {
                     swal('Success !',data.data,'success').then(function() {
                       window.location.href = 'token.php';
                     });
                   } else {
                     swal('Error !',data.data,'error');
                   }
                 }
             });
      });
    });
    </script>
  </body>
</html>
