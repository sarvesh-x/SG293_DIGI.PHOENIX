<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 $ts_id  = $_POST['ts_id'];
 $ImageData = $_POST['image_path'];
 $ImageName = $_POST['image_name'];
 $Lat_Long = $_POST['lat_long'];
 $ImagePath = "Uploads/OnSiteWorkImages/$ImageName.png";
 $sql = "INSERT INTO `onworksiteimages`(`ts_id`, `image_name`, `lat_long`) VALUES ('$ts_id','$ImageName','$Lat_Long')";
 
  $sqls = "UPDATE tender_status SET tender_status.lat_long='$Lat_Long' WHERE tender_status.ts_id='$ts_id'";
  mysqli_query($connection,$sqls);
 
 if(mysqli_query($connection,$sql)){
 file_put_contents($ImagePath,base64_decode($ImageData));
 echo "Your Image Has Been Uploaded.";
 } else
    echo "Error Uploading Image";
 
 mysqli_close($connection);
 }else{
 echo "Not Uploaded";
 }

?>