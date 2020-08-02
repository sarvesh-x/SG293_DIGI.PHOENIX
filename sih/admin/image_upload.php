
<?php
include 'db/dc.php';
?>
<?php
$file='';
function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 500;
    $resizeHeight = 500;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
} 
if(isset($_POST["t_o_upload"])) {
	$imageProcess = 0;
	$id=$_POST['id'];
    if(is_array($_FILES)) {
        $fileName = $_FILES['upload_image']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "upload/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath."cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."cat_".$resizeFileName.'.'. $fileExt);
                break;
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
        $imageProcess = 1;
    }
$file='cat_'.$resizeFileName.'.'.$fileExt;

	 $stmt=$db_con->prepare("UPDATE tender_master SET tender_master.t_image='$file' WHERE tender_master.t_id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully Upload');
		   window.location.replace('index.php?page=create_tender');
		   </script>";	
}

if(isset($_POST["third_party_upload"])) {
	$imageProcess = 0;
	$id=$_POST['id'];
    if(is_array($_FILES)) {
        $fileName = $_FILES['upload_image']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "upload/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath."cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."cat_".$resizeFileName.'.'. $fileExt);
                break;
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
        $imageProcess = 1;
    }
$file='cat_'.$resizeFileName.'.'.$fileExt;

	 $stmt=$db_con->prepare("UPDATE user_master SET user_master.image='$file' WHERE user_master.user_id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully Upload');
		   window.location.replace('index.php?page=third_party');
		   </script>";	
}
 
if(isset($_POST["sub_category_image_upload"])) {
	$imageProcess = 0;
	$id=$_POST['id'];
    if(is_array($_FILES)) {
        $fileName = $_FILES['upload_image']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "category_image/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."sub_cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath."sub_cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."sub_cat_".$resizeFileName.'.'. $fileExt);
                break;
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
        $imageProcess = 1;
    }
$file='sub_cat_'.$resizeFileName.'.'.$fileExt;

	 $stmt=$db_con->prepare("UPDATE category SET category.image='$file' WHERE category.cat_id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully Upload');
		   window.location.replace('index.php?page=sub_category&idd=$id');
		   </script>";	
}
if(isset($_POST["item_image_upload"])) {
	$imageProcess = 0;
	$id=$_POST['id'];

	$stmtss = $db_con->prepare("SELECT food_item.cat_id FROM food_item WHERE food_item.id='$id'");
        $stmtss->execute();
        $row=$stmtss->fetch(PDO::FETCH_ASSOC);
		 $cat_id=$row['cat_id'];		


    if(is_array($_FILES)) {
        $fileName = $_FILES['upload_image']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "category_image/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."sub_cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath."sub_cat_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."sub_cat_".$resizeFileName.'.'. $fileExt);
                break;
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
        $imageProcess = 1;
    }
$file='sub_cat_'.$resizeFileName.'.'.$fileExt;

	 $stmt=$db_con->prepare("UPDATE food_item SET food_item.image='$file' WHERE food_item.id='$id'");
	$stmt->execute();
echo "<script>
		   alert('Successfully Upload');
		   window.location.replace('index.php?page=producat&a=$cat_id');
		   </script>";	
}
$S='';
function resizeImages($resourceType,$image_width,$image_height) {
    $resizeWidth = 1130;
    $resizeHeight =400;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
} 
if(isset($_POST["offer_image_upload"])) {
	$imageProcess = 0;
	$id=$_POST['id'];
    if(is_array($_FILES)) {
        $fileName = $_FILES['upload_image']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "category_image/";
        $fileExt = pathinfo($_FILES['upload_image']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImages($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."slider".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImages($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath."slider".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImages($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."slider".$resizeFileName.'.'. $fileExt);
                break;
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
        $imageProcess = 1;
    }
$file='slider'.$resizeFileName.'.'.$fileExt;

	 $stmt=$db_con->prepare("UPDATE offer_slider SET offer_slider.image='$file' WHERE offer_slider.id='$id'");
	$stmt->execute();

echo "<script>
		   alert('Successfully Upload');
		   window.location.replace('index.php?page=offer_slider');
		   </script>";	
}
 ?>