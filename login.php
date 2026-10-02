<?php
    ob_start();
    session_start(); 
    include "koneksi.php";
    if (isset($_SESSION['user'])) {
            header("location:index.php");
        }else{
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Distribusi Obat</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="login-body">
    <div class="container">
        <div class="row ">
               
          <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-50 col-xs-offset-1">

                <div class="panel panel-default login-panel">
                    <div class="panel-heading">
                        LOGIN
                    </div>
                    <div class="panel-body">
                        <p class="text-center" style="margin-bottom: 20px; color: #777;">Selamat Datang! Silakan masuk untuk melanjutkan.</p>
                        <form role="form" method="post" id="frmlogin">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                <input type="text" class="form-control" name="username" placeholder="Username" id="username" required/>
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
                            </div>
                             
                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="login" name="login">MASUK</button>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content" id="notif" name="notif">

                    </div>
                </div>
            </div>
        </div>
            
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript">
     $("#frmlogin").submit(function(event){
        event.preventDefault();
        var username = document.getElementById("username").value;  
        var password = document.getElementById("password").value;
        // console.log(username);
        $.ajax({
            url: "function.php",
            method: "POST",
            data: {username:username, password:password},
            success: function(data){
                $("#notif").html(data)
                $("#myModal").modal('show')
            }
        })
    });
    </script>


</body>
</html>

<?php

}

?>