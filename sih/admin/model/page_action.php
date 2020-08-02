<?php 
session_start();
include'../db/dc.php';
# Login page
if(isset($_POST['login_btn']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$stmt=$db_con->prepare("SELECT user_master.user_id FROM user_master WHERE user_master.email='$username' AND user_master.password='$password'");
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	  $u_id=$row['user_id'];
	   if($u_id=='')
	   {
		   
		   echo "<script>
		   alert('Login Faild');
		   window.location.replace('../');
		   </script>";
	   }
	   else{
		   $_SESSION["user_id"]=$u_id;
		   echo "<script>
		   
		   window.location.replace('../');
		   </script>";
	   }
}
# forgat page
if(isset($_POST['forgat']))
{
	$header='RHCMS';
	$subject='Forgot password';
	$email=$_POST['email'];
	$stmt=$db_con->prepare("SELECT user_master.email,user_master.password FROM user_master WHERE user_master.email='$email'");
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	  $email=$row['email'];
	  $password=$row['password'];
	   if($email=='')
	   {
		   
		   echo "<script>
		   alert('Email not found');
		   window.location.replace('../');
		   </script>";
	   }
	   else{
$msg = "Your Password :".$password;
$msg = wordwrap($msg,70);
mail($email,$subject,$msg,$headers);
  echo "<script>
		   alert('Email Send');
		   window.location.replace('../');
		   </script>";	   }
}
#update_cmp_logo
if(isset($_POST['cmp_logo_upload'])){

  // Getting file name
  $filename = $_FILES['imagefile']['name'];
  // Valid extension
  $valid_ext = array('png','jpeg','jpg');
  // Location
  $location = "../images/".$filename;
  // file extension
  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
  $file_extension = strtolower($file_extension);
  // Check extension
  if(in_array($file_extension,$valid_ext)){
    // Compress Image
    compressImage($_FILES['imagefile']['tmp_name'],$location,60);
  }else{
    echo "Invalid file type.";
  }
  include'../db/dc.php';
$id=$_POST['cmp_code'];
  $stmt=$db_con->prepare("UPDATE company SET company.logo='$filename' WHERE company.id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully upload');
		   window.location.replace('../index.php?page=cmp_profile');
		   </script>";

}
// Compress image
function compressImage($source, $destination, $quality) {
  $info = getimagesize($source);
  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);
  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);
  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);
  imagejpeg($image, $destination, $quality);
}

# Company Profile 
if(isset($_POST['update_cmp_profile']))
{
	$NameSurname=$_POST['NameSurname'];
	$Email=$_POST['Email'];
	$mob=$_POST['mob'];
	$address=$_POST['address'];
	$id=$_POST['id'];

	$stmt=$db_con->prepare("UPDATE company SET company.name='$NameSurname',company.mobile='$mob',company.address='$address',company.email='$Email' WHERE company.id='$id'");
	$stmt->execute();
	echo "<script>
		   alert('Successfully updated');
		   window.location.replace('../index.php?page=cmp_profile');
		   </script>";
}
# Add Tender
if(isset($_POST['tender_add']))
{
	 $name=$_POST['name'];
	 $issue_date=$_POST['issue_date'];
	 $due_date=$_POST['due_date'];
	 $budget=$_POST['budget'];
	 $t_o_name=$_POST['t_o_name'];
	 $details=$_POST['details'];
	 $password=$_POST['password'];
	 $login_id=$_POST['login_id'];
	 $type='Current Tender';
	 $range=$_POST['range'];
	 
	 $stmt=$db_con->prepare("INSERT INTO tender_master(tender_master.t_name,tender_master.t_issue_date,tender_master.t_due_date,tender_master.t_budget,tender_master.t_type,tender_master.t_details,tender_master.t_o_name,tender_master.r)VALUES('$name','$issue_date','$due_date','$budget','$type','$details','$t_o_name','$range')");
	$stmt->execute();
	    $stmtss = $db_con->prepare("SELECT tender_master.t_id FROM tender_master WHERE tender_master.t_name='$name' AND tender_master.t_budget='$budget'");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC);
	$t_id=$row['t_id'];
	
	$stmts=$db_con->prepare("INSERT INTO users(users.name,users.email,users.password,users.t_id)VALUES('$name','$login_id','$password','$t_id')");
	$stmts->execute();
