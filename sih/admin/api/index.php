<?php 
$id='';
 require_once('../db/dc.php');

if(isset($_GET['action'])){
$action=$_GET['action'];
if(isset($_GET['id'])){
$id=$_GET['id'];
}
if(isset($_GET['password'])){
$password=$_GET['password'];
}
}
if($id==''){
$sql = "SELECT * FROM $action";
}else if($action=='food_item')
{
	$sql = "SELECT * FROM $action where $action.id=$id";
}else if($action=='user_master')
{
	$sql = "SELECT * FROM $action where $action.u_id=$id";
}
else if($action=='category_item')
{
	$sql = "SELECT * FROM food_item where food_item.cat_id=$id";
}else if($action=='order_item')
{
	$sql = "SELECT * FROM fooddelivery_food_desc WHERE fooddelivery_food_desc.set_order_id='$id'";
}
else if($action=='user_login')
{
	$sql = "SELECT * FROM user_master WHERE user_master.mobile='$id' AND user_master.password='$password'";
}
else if($action=='order_details')
{
	$sql = "SELECT * FROM set_order_detail WHERE set_order_detail.contact_no='$id'";
}
else if($action=='order_item')
{
	$sql = "SELECT * FROM fooddelivery_food_desc WHERE fooddelivery_food_desc.set_order_id='$id'";
}
else{
	$sql = "SELECT * FROM $action where $action.id=$id";

}
$result = $db_cnn->query($sql);
$temp_array = array();
while($data = $result->fetch_assoc())
{
	$temp_array[] = $data;
}
	echo json_encode(array($action=>$temp_array));
?>
