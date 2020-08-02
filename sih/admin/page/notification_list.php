<style>
    #fc{
      border-bottom:1px solid teal;
    }
</style>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12">
						<h4>Notification List</b></h4>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
<th width="5%">SN</th>
<th width="20%">Date</th>
                        <th>Subject</th>
						
                    </tr>
                </thead>
                <tbody>
                	 <?php
                	 			 $i=1;
    $stmtss = $db_con->prepare("SELECT notification.n_id,notification.date,notification.subject,notification.message FROM notification ORDER BY notification.n_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><a href="index.php?page=notification&id=<?php echo $row['n_id']; ?>"><?php echo $nice_date = date('d M Y', strtotime( $row['date'] ));?></a></td>
                        <td><a href="index.php?page=notification&id=<?php echo $row['n_id']; ?>"><?php echo $row['subject']; ?></a></td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
			
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
	
