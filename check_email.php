<?php
require('config/check_login.php'); 
$count = 0;
$response['status'] = '500';
$response['message'] = 'Internal Server Error';
if(isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    if($_POST['id'] != '')
    {
        $id = $_POST['id'];
        $sql = "SELECT count(id) AS total FROM employee WHERE email ='$email' AND id != $id AND deleted_at IS NULL ";
    }else{
        $sql = "SELECT count(id) AS total FROM employee WHERE email ='$email' AND deleted_at IS NULL ";
    }
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_assoc($result)) {
            $count = $row['total'];
        }
    }
    if($count>0) {
        $response['status'] = '403';
        $response['message'] = 'This email is already exit.';
    } else {
        $response['status'] = '200';
        $response['message'] = 'Success';
    }
    echo json_encode($response);
}
?>