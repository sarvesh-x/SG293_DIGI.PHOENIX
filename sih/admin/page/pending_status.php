<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>


        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h4>Today pending Work Status Report</b></h4>
					</div>
					<div class="col-sm-6">
					<a href="excel/pending.php" class="btn btn-primary btn-xs pull-right">Download Excel</a>
												
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
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
                <tbody>
                	 <?php
                	 date_default_timezone_set('Asia/Kolkata');
						$date=date('Y-m-d');
					 $i=1;
    $stmtss = $db_con->prepare("SELECT *  FROM tender_master WHERE tender_master.t_id NOT IN (SELECT tender_status.t_id FROM tender_status WHERE tender_status.date='$date' GROUP BY tender_status.t_id)");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><?php echo $row['t_id']; ?></td>
                        	<td><?php echo $row['t_name']; ?></td>
                        	<td><?php echo $row['t_o_name']; ?></td>
                        	<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_issue_date'] ));?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_due_date'] ));?></td>
                         <td>
<script>
function myFunctionp(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    
 $("#iis").val(id);
    // Open modal popup
    $("#uploadModal").modal("show");
}
function myFunction(id) {
  if(confirm("Are you sure want to delete this ?")){
    document.location.href = 'model/page_action.php?act=city&id='+id;
  }
}
</script>               </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        <script>
function myFunctions(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("readUserDetails.php?d=city", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#name").val(user.city_name);
            $("#email").val(user.details); 
             $("#id").val(user.id);           
            
        }
    );
    // Open modal popup
    $("#editEmployeeModal").modal("show");
}
</script>
			<div class="clearfix">

                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item "><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>