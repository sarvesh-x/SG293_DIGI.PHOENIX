<table class="table">
	 <?php 
	 include'db/dc.php';
    $name=$_GET['id'];
    $stmtss = $db_con->prepare("SELECT chat_master.chat_id,chat_master.s_id,chat_master.r_id,chat_master.message,chat_master.status,chat_master.date_time,chat_master.file FROM chat_master WHERE chat_master.s_id='$name' or chat_master.r_id='$name' ORDER by chat_master.chat_id DESC LIMIT 20");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){
        $r_id=$row['r_id'];
        $s_id=$row['s_id'];
      if($name==$s_id){
          $user_name='';
          $as='';
          $t_name='';
      }else{
$stmt = $db_con->prepare("SELECT tender_master.t_id,tender_master.t_name,tender_master.t_o_name,tender_master.t_image FROM tender_master WHERE tender_master.t_id='$s_id'");
        $stmt->execute();
        $r=$stmt->fetch(PDO::FETCH_ASSOC);
         $user_name=$r['t_o_name'];
         $image=$r['t_image'];
         $t_name=$r['t_name'];
         $as=$s_id;
      }
         ?>
<tr><td style="text-align:<?php if($name==$s_id){echo 'right';}else{echo 'left';} ?>;">
     <a href="student_chat.php?id=<?php echo $name; ?>&a=<?php echo $as; ?>"style="color:black;">
    <div style="background-color:white;padding:5px;box-shadow:1px 1px 10px lightgray;border-radius:5px;">
    <img src="api/image/<?php echo $image; ?>"style="width:50px;height:50px;border-radius:50%;padding:2px;border:2px solid lightgray;float:left;margin-right:5px;display:<?php if($name==$s_id){echo 'none';}else{echo 'block';} ?>;">
       <b><?php echo $user_name; ?></b>
<?php if($t_name<>''){echo '-';echo $t_name;} ?>    <br><?php echo $row['message']; ?><br><input type="checkbox"><br></div></a></td>
</tr>
<?php 
}
?>
</table>
