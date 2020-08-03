<table class="table">
	 <?php 
	 include'../db/dc.php';
     $name=$_GET['id'];
     
     $stmtss = $db_con->prepare("SELECT chat_master.s_id,chat_master.r_id,chat_master.message FROM chat_master WHERE  chat_master.s_id='$name' OR r_id='$name' OR r_id=0  ORDER by chat_master.chat_id DESC LIMIT 20");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){
        $r_id=$row['r_id'];
        $s_id=$row['s_id'];
        $message=$row['message'];
      if($name==$s_id){
          $user_name='';
      }else{
$stmt = $db_con->prepare("SELECT user_master.username,user_master.user_id FROM user_master WHERE user_master.user_id='$s_id'");
        $stmt->execute();
        
        $r=$stmt->fetch(PDO::FETCH_ASSOC);
         $user_name=$r['username'];
         
      }
         ?>
<tr><td style="text-align:<?php if($name==$s_id){echo 'right';}else{echo 'left';} ?>;">
    <div style="background-color:white;padding:5px;box-shadow:1px 1px 10px lightgray;border-radius:5px;">
        <b><?php echo $user_name;?></b>
    <br><?php echo $message; ?><br><br></div></td>
</tr>
<?php 
}
?>
</table>
