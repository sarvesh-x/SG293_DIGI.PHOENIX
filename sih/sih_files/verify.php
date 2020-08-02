<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {

 $t_id = $_POST['t_id'];
 $ImageData = $_POST['image_path'];
 $ImageName = $_POST['image_name'];
 $Lat_Long = $_POST['lat_long'];
 $ImagePath = "Uploads/VerificationImages/$ImageName.png";

 
  $sqls = "UPDATE tender_master SET tender_master.lat_long='$Lat_Long', tender_master.vp='Yes',image='$ImageName' WHERE tender_master.t_id='$t_id'";
  
 
 if(mysqli_query($connection,$sqls)){
 file_put_contents($ImagePath,base64_decode($ImageData));
 echo "Verification Successfull";
 } else
    echo "Error Verifiying Location";
 
 mysqli_close($connection);
 }else{
 echo "Not Uploaded";
 }

?>