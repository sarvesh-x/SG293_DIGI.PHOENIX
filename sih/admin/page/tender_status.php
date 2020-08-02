
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12">
						<h4>Tender Status</b></h4>
					</div>
					
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
<th>SN</th>
                        <th>Name</th>
						<th>Issue Date</th>
						<th>Due Date</th>
						<th>Budget</th>
						<th>Type</th>
                        <th>Click</th>
                    </tr>
                </thead>
                <tbody>
                	 <?php 
					 $i=1;
    $stmtss = $db_con->prepare("SELECT tender_master.t_id,tender_master.t_name,tender_master.t_issue_date,tender_master.t_due_date,tender_master.t_budget,tender_master.t_type FROM tender_master ORDER BY tender_master.t_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><?php echo $row['t_name']; ?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_issue_date'] ));?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_due_date'] ));?></td>
						<td><?php echo $row['t_budget']; ?></td>
						<td><?php echo $row['t_type']; ?></td>                 <td>
                            <a href="index.php?page=tender_status_details&t_id=<?php echo $row['t_id']; ?>&t_name=<?php echo $row['t_name']; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">timeline</i>Check</a>
                            
              </td>
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
          <input type='submit' class='btn btn-info' value='Upload' id='btn_upload' name="category_image_upload">
        </form>

        <!-- Preview-->
        <div id='preview'></div>
      </div>
 
    </div>

  </div>
</div>
<!----Imgae Upload-->
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
	
  <script>
function myFunctions(id) {

    $("#editEmployeeModal").modal("show");
}
</script>
	 <!-- Edit Modal HTML -->
  <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
SS
        </div>
        </div>
    </di>
