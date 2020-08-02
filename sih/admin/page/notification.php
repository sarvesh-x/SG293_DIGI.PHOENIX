<?php 
if(isset($_GET['id']))
{
    $id=$_GET['id'];
      $stmtss = $db_con->prepare("SELECT notification.n_id,notification.date,notification.subject,notification.message FROM notification WHERE notification.n_id='$id'");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="card"style="padding:30px;">
<h4><?php echo $row['subject']; ?></h4> <span><?php echo $nice_date = date('d M Y', strtotime( $row['date'] ));?></span>
<hr>
<p><?php echo $row['message']; ?></p>

</div>