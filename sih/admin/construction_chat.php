<?php
    include 'db/dc.php';
    $user_id=1;
?>
<html
   <head>
      <title></title>
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">      
      <link rel = "stylesheet"
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel = "stylesheet"
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
      <script type = "text/javascript"
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script> 
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
      </script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="chat.css">
<script>
  $(document).ready(function () {
    $('.send').click(function (e) {
      e.preventDefault();
      var name = $('#input').val();
      var email = $('#user_id').val();
      var message = $('#v_id').val();
       $.ajax
        ({
          type: "POST",
          url: "form_submit.php",
          data: { "name": name, "email": email, "message": message },
          success: function (data) {
            $('.result').html(data);
            $('#contactform')[0].reset();
          }
        });
    });
  });
</script>
   </head>
 <?php 
 $a=0;
      $send_name='';
if(isset($_GET['a']))
{
    $a=$_GET['a'];
    $stmtq = $db_con->prepare("SELECT tender_master.t_id,tender_master.t_name,tender_master.t_o_name FROM tender_master WHERE tender_master.t_id='$a'");
        $stmtq->execute();
        $rq=$stmtq->fetch(PDO::FETCH_ASSOC);
         $send_name=$rq['t_o_name'];
}
if(isset($_GET['id']))
{
    echo $id=$_GET['id'];
    echo  $d=$_GET['d'];
if($d=='yes'){
    $stmtq = $db_con->prepare("DELETE FROM chat_master WHERE chat_master.s_id='$id' OR chat_master.r_id='$id'");
        $stmtq->execute();
}
}
      ?>
   <body class = "container"> 
   <div class="navbar-fixed"style="position:fixed;top:0px;">
    <nav>
      <div class="nav-wrapper"style="padding:2px;">
<table>
<tr><td><a href="construction_chat.php?id=<?php echo $user_id; ?>"style="color:white;"><i class = "material-icons" >home</i></a></td>
<td style="color:white;"><?php echo $send_name; ?></td>
<td><a href="construction_chat.php?id=<?php echo $user_id; ?>&d=yes"style="color:white;float:right;margin-right:8px;"><i class = "material-icons" >delete</i></a></td></tr>    
</table>
      </div>
    </nav>
  </div>
<div class="wrapper">
  <div class="inner" id="inner">
    <div class="content" id="content">
       <div class="result"></div>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
    function refresh_div() {
        jQuery.ajax({
            url:'chat_message.php?id=<?php echo $user_id; ?>',
            type:'POST',
            success:function(results) {
                jQuery(".result").html(results);
            }
        });
    }
    t = setInterval(refresh_div,2000);
</script>
    </div>
  </div>
  <div class="bottom" id="bottom">
       <form method="post" action="" id="contactform">
    <textarea class="input" id="input" autofocus style="border-bottom:1px solid teal;"></textarea>
    <input type="hidden" value="<?php echo $user_id; ?>"id="user_id">
        <input type="hidden" value="<?php echo $a; ?>"id="v_id">
    <button class="send" id="send"></button>
    </form>
  </div>
</div>
    </body>
    </html>
			