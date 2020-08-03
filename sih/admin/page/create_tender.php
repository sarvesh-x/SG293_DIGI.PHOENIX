<style>
    #fc{
      border-bottom:1px solid teal;
    }
</style>
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
						<h4>Tenders</b></h4>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Tender</span></a>
						<a href="excel/tender.php?file=Tender List" class="btn btn-primary btn-xs pull-right">Download Excel</a>          	
												
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
<th>SN</th>
                        <th>Tender Name</th>
						<th>Image</th>
						<th>Name</th>
						<th>Issue Date</th>
						<th>Due Date</th>
						<th>Budget</th>
						<th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                	 <?php
                	 date_default_timezone_set('Asia/Kolkata');
						 $dt=date('Y-m-d');
						
                	 if(isset($_POST['ap']))
                	 {
                	   $t_id=$_POST['t_id'];
                	    $ex_b=$_POST['ex_b'];
                	    $t_budget=$_POST['t_budget'];
                	    $ex_b=$ex_b+$t_budget;
                	    $stmtsss = $db_con->prepare("UPDATE tender_master SET tender_master.t_budget='$ex_b',tender_master.approval_exp_budget='Approved' WHERE tender_master.t_id='$t_id'");
        $stmtsss->execute();
                	    $stmtssa = $db_con->prepare("INSERT INTO notification(notification.t_id,notification.date,notification.message,notification.subject)VALUES('$t_id','$dt','Dear Sir your Request Accepted','Tender')");
						$stmtssa->execute();
						echo "<script>
		   alert('Successfully updated');
		   window.location.replace('index.php?page=create_tender');
		   </script>";	 
                	 }
                	  if(isset($_POST['not_ap']))
                	 {
                	    $t_id=$_POST['t_id'];
                	    $stmtssa = $db_con->prepare("UPDATE tender_master SET tender_master.approval_exp_budget='Not approved' WHERE tender_master.t_id='$t_id'");
						$stmtssa->execute();
                	    $stmtssa = $db_con->prepare("INSERT INTO notification(notification.t_id,notification.date,notification.message,notification.subject)VALUES('$t_id','$dt','Dear Sir your Request Not accepted','Tender')");
		$stmtssa->execute();	
echo "<script>
		   alert('Successfully updated');
		   window.location.replace('index.php?page=create_tender');
		   </script>";	 		
                	 }
					 $i=1;
    $stmtss = $db_con->prepare("SELECT tender_master.t_image,tender_master.t_id,tender_master.t_name,tender_master.t_issue_date,tender_master.t_due_date,tender_master.t_budget,tender_master.t_type,tender_master.t_o_name,tender_master.exp_budget,tender_master.exp_budget_desc,tender_master.approval_exp_budget FROM tender_master ORDER BY tender_master.t_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><?php echo $row['t_name']; ?></td>
                        <td><a href="#" data-toggle="modal" onclick="myFunctionp(<?php echo $row['t_id']; ?>)"><img src="upload/<?php echo $row['t_image']; ?>"style="width:50px;height:50px;"></a></td>
        <td><?php echo $row['t_o_name']; ?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_issue_date'] ));?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_due_date'] ));?></td>
						<td>Rs.  <?php $t=$row['t_budget'];
							$exp_b=$row['approval_exp_budget']; 
						$e=$row['exp_budget'];
						if($exp_b=='Approved'){
						echo $b=$t-$e;echo'+';echo $e;echo '=';echo $t;
						}else{
						    echo $t;
						}
					if($exp_b=='Under process'){
						?>
						<div style="padding:0px;">
						    <form action="" method="POST">
						<p>Rs.<input type="text" value="<?php echo $row['exp_budget']; ?>" name="ex_b"></p>
						<input type="hidden" name="t_id" value="<?php echo $row['t_id']; ?>">
						<input type="hidden" name="t_budget" value="<?php echo $row['t_budget']; ?>">
						<input type="submit" name="ap" value="Approved" class="btn">
						<input type="submit" name="not_ap" value="Note approved" class="btn">
						
			            </form>
			            <p>
			                <br>
			            <?php echo $row['exp_budget_desc']; ?>
						</p>    
						    
						    
						</div>
						<?php }?>
						</td>
						<td><?php echo $row['t_type']; ?></td>                 <td>
                            <a href="#" class="edit" data-toggle="modal" onclick="myFunctions(<?php echo $row['t_id']; ?>)"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" onclick="myFunction(<?php echo $row['t_id']; ?>)" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
    document.location.href = 'model/page_action.php?act=tender_del&id='+id;
  }
}
</script>               </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
			<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='POST' action='image_upload.php' enctype="multipart/form-data">
         <input type="hidden" name="id"id="iis">
          Select file : <input type='file' name='upload_image' id='file' class='form-control' ><br>
          <input type='submit' class='btn btn-info' value='Upload' id='btn_upload' name="t_o_upload">
        </form>

        <!-- Preview-->
        <div id='preview'></div>
      </div>
 
    </div>

  </div>
