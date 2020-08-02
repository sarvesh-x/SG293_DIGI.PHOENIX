<?php
include('../db/dc.php');
if(isset($_GET['file']))
{
	$file=$_GET['file'];
}
?>
<table border="1">
<thead>  
<tr>
<th>SN</th>
                        <th style="width:10%;">Tender Id</th>
						<th>Tender Name</th>
                        <th>Contractor</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                    </tr>
</thead>
<?php
$filename="Todat pending Work Status Report";
date_default_timezone_set('Asia/Kolkata');
						$date=date('Y-m-d');
						
$query=mysqli_query($db_cnn,"SELECT *  FROM tender_master WHERE tender_master.t_id NOT IN (SELECT tender_status.t_id FROM tender_status WHERE tender_status.date='$date' GROUP BY tender_status.t_id)");
$cnt=1;
while ($row=mysqli_fetch_array($query)) {
?>
            <tr>
                <td><?php echo $cnt;  ?></td>
                <td><?php echo $row['t_id']; ?></td>
                        	<td><?php echo $row['t_name']; ?></td>
                        	<td><?php echo $row['t_o_name']; ?></td>
                        	<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_issue_date'] ));?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_due_date'] ));?></td>
</tr>
<?php 
$cnt++;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
header("Pragma: no-cache");
header("Expires: 0");
} ?>
</table>
