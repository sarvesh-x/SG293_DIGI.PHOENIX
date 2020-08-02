<div class="card"style="padding:50px;">
    <h5>Database Backup</h5>
<table class="table"style="width:50%;">
<tr>
    <th style="text-align:center"><i class="material-icons">save</i><br>
        <a href="bkp/save.php">Save Online Server</a></th>
    <th style="text-align:center"><i class="material-icons">file_download</i><br>
        <a href="bkp/download.php">Backup</a></th>
    <th style="text-align:center"><i class="material-icons">restore</i><br>
        <a href="bkp/import.php">Restore</a></th>
    
    </tr>    
</table>    
<br><br>
<h5>Upload backup file</h5>
		<form action="bkp/upload_import.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="temp_file" class="form-control"style="width:50%;border:0px;"><br>
			<input type="submit" name="submit" value="Upload"class="btn ">
		</form>
</div>