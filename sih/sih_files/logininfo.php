<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $Email = $_POST['email'];
 $Password = $_POST['password'];
 
$query = "Select * from users where email='$Email' and password = '$Password' ";

$result = mysqli_query($connection, $query)

or die("Error in Selecting " . mysqli_error($connection));

while($row =mysqli_fetch_assoc($result))
{
    $emparray[] = $row;
}
//print_r($emparray);
echo json_encode($emparray);
//close the db connection
mysqli_close($connection);
?>