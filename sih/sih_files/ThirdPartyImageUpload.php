<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     
 $t_id  = $_POST['t_id'];
 $ImageData = $_POST['image_path'];
 $ImageName = $_POST['image_name'];
 $Lat_Long = $_POST['lat_long'];
 $ImagePath = "Uploads/ThirdPartyImages/$ImageName.png";
 
 $sql = "INSERT INTO `thirdpartyimages`(`t_id`, `image_name`, `lat_long`) VALUES ('$t_id','$ImageName','$Lat_Long')";
 
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