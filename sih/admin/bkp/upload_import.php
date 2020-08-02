	<?php
		include('db_backup_library.php');
		$dbbackup = new db_backup;
		DB::connect("localhost","abhisheknsc","Abhishek@nsc123","rhcms");
		$dbbackup->backup();
		if(isset($_POST["submit"])){
        		if ($_FILES['temp_file']['name']!=null && $_FILES['temp_file']['name']!="") {
        			$src=$_FILES['temp_file']['tmp_name'];
        			$destination='temp_upload/temp_database.'.pathinfo($_FILES['temp_file']['name'],PATHINFO_EXTENSION);
        			if (copy($src,$destination)) {
        				//Importing Uploaded File Start here
							if($dbbackup->db_import($destination)){
								echo "Database Successfully Imported";
								//Deleting Temporary Database after imporing
								if(is_file($destination)){
									unlink($destination);
								}
							}
        				//Importing Uploaded File End here
        			}
        		}
			//Uloading The temporary database file end here
		}
	?>
	