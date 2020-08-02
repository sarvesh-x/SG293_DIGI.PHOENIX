<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $t_id = $_POST['t_id'];
 $exp_budget = $_POST['exp_budget'];
 $exp_budget_desc = $_POST['exp_budget_desc'];
 $exp_budget_status = $_POST['status'];
 
    $query = "UPDATE `tender_master` SET `exp_budget`='$exp_budget',`exp_budget_desc`='$exp_budget_desc',`approval_exp_budget`='$exp_budget_status' WHERE t_id = '$t_id'";

            if (mysqli_query($connection, $query))
                 {
                     echo "Sccessfully Made Request!";
                 }else
                 {
                   echo "Error Making Request!";
                 }
mysqli_close($connection);
?>