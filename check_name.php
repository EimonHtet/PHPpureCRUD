<?php
require('config/check_login.php'); 
$count = 0;
$response['status'] = '500';
$response['message'] = 'Internal Server Error';
if(isset($_POST['full_name'])) {
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    if($_POST['id'] != '')
    {
        $id = $_POST['id'];
        $sql = "SELECT count(id) AS total FROM employee WHERE full_name ='$full_name' AND id != $id AND deleted_at IS NULL ";
    }else{
        $sql = "SELECT count(id) AS total FROM employee WHERE full_name ='$full_name' AND deleted_at IS NULL ";
    }
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_assoc($result)) {
            $count = $row['total'];
        }
    }
    if($count>0) {
        $response['status'] = '403';
        $response['message'] = 'This name is already exit.';
    } else {
        $response['status'] = '200';
        $response['message'] = 'Success';
    }
    echo json_encode($response);
}
?>