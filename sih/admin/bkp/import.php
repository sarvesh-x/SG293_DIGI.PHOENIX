	<?php
		require "DB_Backup.php";
		use DB_Backup as DB;
		DB::connect("localhost","abhisheknsc","Abhishek@nsc123","rhcms");
		if(DB::import("file/rhcms.sql")){
			  echo "<script>
		   alert('Successfully Restore');
		   window.location.replace('../');
		   </script>";
		}
	?>
	