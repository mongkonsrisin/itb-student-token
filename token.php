<?php session_start(); ?>
<?php
  if(!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    header('location:index.php');
    exit();
  }
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>SSRU</title>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center mt-5 mb-3">Your Access Token</h1>
      <div class="mt-2 mb-5 text-center">
        <span><?php echo $_SESSION['stu_fname'] .' ' . $_SESSION['stu_lname'] . ' <span class="text-danger">('. $_SESSION['stu_id'] .')</span>'?></span>
      </div>
      <input type="text" value="" class="form-control form-control-lg" id="token" readonly>
      <div class="mt-3 mb-3">
        <button id="copy" type="button" class="btn btn-primary btn-lg btn-block"><i class="fa fa-copy"></i>  Copy to clipboard</button>
        <button id="generate" type="button" class="btn btn-warning btn-lg btn-block"><i class="fa fa-redo"></i>  Generate new token</button>
        <hr>
        <a href="logout.php" role="button" class="btn btn-danger btn-lg btn-block"><i class="fa fa-power-off"></i>  Logout</a>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.all.min.js"></script>
    <script>
    $(document).ready(function() {

      token();

      $("#copy").click(function(){
        var token = $("#token");
        token.select();
        document.execCommand("copy");
        swal('Success !','Copied to clipboard','success');
      });

      $("#generate").click(function(){
        swal({
          title: 'Please re-enter your password ',
          input: 'password',
          showCancelButton: true,
          confirmButtonText: 'Submit'})
          .then(function(result) {
            if(!result.dismiss) {
              $.ajax({
                     type: "POST",
                     url: 'ajax/generate_token.php',
                     data: { password:result.value },
                     dataType: "json",
                     success: function(data) {
                       if(data.success) {
                         token();
                         swal('Success !',data.data,'success');
                       } else {
                         swal('Error !',data.data,'error');
                       }
                     }
                 });
            }

          })
      });

    });

    function token() {
      $.ajax({
             type: "POST",
             url: 'ajax/get_token.php',
             dataType: "json",
             success: function(data) {
               if(data.success) {
                 $("#token").val(data.data);
               } else {
                 swal('Error !',data.data,'error');
               }
             }
         });
    }
    </script>
  </body>
</html>
