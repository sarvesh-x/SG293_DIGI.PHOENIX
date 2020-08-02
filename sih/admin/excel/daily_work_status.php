<?php
include('../db/dc.php');
if(isset($_GET['file']))
{
	$file=$_GET['file'];
	$t_id=$_GET['t_id'];
	$from=$_GET['from'];
	$to=$_GET['to'];
}
?>
<table border="1">
<thead>  
<tr><th>Date</th><th>T.Work</th><th>Work%</th><th>Total Emp.</th><th>Present Emp.</th><th>Wages</th><th>Exp.</th><th>R.Late</th><th>Other</th></tr>
</thead>
<?php
$filename=$file;
$query=mysqli_query($db_cnn,"SELECT tender_status.ts_id,tender_status.date,tender_status.today_work,tender_status.total_emp,tender_status.emp_present,tender_status.daily_wages,tender_status.daily_expense,tender_status.reson_late,tender_status.invoice_file,tender_status.other,tender_status.work_completed FROM tender_status WHERE tender_status.t_id='$t_id' AND tender_status.date  between '$from' AND '$to' ORDER by tender_status.ts_id DESC");
$cnt=1;
while ($row=mysqli_fetch_array($query)) {
?>
           <tr><td><?php echo $nice_date = date('d M Y', strtotime( $row['date'] ));?></td>
<td><p><?php echo $row['today_work']; ?></p></td>
<td><?php echo $row['work_completed']; ?>%</td>
<td><?php echo $row['total_emp']; ?></td>
<td><?php echo $row['emp_present']; ?></td>
<td><?php echo $row['daily_wages']; ?></td>
<td><?php echo $row['daily_expense']; ?></td>
<td><p><?php echo $row['reson_late']; ?></p></td>
<td><?php echo $row['other']; ?></td>
</tr>		

<?php 
$cnt++;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
header("Pragma: no-cache");
header("Expires: 0");
} ?>
</table>
