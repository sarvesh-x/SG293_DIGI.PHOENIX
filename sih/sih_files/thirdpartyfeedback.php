<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    
include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $t_id = $_POST['t_id'];
 $date = $_POST['date']; 
 $feedback = $_POST['feedback'];
 
 $SQLQuery = "INSERT INTO `thirdpartyfeedback`(`t_id`, `date`, `feedback`) VALUES ('$t_id','$date','$feedback') ";
 
if(mysqli_query($connection,$SQLQuery))
{
  
    echo 'Feedback Submitted Successfully';
}
else
{
 echo 'Error Occurred While Submitting';
 }
}
mysqli_close($connection);
?>