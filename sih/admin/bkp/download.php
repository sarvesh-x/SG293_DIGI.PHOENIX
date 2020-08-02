	<?php
		require "DB_Backup.php";
		use DB_Backup as DB;
		DB::connect("localhost","abhisheknsc","Abhishek@nsc123","rhcms");
		DB::backup()->download();
	?>
	