<?php
session_start();
require('config/require.php');
require('config/connection.php');

$loginId = $_SESSION['id'];
$loginName = $_SESSION['username'];
if(isset($loginId) && isset($loginName)) {
    $sql = "SELECT `id` FROM `user` WHERE username = '" . $loginName ."' && id ='" . $loginId ."' && deleted_at IS NULL";
    //echo $sql;
    $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)<=0){
            $url = $base_url . "login.php";
            header('Location:' . $url);
            exit();
        }

}
else {
    $url = $base_url . "login.php";
    header('Location:' . $url);
    exit();
}
?>