echo "<script>
		   alert('Successfully Add Tender');
		   window.location.replace('../index.php?page=create_tender');
		   </script>";

}
# Delete Tender
if(isset($_GET['act']))
{
	 $act=$_GET['act'];
	 $id=$_GET['id'];
	 if($act=='tender_del')
	 {
	 $stmt=$db_con->prepare("DELETE FROM tender_master WHERE tender_master.t_id='$id'");
	$stmt->execute();
	
	$stmtq=$db_con->prepare("DELETE FROM users WHERE users.t_id='$id'");
	$stmtq->execute();
echo "<script>
		   alert('Successfully Delete');
		   window.location.replace('../index.php?page=create_tender');
		   </script>";

	 }
}
# Update Tender
if(isset($_POST['tender_update']))
{
    $t_o_name=$_POST['t_o_name'];
	 $name=$_POST['name'];
	 $id=$_POST['id'];
	 $issue_date=$_POST['issue_date'];
	 $due_date=$_POST['due_date'];
	 $budget=$_POST['budget'];
	 $details=$_POST['details'];
	  $range=$_POST['range'];
	 
	 $stmt=$db_con->prepare("UPDATE tender_master SET tender_master.t_name='$name',tender_master.t_issue_date='$issue_date',tender_master.t_due_date='$due_date',tender_master.t_budget='$budget',tender_master.t_details='$details',tender_master.t_o_name='$t_o_name',tender_master.r='$range' WHERE tender_master.t_id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully updated');
		   window.location.replace('../index.php?page=create_tender');
		   </script>";	 
}

# Add Third Party
if(isset($_POST['third_add']))
{
	 $name=$_POST['name'];
	 $login_id=$_POST['login_id'];
	 $password=$_POST['password'];
	 $stmt=$db_con->prepare("INSERT user_master(user_master.username,user_master.email,user_master.password,user_master.type,user_master.cmp_code)VALUES('$name','$login_id','$password','Third Party','1')");
	$stmt->execute();
		echo "<script>
		   alert('Successfully added');
		   window.location.replace('../index.php?page=third_party');
		   </script>";	
	
}
# Update Third Party

if(isset($_POST['third_update']))
{
	 $name=$_POST['name'];
	 $login_id=$_POST['email'];
	 $password=$_POST['password'];
	 $id=$_POST['id'];
	 $stmt=$db_con->prepare("UPDATE user_master SET user_master.username='$name',user_master.email='$login_id',user_master.password='$password' WHERE user_master.user_id='$id'");
	$stmt->execute();
		echo "<script>
		   alert('Successfully updated');
		   window.location.replace('../index.php?page=third_party');
		   </script>";	
	
}
# Delete Third Party
if(isset($_GET['act']))
{
	 $act=$_GET['act'];
	 $id=$_GET['id'];
	 if($act=='third_party')
	 {
	 $stmt=$db_con->prepare("DELETE FROM user_master WHERE user_master.user_id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully Delete');
		   window.location.replace('../index.php?page=third_party');
		   </script>";

	 }
}

# Thidr Party Allocation
if(isset($_POST['tender_allocation']))
{
	 $t_id=$_POST['t_id'];
	 $th_id=$_POST['th_id'];
	 $name=$_POST['name'];
	 $stmt=$db_con->prepare("INSERT INTO on_sider_allocation(on_sider_allocation.user_id,on_sider_allocation.t_id)VALUES('$th_id','$t_id')");
	$stmt->execute();
		echo "<script>
		   alert('Successfully Allocated');
		   window.location.replace('../index.php?page=third_party_allocation&id=$th_id&name=$name');
		   </script>";	
		   }
# Delete Tender Allocated
if(isset($_GET['act']))
{
	 $act=$_GET['act'];
	 $id=$_GET['id'];
	 $i=$_GET['i'];
	 $stmtss = $db_con->prepare("SELECT user_master.username FROM user_master WHERE user_master.user_id='$i'");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC);
	$t_name=$row['username'];
	 
	 
	 if($act=='tender_allocation')
	 {
	 $stmt=$db_con->prepare("DELETE FROM on_sider_allocation WHERE on_sider_allocation.os_id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully Delete');
		   window.location.replace('../index.php?page=third_party_allocation&id=$i&name=$t_name');
		   </script>";

	 }
}	
?>