</div>
<!----Imgae Upload-->
            <script>
function myFunctions(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("readUserDetails.php?d=tender", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#name").val(user.t_name);
            $("#t_o_name").val(user.t_o_name);
            $("#details").val(user.t_details); 
            $("#issue_date").val(user.t_issue_date); 
            $("#due_date").val(user.t_due_date); 
            $("#budget").val(user.t_budget);
            $("#range").val(user.r);
             $("#id").val(user.t_id);           
            
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
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="model/page_action.php" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Add Tender</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Tender name</label>
							<input type="text" class="form-control" name="name" required id="fc">
						</div>
						<div class="form-group">
							<label>Tender Owner name</label>
							<input type="text" class="form-control" name="t_o_name" required id="fc">
						</div>
						<div class="form-group">
							<label>Login Id</label>
							<input type="text" class="form-control" name="login_id" required id="fc">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" required id="fc">
						</div>
						<div class="form-group">
							<label>Issue Date</label>
							<input type="date" class="form-control" name="issue_date" required id="fc">
						</div>
						
						<div class="form-group">
							<label>Due Date</label>
							<input type="date" class="form-control" name="due_date" required id="fc">
						</div>
						
						<div class="form-group">
							<label>Tender Budget</label>
							<input type="number" class="form-control" name="budget" required id="fc">
						</div>
						<div class="form-group">
							<label>Range</label>
				<select class="form-control" name="range" required id="fc">
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				</select>
						</div>
						<br>
						<br>
					
					<div class="form-group">
							<label>Tender Details</label>
							<textarea class="form-control"name="details" id="fc" ></textarea>
						</div>
				
							<input type="hidden" class="form-control" name="cmp_code" required value="<?php echo $cmp_code; ?>">
											
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add" name="tender_add">
					</div>
				</form>
			</div>
		</div>
	</div>
	 <!-- Edit Modal HTML -->
  <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
       <form class="form-horizontal" action="model/page_action.php" method="post">
          <div class="modal-header">            
            <h4 class="modal-title">Edit Tender</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Tender name</label>
              <input type="text" class="form-control"id="name" name="name" required >
            </div>
            <div class="form-group">
              <label>Tender Owner name</label>
              <input type="text" class="form-control"id="t_o_name" name="t_o_name" required >
            </div>
            <div class="form-group">
              <label>Issue Date</label>
              <input type="date" class="form-control"id="issue_date" name="issue_date" required >
            </div>
            
            <div class="form-group">
              <label>Due Date</label>
              <input type="date" class="form-control"id="due_date" name="due_date" required >
            </div>
            <div class="form-group">
              <label>Tender Budget</label>
              <input type="text" class="form-control"id="budget" name="budget" required >
            </div>
            
            <div class="form-group">
              <label>Range</label>
              <input type="number" class="form-control"id="range" name="range" required >
            </div>
            
            <div class="form-group">
              <label>Details</label>
			  <textarea class="form-control"name="details"id="details"  ></textarea>
            </div>
               <input type="hidden" class="form-control" name="id" id="id" required>
             </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" name="tender_update" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
	

	
