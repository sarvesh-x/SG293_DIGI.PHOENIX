	<?php
		require "DB_Backup.php";
		use DB_Backup as DB;
		DB::connect("localhost","abhisheknsc","Abhishek@nsc123","rhcms");
		if(DB::backup()->save("file/"))
		{
		   echo "<script>
		   alert('Backup Saved Successfully');
		   window.location.replace('../');
		   </script>";
		    
		}
	?>
	
