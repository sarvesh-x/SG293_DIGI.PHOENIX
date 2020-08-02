<style>
	.card{
		padding:10px;
	}
</style>
<?php
$stmt=$db_con->prepare("SELECT COUNT(tender_master.t_id) as total_tender FROM tender_master");
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	  $total_tender=$row['total_tender'];
	  
	  $s=$db_con->prepare("SELECT COUNT(tender_master.t_id) as c_tender FROM tender_master WHERE tender_master.t_type='Current Tender'");
	$s->execute();
	$r=$stmt->fetch(PDO::FETCH_ASSOC);
	  $c_tender=$r['c_tender'];
?>
<div class="container-fluid">
   	 <div class="row clearfix">
                <div class="col-xs-12 col-sm-3">
                    <div class="card"><h5 >Total Tenders</h5> <i class="material-icons" style="float:right;font-size:50px">business</i>
                    	<hr>
					<h5><?php echo $total_tender; ?></h5>

                    </div>
				</div>
				<div class="col-xs-12 col-sm-3">
                    <div class="card"><h5>Ongoing Tenders</h5>
<i class="material-icons" style="float:right;font-size:50px;color:orange;">business</i>
                    	<hr>  
						<h5><?php echo $total_tender; ?></h5>
                    </div>
				</div>
				<div class="col-xs-12 col-sm-3">
                    <div class="card"><h5>Upcoming Tenders</h5><i class="material-icons" style="float:right;font-size:50px;color:lightgray;">business</i><hr>  

					<h5>0</h5>
                    </div>
				</div>

				<div class="col-xs-12 col-sm-3">
                    <div class="card"><h5>Completed Tenders</h5> <i class="material-icons" style="float:right;font-size:50px;color:green;">business</i><hr>  

					<h5>0</h5>
                    </div>
				</div>

</div>

            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                    	<?php
$dataPoints = array();
try{
    $handle = $db_con->prepare('SELECT old_project.year,old_project.project FROM old_project '); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->year, "y"=> $row->project));
    }
	$db_con = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}	
?>
            	<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2",
	title:{
		text: "Project Chart"
	},
	data: [{
		type: "column",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
				</div>
</div>