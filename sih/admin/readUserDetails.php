<?php
include("db/dc.php");
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    $user_id = $_POST['id'];
    $d=$_GET['d'];
    if($d=='tender')
    {
    $query = "SELECT * FROM tender_master WHERE tender_master.t_id='$user_id'";
    }else if($d=='third_party')
	{
        $query = "SELECT * FROM user_master WHERE user_master.user_id='$user_id'";
    }
    if (!$result = mysqli_query($db_cnn, $query)) {
        exit(mysqli_error($db_cnn));
    }
    $response = array();
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}
?>