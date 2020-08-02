<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
include 'DatabaseConfig.php';
 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 $lat_long = $_POST['lat_long'];
 $t_id= $_POST['t_id']; 
 
 $SQLQuery = "UPDATE tender_master set tender_master.lat_long='$lat_long',tender_master.vp='Yes' WHERE tender_master.t_id='$t_id'";

if(mysqli_query($connection,$SQLQuery))
{
   echo 'Details Uploaded Succesfully!';
}
else
{
   echo 'Error Occurred While Updating';
 }
}
mysqli_close($connection);
?>