<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $t_id = $_POST['t_id'];
 $exp_budget = $_POST['exp_budget'];
 $exp_budget_desc = $_POST['exp_budget_desc'];
 $exp_budget_status = $_POST['status'];
 
    $query = "SELECT `approval_exp_budget` FROM `tender_master` WHERE t_id = '3'";
    $result = $conn->query($query);
   
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["approval_exp_budget"];
  }
} else {
  echo "0 results";
}
mysqli_close($connection);
?>