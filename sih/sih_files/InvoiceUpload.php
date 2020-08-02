<?php

 include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $ts_id = $_POST['ts_id'];
    $file_path = "Uploads/Invoices/";
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    
    $file_name = basename($_FILES['uploaded_file']['tmp_name']);
    
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path) ){
        
        echo "success";
        $sqls = "UPDATE tender_status SET tender_status.invoice_file='$file_name' WHERE tender_status.ts_id='$ts_id'";
        mysqli_query($connection,$sqls);
  
    } else{
        echo "fail";
    }
 }
 ?>