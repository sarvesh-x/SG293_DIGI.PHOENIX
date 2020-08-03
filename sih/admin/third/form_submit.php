<?php
include '../db/dc.php';

if(!empty($_POST)) {
 $s_id = $_POST['name'];
 $r_id=1;
 $message = $_POST['message']; 
 if($message<>''){
 mysqli_query($db_cnn, "INSERT INTO chat_master(chat_master.s_id,chat_master.r_id,chat_master.message,chat_master.status)VALUES('$s_id','$r_id','0')"); 
 }
}
?>