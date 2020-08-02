<?php
if(isset($_GET['id']))
{
    $t_id=$_GET['t_id'];
    $id=$_GET['id'];
    $t_name=$_GET['t_name'];
    $name=$_GET['name'];
    
          $stmtss = $db_con->prepare("SELECT thirdpartyfeedback.id,thirdpartyfeedback.feedback,thirdpartyfeedback.date,thirdpartyfeedback.lat_long FROM thirdpartyfeedback WHERE thirdpartyfeedback.t_id='$t_id' AND thirdpartyfeedback.tp_id='$id'");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC);
        $ids=$row['id'];
       $lat_long= $row['lat_long'];
}
?>
<h5><?php echo $t_name; ?></h5><p><?php echo $name; ?></p>
<hr>
<div style="padding:20px;font-size:16px;box-shadow:1px 1px 10px lightgray;"><p>
    <b>Feedback </b>  <?php echo $nice_date = date('d M Y', strtotime( $row['date'] ));?><br>
<?php echo $row['feedback']; ?>    
</p>
</div>
<div class="row">
	<div class="col-sm-7"style="padding:10px;">
<h5>On Side Image</h5>
<?php $stmtss = $db_con->prepare("SELECT thirdpartyimages.image_name FROM thirdpartyimages WHERE thirdpartyimages.t_id='$ids'");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
<div style="width:49%;float:left;margin-left:2px;margin-bottom:2px;">
<a href="../sih_files/Uploads/ThirdPartyImages/<?php echo $row['image_name']; ?>"><img src="../sih_files/Uploads/ThirdPartyImages/<?php echo $row['image_name']; ?>"style="width:100%;height:200px;" class="im"></a>
</div>

<?php }?>
	</div>
	<div class="col-sm-5"style="padding:8px;">
<h5>Google Map Location</h5>
<iframe src="https://maps.google.com/maps?q=<?php echo $lat_long; ?>&z=15&output=embed" width="100%" height="300" frameborder="0" style="border:0"></iframe>

	</div>
	
</div>