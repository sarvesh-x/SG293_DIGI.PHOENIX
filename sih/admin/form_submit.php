<?php
include 'db/dc.php';
if(!empty($_POST)) {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $message = $_POST['message']; 

 if($name<>''){
 mysqli_query($db_cnn, "
INSERT INTO chat_master(chat_master.s_id,chat_master.r_id,chat_master.message,chat_master.status)VALUES('$email','$message','$name','0')
 	");
    }
}
?>