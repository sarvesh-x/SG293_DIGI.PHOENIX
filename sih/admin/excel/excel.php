<?php
include('../db/dc.php');
if(isset($_GET['file']))
{
	$file=$_GET['file'];
}
?>
<?php if($file=='App User'){
	?>
<table border="1">
<thead>  
<tr>
<th>Sr.</th>
<th>User Id</th>
<th>Tender Name</th>
<th>Login Id</th>
<th>Password</th>
<th>Status</th>
</tr>
</thead>
<?php
$filename="App User";
$query=mysqli_query($db_cnn,"SELECT users.id,users.name,users.email,users.password FROM users ORDER BY users.id DESC");
$cnt=1;
while ($row=mysqli_fetch_array($query)) {
?>
            <tr>
                <td><?php echo $cnt;  ?></td>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['password'];?></td>
                <td><?php echo $row['status'];?></td>
            </tr>

<?php 
$cnt++;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
header("Pragma: no-cache");
header("Expires: 0");
} ?>
</table>
<?php } ?>