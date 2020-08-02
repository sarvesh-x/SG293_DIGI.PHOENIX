<?php 
include'../db/dc.php';
if(isset($_GET['id']))
{
$id=$_GET['id'];    
}
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
     <div class="row">  
    <div class="col s12">  
    <table class="table>">
  <thead>
                    <tr>
<th>SN</th>
                        <th>Name</th>
						<th>Issue Date</th>
						<th>Due Date</th>
                        <th>Click</th>
                    </tr>
                </thead>
                <tbody>
                	 <?php 
					 $i=1;
    $stmtss = $db_con->prepare("SELECT tender_master.t_id,tender_master.t_name,tender_master.t_issue_date,tender_master.t_due_date,tender_master.t_budget,tender_master.t_type FROM on_sider_allocation JOIN tender_master on tender_master.t_id=on_sider_allocation.t_id WHERE on_sider_allocation.user_id='$id' ORDER BY on_sider_allocation.t_id DESC");
        $stmtss->execute();
        while($row=$stmtss->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
						<td><?php echo $i++; ?></td>
                        <td><?php echo $row['t_name']; ?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_issue_date'] ));?></td>
						<td><?php echo $nice_date = date('d M Y', strtotime( $row['t_due_date'] ));?></td>
 <td>
                            <a href="tender_details.php?t_id=<?php echo $row['t_id']; ?>&t_name=<?php echo $row['t_name']; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">timeline</i>Check</a>
              </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
    </div>  
    </div>
   </body>  
</html>  