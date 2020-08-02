<?php 
include'../db/dc.php';
?>
<!DOCTYPE html>  
<html>  
   <head>  
      <title></title>  
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">        
      <link rel = "stylesheet"  
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">  
      <link rel = "stylesheet"   
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">  
      <script type = "text/javascript"  
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>             
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">  
      </script>   
   </head>  
   <body class = "container">   
         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php
if(isset($_GET['t_id']))
{
$t_id=$_GET['t_id'];   
$t_name=$_GET['t_name'];
  
$stmts = $db_con->prepare("SELECT tender_master.t_budget,tender_master.exp_budget FROM tender_master WHERE tender_master.t_id='$t_id'");
        $stmts->execute();
        $r=$stmts->fetch(PDO::FETCH_ASSOC); 
		$t_budget=$r['t_budget'];
		$exp_budget=$r['exp_budget'];
		$budget=$t_budget-$exp_budget;
		$ext_budget=$exp_budget/$budget*100;
 
 $stmtss = $db_con->prepare("SELECT sum(tender_status.today_work) as wc,sum(tender_status.daily_wages) as dw,sum(tender_status.daily_expense) as de,SUM(tender_status.emp_present) as emp,sum(tender_status.total_emp) as temp,COUNT(tender_status.ts_id) as nofd FROM tender_status WHERE tender_status.t_id='$t_id'");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC); 
		$nofd=$row['nofd'];
		$wc=$row['wc'];
		$work_complete=$wc/$nofd;
		$dw=$row['dw'];$de=$row['de'];
		$total_exp=$dw+$de;		
		$eb=$total_exp/$t_budget*100;
		$emp=$row['emp'];
		$temp=$row['temp'];
		$emp=$emp/$temp*100;
}
date_default_timezone_set('Asia/Kolkata');
$dt=date('Y-m-d');
$from= date('Y-m-', strtotime($dt));
$from=$from.'1';
$to=$dt;
if(isset($_GET['ts_id']))
{
	$ts_id=$_GET['ts_id'];
	 $stmtss = $db_con->prepare("SELECT tender_status.ts_id,tender_status.date,tender_status.today_work,tender_status.total_emp,tender_status.emp_present,tender_status.daily_wages,tender_status.daily_expense,tender_status.reson_late,tender_status.invoice_file,tender_status.other,tender_status.lat_long FROM tender_status WHERE tender_status.ts_id='$ts_id' ORDER by tender_status.ts_id DESC");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC); 
		$lat_long=$row['lat_long'];
		$ts_id=$row['ts_id'];
		$date=$row['date'];
}else{
	 $stmtss = $db_con->prepare("SELECT tender_status.date,tender_status.ts_id,tender_status.lat_long FROM tender_status WHERE tender_status.t_id='$t_id' ORDER BY tender_status.ts_id DESC LIMIT 1");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC); 
		$lat_long=$row['lat_long'];
		$ts_id=$row['ts_id'];
		$date=$row['date'];
}
if(isset($_POST['search']))
{
	 $from=$_POST['from'];
	 $to=$_POST['to'];
	
}
?>
<style>
* {
  box-sizing: border-box;
}
.im:hover {
  -ms-transform: scale(8.5); /* IE 9 */
  -webkit-transform: scale(8.5); /* Safari 3-8 */
  transform: scale(1.5); 
}
</style>
        
                <div class="row">
                    <div class="col-sm-12">
					<h6 style="color:black;float:left;"><b style="color:gray;"><?php echo $t_name; ?> </b>Status <p><?php echo date('d-m-y', strtotime($date)); ?></p></h6>
<form action=""method="POST"style="float:right;">
<input type="date" name="from" value="<?php echo $dt; ?>">
<input type="date" name="to"class="form-controal"value="<?php echo $dt; ?>">
<input type="submit" name="search" value="search"class="btn">

</form>
<script>
function goBack() {
  window.history.back();
}
</script> 
					</div>
                </div>
				<!----Header--->
<div class="row">
<div class="col-sm-6">
</div>
<div class="col-sm-6">
</div>
</div>
<!----First--->
<div class="row">
<div class="col-sm-3"style="padding:3px;">
   <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Pendding',     <?php echo $b=100-$work_complete; ?>],
          ['Complete',      <?php echo $work_complete; ?>],
          
        ]);

        var options = {
          title: 'Work completed in %',
          pieHole: 0.4,
		   colors: ['lightgray', 'gray']
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
   <div id="donutchart" style="width: 100%; height: 200px;"></div>
</div>
<div class="col-sm-3"style="padding:3px;">
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Pendding',      <?php echo $b=100-$emp; ?>],
          ['Complete',       <?php echo $emp; ?>],
        ]);

        var options = {
          title: 'Monthly emp present',
          pieHole: 0.4,
		  colors: ['lightgray', 'gray']
        };
        var chart = new google.visualization.PieChart(document.getElementById('Monthly'));
        chart.draw(data, options);
      }
    </script>
   <div id="Monthly" style="width: 100%; height: 200px;"></div>
