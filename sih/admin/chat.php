<?php 
if(isset($_GET['id']))
{
    $cl_id=$_GET['id'];
}
$user_id=57;
?>
<html>  
   <head>  
      <title>The Materialize Tabs Example</title>  
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">        
      <link rel = "stylesheet"  
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">  
      <link rel = "stylesheet"   
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">  
      <script type = "text/javascript"  
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>  
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">  
      </script>   
   </head>  
   <body class = "container">   
     <div class="row"style="position:fixed;bottom:-10;left:0;">  
     <div id="inbox" class="col s12">
<iframe src="https://eclasss.in/gtc/student_chat.php?id=<?php echo $user_id; ?>&l_id=<?php echo $cl_id; ?>" height="530px" width="100%" title="Iframe Example"></iframe>     
     </div>  
    <div id="unread" class="col s12">
    <iframe src="https://eclasss.in/gtc/partic.php?cl_id=<?php echo $cl_id; ?>" height="530px" width="100%" title="Iframe Example"></iframe>       
    </div>  
    <div class="col s12">  
      <ul class="tabs">  
        <li class="tab col s3"><a class="active"  href="#inbox">
            <i class = "material-icons">chat</i>
        </a></li>  
        <li class="tab col s3"><a  href="#unread"><i class = "material-icons">people</i></a></li> 
        
      </ul>  
    </div>  
  </div>  
   </body>  
</html> 