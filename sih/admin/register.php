<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>RHCMS</title>
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
                <img src="baner.jpg" style="width: 100%;">

</div>
</div>

            </div>
</div>
            <div class="col-xs-12 col-sm-6">
                
                     <div class="login-box">
        <div class="card">
            <div class="body">
<h5>public interest feedback Registration ...</h5>
               <form id="sign_up" action="model/page_action.php" method="POST">
                <input type="hidden" name="cmp_code" value="1">
                    <div class="msg"><br></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="namesurname" placeholder="Name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">list</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="t_id" placeholder="Tender Number" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">list</i>
                        </span>
                        <div class="form-line">
                    <select name="type">
                    <option value="Sarpanch">Sarpanch</option> 
                    <option value="Teshildar">Teshildar</option> 
                    <option value="House Owner">Houser Owner</option> 
                        
                    </select>        
                        
                    </div>
                    </div>

                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="3" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>
                    <input type="submit" name="sign_up_button" value="SIGN UP" class="btn btn-block bg-pink waves-effect">
                    

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="house_owner.php">You already have a membership?</a>
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