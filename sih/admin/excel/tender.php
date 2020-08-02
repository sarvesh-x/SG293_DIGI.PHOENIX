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
<th>Tender Name</th>
<th>Name</th>
<th>Issue Date</th>
<th>Due Date</th>
<th>Budget</th>
<th>Type</th>
</tr>
</thead>
<?php
$filename=$file;
$query=mysqli_query($db_cnn,"SELECT tender_master.t_image,tender_master.t_id,tender_master.t_name,tender_master.t_issue_date,tender_master.t_due_date,tender_master.t_budget,tender_master.t_type,tender_master.t_o_name,tender_master.exp_budget,tender_master.exp_budget_desc,tender_master.approval_exp_budget FROM tender_master ORDER BY tender_master.t_id DESC");
$cnt=1;
while ($row=mysqli_fetch_array($query)) {
?>
            <tr>
                <td><?php echo $cnt;  ?></td>
                <td><?php echo $row['t_name'];?></td>
                <td><?php echo $row['t_o_name'];?></td>
                <td><?php echo $nice_date = date('d M Y', strtotime( $row['t_issue_date'] ));?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_due_date'] ));?></td>
                <td><?php echo $row['t_budget'];?></td>
                <td><?php echo $row['t_type'];?></td>
            </tr>

<?php 
$cnt++;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
header("Pragma: no-cache");
header("Expires: 0");
} ?>
</table>
