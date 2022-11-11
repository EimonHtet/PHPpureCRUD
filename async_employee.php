<?php
require('config/check_login.php');
$sql = "SELECT `id`,`full_name`,`email`,`salary`,`city` FROM `employee` WHERE deleted_at IS NULL";
$result = mysqli_query($conn,$sql);
$data = [];
$response = [];
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $full_name = $row['full_name'];
        $email = $row ['email'];
        $salary = $row ['salary'];
        $city = $row['city'];
        $data['id'] = $id;
        $data['full_name'] = $full_name;
        $data['email'] = $email;
        $data['salary'] = $salary;
        $data['city'] = $city;
        array_push($response,$data);
    }
}
echo json_encode($response);
?>