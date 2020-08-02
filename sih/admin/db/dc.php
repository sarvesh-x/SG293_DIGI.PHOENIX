<?php
    $db_host = "localhost";
	$db_name = "rhcms";
	$db_user = "abhisheknsc";
	$db_pass = "Abhishek@nsc123";
	try{
		
		$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db_cnn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		$conn=$db_cnn;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
?>