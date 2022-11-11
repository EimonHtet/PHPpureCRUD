<?php
require("config/check_login.php");
$response = [];
if(isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['salary']) && isset($_POST['city'])) {
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $salary = $_POST['salary'];
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $today = date('Y-m-d H:i:s');
    $userId = $_SESSION['id'];
    $sql = "INSERT INTO `employee` (
            full_name,
            email,
            salary,
            city,
            created_at,
            created_by,
            updated_at,
            updated_by
            )
            VALUES (
            '" . $full_name . "',
            '" . $email ."',
            '" . $salary . "',
            '" . $city . "',
            '" . $today . "',
            '" . $userId . "',
            '" . $today . "',
            '" . $userId . "' 
            )
            ";
    //echo $sql;
    $result = mysqli_query($conn,$sql);
    if($result) {
        $response['status'] = "200";
        $response['message'] = "Success";
    }else {
        $response['status'] = "500";
        $response['message'] = "Internal Server Error";
    }
            
}
else {
    $response['status'] = "401";
    $response['message'] = "Something Wrong";
}
echo json_encode($response);
?>