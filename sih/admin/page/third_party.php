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
						<h4>Third Party</b></h4>
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
                        <th>Name</th>
						<th>Image</th>
					<th>Tender Allocation</th>
						<th>Login Id</th>
						<th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                	 <?php
           
					 $i=1;
    $stmtss = $db_con->prepare("SELECT user_master.user_id,user_master.username,user_master.email,user_master.password,user_master.image FROM user_master WHERE user_master.type='Third Party' ORDER by user_master.user_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><a href="#" data-toggle="modal" onclick="myFunctionp(<?php echo $row['user_id']; ?>)"><img src="upload/<?php echo $row['image']; ?>"style="width:50px;height:50px;"></a></td>
						<td><a href="index.php?page=third_party_allocation&id=<?php echo $row['user_id']; ?>&name=<?php echo $row['username']; ?>">Check</a></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['password']; ?></td>
						<td><a href="#" class="edit" data-toggle="modal" onclick="myFunctions(<?php echo $row['user_id']; ?>)"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" onclick="myFunction(<?php echo $row['user_id']; ?>)" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
    document.location.href = 'model/page_action.php?act=third_party&id='+id;
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
          <input type='submit' class='btn btn-info' value='Upload' id='btn_upload' name="third_party_upload">
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
							<label>Name</label>
							<input type="text" class="form-control" name="name" required id="fc">
						</div>
						
						<div class="form-group">
							<label>Login Id</label>
							<input type="text" class="form-control" name="login_id" required id="fc">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" required id="fc">
						</div>
						
							<input type="hidden" class="form-control" name="cmp_code" required value="<?php echo $cmp_code; ?>">					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add" name="third_add">
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
	
