
<?php
if(isset($_GET['id']))
{
    include '../db/dc.php';
    $user_id=$_GET['id'];
date_default_timezone_set('Asia/Kolkata');
$dt=date("Y-m-d h:i:s");

}
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
      var name = $('#user_id').val();
      var message = $('#input').val();
      $.ajax
        ({
          type: "POST",
          url: "form_submit.php",
          data: { "name": name,"message": message},
          success: function (data) {
            $('.result').html(data);
            $('#contactform')[0].reset();
          }
        });
    });
  });
</script>
   </head>
   <body class = "container"> 
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
    <textarea class="input" id="input"style="border-top:1px solid gray;"autofocus></textarea>
    <input type="hidden" value="<?php echo $user_id; ?>"id="user_id">
    <button class="send" id="send"></button>
    </form>
  </div>
</div>
    </body>
    </html>
    