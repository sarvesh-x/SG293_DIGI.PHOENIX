<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    
include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $tender_id = $_POST['tender_id'];
 $date= $_POST['date']; 
 $todays_work= $_POST['todays_work'];
 $total_emp= $_POST['total_emp'];
 $emp_present= $_POST['emp_present'];
 $daily_wages= $_POST['daily_wages'];
 $daily_exp= $_POST['daily_exp'];
 $reason= $_POST['reason'];
 $other= $_POST['other'];
 $work_completed = $_POST['work_completed'];
 $date= date('Y-m-d', strtotime( $date ));
 $SQLQuery = "INSERT INTO `tender_status`(`t_id`, `date`, `today_work`, `total_emp`, `emp_present`, `daily_wages`, `daily_expense`, `reson_late`, `other`,`work_completed`) VALUES ('$tender_id','$date','$todays_work','$total_emp','$emp_present','$daily_wages','$daily_exp','$reason','$other','$work_completed') ";
 
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