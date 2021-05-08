
<?php

$login = false;
$showError = false;
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';

    if(isset($_POST['submit'])){
        
        $secretKey = "6LfUxZAaAAAAAJLj7wdrq-mxvet73NSLlLIQLQtz";
        $responseKey = $_POST['g-recaptcha-response'];
        $UserIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

        $response = file_get_contents($url);
        $response = json_decode($response);

        if(isset($_GET['token'])){
            $token = $_GET['token'];
        
            if($response->success){

                $password = $_POST["password"];
                $cpassword = $_POST["cpassword"];

                if($password == $cpassword){
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    $sql1 = "UPDATE `hospitals` SET `password`='$hash' WHERE `token`='$token'";
                    $result1 = mysqli_query($conn, $sql1);

                    if($result1){
                        $_SESSION['msg'] = "Your Password has been Updated";
                        header('location:login.php');
                    }
                    else{
                        $_SESSION['passmsg'] = "Your Password is not Updated";
                        header('location:reset_password.php');
                    }
                }
                else{
                    $_SESSION['passmsg'] = "Your Passwords are not Matching";
                }
            }
            else{
                ?>
                <script>
                alert("Invalid Captcha, Please Try Again.")
                </script>
                <?php
            }
        }
        else{
            $_SESSION['passmsg'] = "Account Not Found";
        }
    }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" spellcheck="false" id="signup-form" class="signup-form" action="">
                        <h2 class="form-title">Reset Your Password</h2>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="New Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye-off field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="cpassword" id="cpassword" placeholder="Repeat your New Password"/>
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfUxZAaAAAAAMXT2fBzz2eCPh_Uv0NG75bIk8Hp"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Update Password"/>
                        </div>
                    </form>
                    <p><?php 
                        if(isset($_SESSION['passmsg']))
                            echo $_SESSION['passmsg'];
                    ?></p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>