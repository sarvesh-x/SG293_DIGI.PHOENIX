<?php 
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$name=$_GET['name'];
}
?>
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
						<h4><?php echo $name; ?></b></h4>
						<p>Tender Allocation</p>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New </span></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>SN</th>
                        <th>Tender Name</th>
                        <th>Status</th>
						<th>Issue Date</th>
						<th>Due Date</th>
						<th>Budget</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                	 <?php
           
					 $i=1;
    $stmtss = $db_con->prepare("SELECT on_sider_allocation.t_id,on_sider_allocation.os_id,tender_master.t_name,tender_master.t_issue_date,tender_master.t_due_date,tender_master.t_due_date,tender_master.t_budget FROM on_sider_allocation JOIN tender_master on tender_master.t_id=on_sider_allocation.t_id WHERE on_sider_allocation.user_id='$id' ORDER by on_sider_allocation.os_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><?php echo $row['t_name']; ?></td>
                        <td><a href="index.php?page=third_party_survey&id=<?php echo $id; ?>&t_id=<?php echo $row['t_id']; ?>&t_name=<?php echo $row['t_name']; ?>&name=<?php echo $name; ?>">Check</a></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_issue_date'] ));?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_due_date'] ));?>	</td>
 
						<td><?php echo $row['t_budget']; ?></td>
						<td>
                            <a href="#" onclick="myFunction(<?php echo $row['os_id']; ?>,<?php echo $id; ?>)" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
<script>
function myFunctionp(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    
 $("#iis").val(id);
    // Open modal popup
    $("#uploadModal").modal("show");
}
function myFunction(id,i) {
  if(confirm("Are you sure want to delete this ?")){
    document.location.href = 'model/page_action.php?act=tender_allocation&id='+id+'&i='+i;
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
    $.post("readUserDetails.php?d=third_party", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
			$("#name").val(user.username);
			$("#email").val(user.email);
			$("#password").val(user.password);
             $("#id").val(user.user_id);           
            
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
						<h4 class="modal-title">Add</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
<select name="t_id">
                	 <?php   
					 $i=1;
    $stmtss = $db_con->prepare("SELECT tender_master.t_id,tender_master.t_name,tender_master.t_o_name FROM tender_master WHERE tender_master.t_id NOT IN (SELECT on_sider_allocation.t_id FROM on_sider_allocation)");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
<option value="<?php echo $row['t_id']; ?>"><?php echo $row['t_name']; ?>/<?php echo $row['t_o_name']; ?></option>		
		<?php }?>
</select>						
						
						</div>
						
							<input type="hidden" class="form-control" name="cmp_code" required value="<?php echo $cmp_code; ?>">
<input type="hidden" class="form-control" name="th_id" required value="<?php echo $id; ?>">
<input type="hidden" class="form-control" name="name" required value="<?php echo $name; ?>">							
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add" name="tender_allocation">
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
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control"id="name" name="name" required >
            </div>
			<div class="form-group">
              <label>Login Id</label>
              <input type="text" class="form-control"id="email" name="email" required >
            </div>
			<div class="form-group">
              <label>Password</label>
              <input type="text" class="form-control"id="password" name="password" required >
            </div>
                <input type="hidden" class="form-control" name="id" id="id" required>
             </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" name="third_update" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
	
