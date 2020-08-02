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
<?php
if(isset($_GET['status']))
{
 $status=$_GET['status'];
 if($status=='Active'){
     $status='Deactive';
 }else
 {
     $status='Active';
 }
 $id=$_GET['id'];
 
 $stmtss = $db_con->prepare("UPDATE users SET users.status='$status' WHERE users.id='$id'");
        $stmtss->execute();
}
?>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h4>All User List</b></h4>
					</div>
					<div class="col-sm-6">
					<a href="excel/excel.php?file=App User" class="btn btn-primary btn-xs pull-right">Download Excel</a>
												
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
<th>SN</th>
                        <th style="width:10%;">User Id</th>
						<th>Tender Name</th>
                        <th>Login Id</th>
                        <th>Password</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                	 <?php 
					 $i=1;
    $stmtss = $db_con->prepare("SELECT users.id,users.name,users.email,users.password,users.status FROM users ORDER BY users.id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><?php echo $row['id']; ?></td>
                        		<td><?php echo $row['name']; ?></td>
                        		<td><?php echo $row['email']; ?></td>
                        		<td><?php echo $row['password']; ?></td>
                        		<td><a href="index.php?page=all_user&id=<?php echo $row['id']; ?>&status=<?php echo $row['status']; ?>"><?php echo $row['status']; ?></a></td>
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
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="model/page_action.php" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Add New City</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>City Name</label>
							<input type="text" class="form-control" name="name" required>
						</div>
						<div class="form-group">
							<label>Details</label>
							<textarea class="form-control"name="details" ></textarea>
						</div>
				
							<input type="hidden" class="form-control" name="cmp_code" required value="<?php echo $cmp_code; ?>">
											
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add" name="city_add">
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
            <h4 class="modal-title">Edit City</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <label>City name</label>
              <input type="text" class="form-control"id="name" name="name" required >
            </div>
            <div class="form-group">
              <label>Details</label>
			  <textarea class="form-control"name="details"id="email"  ></textarea>
              
            </div>

               <input type="hidden" class="form-control" name="id" id="id" required>
         
             </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" name="city_update" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>
	