</div>
<div class="col-sm-3"style="padding:3px;">
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Balance',      <?php echo $b=100-$eb; ?> ],
          ['Exhaust',<?php echo $eb; ?>],
        ]);

        var options = {
          title: 'Exhaust Budget',
          pieHole: 0.4,
		  colors: ['lightgray', 'gray']
        };
        var chart = new google.visualization.PieChart(document.getElementById('Exhaust'));
        chart.draw(data, options);
      }
    </script>
   <div id="Exhaust" style="width: 100%; height: 200px;"></div>
</div>
<div class="col-sm-3"style="padding:3px;">
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Pendding',     <?php echo $b=100-$ext_budget; ?>],
          ['Complete',      <?php echo $ext_budget; ?>],
        ]);

        var options = {
          title: 'Expand Budget',
          pieHole: 0.4,
		  colors: ['lightgray', 'gray']
        };
        var chart = new google.visualization.PieChart(document.getElementById('Expand'));
        chart.draw(data, options);
      }
    </script>
   <div id="Expand" style="width: 100%; height: 200px;"></div>
</div>
</div>	
<!----Second--->
	<div class="row">
	<div class="col-sm-12"style="padding:10px;">

	</div>
	</div>
<!----Second--->
<div class="row">
<div class="col-sm-12"style="padding:5px;box-shadow:1px 1px 10px lightgray;">
 	<?php
$dataPoints = array();
try{
    $handle = $db_con->prepare("SELECT tender_status.date,tender_status.work_completed FROM tender_status WHERE tender_status.t_id='$t_id'"); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);	
    foreach($result as $row){
        array_push($dataPoints, array("lable"=>$row->date, "y"=> $row->work_completed));
    }
}
catch(\PDOException $ex){
    print($ex->getMessage());
}	
?>
      <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Daily Work Status"
	},
	axisY: {
		title: "Work"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script><div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	
	</div>
</div><div class="row">
	<div class="col-sm-7"style="padding:5px;box-shadow:1px 1px 10px lightgray;">
<h5>On Side Image</h5>
<?php $stmtss = $db_con->prepare("SELECT onworksiteimages.image_name FROM onworksiteimages WHERE onworksiteimages.ts_id='$ts_id'");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
<div style="width:32.2%;float:left;margin-left:2px;margin-bottom:2px;">
<a href="../sih_files/Uploads/OnSiteWorkImages/<?php echo $row['image_name']; ?>.png"><img src="../sih_files/Uploads/OnSiteWorkImages/<?php echo $row['image_name']; ?>.png"style="width:100%;height:100px;" class="im"></a>
</div>

<?php }?>
	</div>
	<div class="col-sm-5"style="padding:8px;">
<h5>Google Map Location</h5>
<iframe src="https://maps.google.com/maps?q=<?php echo $lat_long; ?>&z=15&output=embed" width="100%" height="300" frameborder="0" style="border:0"></iframe>

	</div>
	
</div>
				
<div class="row">
	<div class="col-sm-12">
	<style>
	table td,th
	{
		font-size:14px;
		padding:2px;marging:0px;
	}
	</style>
	<h5>Days Wise List</h5>
	<table class="table">
	<tr><th>Date</th><th>T.Work</th><th>Work%</th><th>Emp.</th><th>Wages</th><th>Exp.</th><th>R.Late</th><th>Invoice</th><th>Other</th></tr>
	<?php $stmtss = $db_con->prepare("SELECT tender_status.ts_id,tender_status.date,tender_status.today_work,tender_status.total_emp,tender_status.emp_present,tender_status.daily_wages,tender_status.daily_expense,tender_status.reson_late,tender_status.invoice_file,tender_status.other,tender_status.work_completed FROM tender_status WHERE tender_status.t_id='$t_id' AND tender_status.date  between '$from' AND '$to' ORDER by tender_status.ts_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
<tr><td><a href="index.php?page=tender_status_details&t_id=<?php echo $t_id; ?>&t_name=<?php echo $t_name; ?>&ts_id=<?php echo $row['ts_id']; ?>"><?php echo $nice_date = date('d M Y', strtotime( $row['date'] ));?></a></td>
<td><p><?php echo $row['today_work']; ?></p></td>
<td><?php echo $row['work_completed']; ?>%</td>
<td><?php echo $row['emp_present']; ?>/<?php echo $row['total_emp']; ?></td>
<td><?php echo $row['daily_wages']; ?></td>
<td><?php echo $row['daily_expense']; ?></td>
<td><p><?php echo $row['reson_late']; ?></p></td>
<td><a href="../sih_files/Uploads/Invoices/<?php echo $row['invoice_file']; ?>"download>Download</a></td>
<td><?php echo $row['other']; ?></td>
</tr>		
		
		<?php }?>
	</table>	</div>	
</div>  
    
    
     </body>  
</html>  