<?php

include 'DatabaseConfig.php';

 $connection = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

 $Email = $_POST['email'];
 $Password = $_POST['password'];
 
$query = "Select * from user_master where email='$Email' and password = '$Password' and type = 'Third Party'";
$sql = "select * from users";
$result = mysqli_query($connection, $query)

or die("Error in Selecting " . mysqli_error($connection));

while($row =mysqli_fetch_assoc($result))
{
    $emparray[] = $row;
}

echo json_encode($emparray);
mysqli_close($connection);
?>