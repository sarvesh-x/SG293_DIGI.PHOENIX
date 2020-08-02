<?php
$page='dashboard';
include'db/dc.php'; 
include'include/header.php';
?>
<section class="content" style="background-color:white;padding:0px;">
<?php 
$page='dashboard';
if(isset($_GET['page']))
{
	$page=$_GET['page'];
}
$filename ='page/'.$page.'.php';

if (file_exists($filename)) {
include 'page/'.$page.'.php';
} else {
    include 'page/'.'not_found'.'.php';
}
?>
</section>
<?php 
include'include/footer.php';
?>