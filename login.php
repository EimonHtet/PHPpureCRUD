<?php
    session_start();
    require('config/require.php');
    require('config/connection.php');
    $error = false;
    $error_msg = "";
    if(isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = md5($_POST['password']);
        $sql = "SELECT `id`,`username`,`email`,`password` FROM `user` WHERE username='" . $username ."' AND deleted_at IS NULL";
        //echo $sql;    
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $db_username = $row['username'];
                $db_password = $row['password'];

                if($password == $db_password) {
                    $_SESSION['id']= $id;
                    $_SESSION['username'] = $username;
                    $url = $base_url. "listing.php";
                    header("Location:".$url);
                }
                else {
                    $error=true;
                    $error_msg = "Password does not match";
                }
            }
        }
        else {
            $error=true;
            $error_msg = "User does not exit";
        }
    }
?>
<html>
    <head>
        <title>CRUD Tutorial: Admin Login</title>
        <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/styles.css?v=20221109">
    </head>
    <body>
        <div class="container">
            <div class="screen">
                <div class="screen__content">
                    <?php
                        if($error==true) {
                    ?>
                            <div style="margin: 0 auto;">
                                <span style="color:red"><?php echo $error_msg; ?></span>
                            </div>
                    <?php
                        }
                    ?>
                    
                    <form class="login" action="<?php echo $base_url; ?>login.php" method="POST">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input type="text" class="login__input" placeholder="User name " name="username" value="<?php echo $username; ?>">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password" class="login__input" placeholder="Password" name="password">
                        </div>
                        <button class="button login__submit" type="submit">
                            <span class="button__text">Log In Now</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                            <input type="hidden" value="submit" name="submit">
                        </button>			
                    </form>
                    <!-- <div class="social-login">
                        <h3>log in via</h3>
                        <div class="social-icons">
                            <a href="#" class="social-login__icon fab fa-instagram"></a>
                            <a href="#" class="social-login__icon fab fa-facebook"></a>
                            <a href="#" class="social-login__icon fab fa-twitter"></a>
                        </div>
                    </div> -->
                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape4"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>		
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>		
            </div>
        </div>
    </body>
</html>