<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>RHCMS : Rural housing and construction monitoring system</title>
    <!-- Favicon-->
    <link rel="icon" href="favicons.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
<style type="text/css">
    
   body {background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url("images/bg.jpg");
 background-color:white;
}
</style>
</head>

<body >
    
    <div class="container">
        <br><br><br><br><br>
        <div class="row">
        <div class="col-xs-12 col-sm-6">
                     <div class="login-box">
        <div class="card">
            <div class="body">
                 <img src="images/baner.jpg" style="width: 100%;">

</div>
</div>

            </div>
</div>
            <div class="col-xs-12 col-sm-6">
                
                     <div class="card">
            <div class="body">
                <form id="forgot_password"action="model/page_action.php" method="POST">
                    <div class="msg">
                        <br>
                        Enter your email address that you used to register. We'll send you an email with your username and a
                        link to reset your password.<br>
                    </div>
                    <div class="input-group">
                        <br>
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-block btn-lg bg-pink waves-effect" name="forgat" value="RESET MY PASSWORD">

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="login.php">Sign In!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
                
            </div>
      </div>
</div>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html> 