<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $t_id = $_POST['t_id'];
 
$query = "Select * from tender_status where t_id = '$t_id' ";

$result = mysqli_query($connection, $query)

or die("Error in Selecting " . mysqli_error($connection));

while($row =mysqli_fetch_assoc($result))
{
    $emparray[] = $row;
}

echo json_encode($emparray);
mysqli_close($connection);
?>