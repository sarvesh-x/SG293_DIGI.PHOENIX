<?php 
	session_start();
	$cmp_code='';
	$user_id=$_SESSION["user_id"];
	$stmt=$db_con->prepare("SELECT user_master.user_id,user_master.cmp_code,user_master.username,user_master.password,user_master.type,company.name,company.mobile,company.logo,company.address,company.email FROM user_master JOIN company ON company.id=user_master.cmp_code WHERE user_master.user_id='$user_id'");
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	  $cmp_name=$row['name'];
	  $logo=$row['logo'];
	  $cmp_address=$row['address'];
	  $cmp_email=$row['email'];
	  $cmp_mob=$row['mobile'];
	  $password=$row['password'];
	  $cmp_code=$row['cmp_code'];
	 if($cmp_code=='')
	 {
	 	 echo "<script>
		   window.location.replace('login.php');
		   </script>";
	 }
	 $user_name=$row['username'];
	 $user_type=$row['type'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $cmp_name; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    <style type="text/css">
	body{
		background-color:white;
	}
        @media only screen and (max-width: 600px) {
        #logo
        {
            display:none;
        }
    }
    #logo{
        background-color:white;
        width:50px;height:50px;float:left;padding:5px;
        border-radius:50px;
    }
    </style>
</head>
<body class="theme-black">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>RHCMS..</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar" style="background-color:white;" >
        <div class="container-fluid">
            <div class="navbar-header" style="background-color: white;">
                <img src="images/<?php echo $logo;?>" id="logo">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" style="color:black;"></a>
                <a href="javascript:void(0);" class="bars" style="color:black;"></a>
                
                                <a class="navbar-brand" href="index.php"style="color:black;"><?php echo $cmp_name; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
 
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" style="color:gray;">
                            <i class="material-icons">notifications</i>
                            <span class="label-count" style="color:white;"><?php 
                            $stmtss = $db_con->prepare("SELECT COUNT(notification.n_id) as tn FROM notification WHERE notification.status='send'");
        						$stmtss->execute();
        						$row=$stmtss->fetch(PDO::FETCH_ASSOC);
        						echo $tn=$row['tn'];
         						?> </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                	<?php $stmtss = $db_con->prepare("SELECT notification.n_id,notification.subject,notification.message FROM notification WHERE notification.status='send' ORDER BY notification.n_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <li>
                                        <a href="index.php?page=notification&id=<?php echo $row['n_id']; ?>">
                                            <div class="icon-circle bg-light-green" style="color:black;">
                                                <i class="material-icons">message</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?php echo $row['subject']; ?></h4>
                                                	
                                            </div>
                                        </a>
                                    </li>
                                <?php }?>
                                  </ul>
                            <li class="footer">
                                <a href="index.php?page=notification_list">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
 
                <div class="info-container">
                    <b style="color:white;font-size:20px;"><?php echo $user_name; ?></b>
                    <spna style="color:yellow;font-size:12px;"><br><?php echo $user_type; ?></spna>
                    <div class="btn-group user-helper-dropdown" id="nav">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                             
                            <li><a href="index.php?page=cmp_profile"data-target="profile"><i class="material-icons">person</i> Profile</a></li>
                            
                              <li><a href="login.php" data-target="logout"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu" id="nav">
                <ul class="list">
                    <li class="active">
                        <a href="index.php"data-target="dashboard">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                   
<li>
<a href="javascript:void(0);" class="menu-toggle">
<i class="material-icons">location_city</i>
                        <span>Tender</span>
</a>
                        <ul class="ml-menu">
                            <li>
                                <a href="index.php?page=create_tender">
                                    <span>Create Tender</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=tender_status">
                                    <span>Tender Status</span>
                                </a>
                            </li>
                        <li>
                                <a href="index.php?page=third_party">
                                    <span>Third party survey</span>
                                </a>
                            </li>
							
                        </ul>
<li>
<a href="javascript:void(0);" class="menu-toggle">
<i class="material-icons">insert_chart</i>
<span>Report</span>
</a> 
                        <ul class="ml-menu">
                            
                             <li>
                                <a href="index.php?page=pending_status">
                                    <span>Pending Work status</span>
                                </a>
                            </li>
                
                        </ul>

</li>

  <li>
<a href="javascript:void(0);" class="menu-toggle">
<i class="material-icons">perm_data_setting</i>
<span>Setting</span>
</a> 
                        <ul class="ml-menu">
                            
                             <li>
                                <a href="index.php?page=all_user">
                                    <span>All app users</span>
                                </a>
                            </li>
                
                        </ul>

</li>
<li>
<a href="#" data-toggle="modal" onclick="myFunctionp(1)"><i class="material-icons">chat</i>
<span>Support</span></a>


</li>
<li>
<a href="index.php?page=backup_database"><i class="material-icons">backup</i>
<span>Backup Database</span></a>


</li>

           </ul>
            </div>
           </aside>
         </section>
<script>
function myFunctionp(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    
 $("#iis").val(id);
    // Open modal popup
    $("#uploadModal").modal("show");
}
</script>               </td>
 		<!-- Modal -->
			<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"style="width:400px;height:450px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Help desk</h4>
      </div>

      </div> 
    </div>

  </div>
</div>

