<?php
require('config/check_login.php');
$id = (int)($_GET['id']);
$id = mysqli_real_escape_string($conn,$id);
$today = date('Y-m-d H:i:s');
$userId = $_SESSION['id'];
$sql = "UPDATE `employee` SET 
deleted_at ='" . $today . "',
deleted_by ='". $userId . "'
WHERE id = '" .$id. "'";
 
$result = mysqli_query($conn,$sql);

 $response['status'] = "200";
 $response['message'] = "Success";

echo json_encode($response);
?>