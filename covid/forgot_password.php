
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
        
        if($response->success){
            // echo "Message sent Successfully";

            $username = $_POST["username"];

            $sql1 = "SELECT * FROM `hospitals` WHERE `username`='$username'";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_array($result1);
            $num = mysqli_num_rows($result1);

            $hospital_id = $row1['hospital_id'];
        
            $sql2 = "SELECT * FROM `hospital_info` WHERE `hospital_id` = $hospital_id";
            $result2 = mysqli_query($conn, $sql2);

            if($num == 1){
                $row2 = mysqli_fetch_assoc($result2);
                
                $email_id = $row2['email_id'];
                $token = $row1['token'];

                $subject = "Password Reset";
                    $body = "Hi, $username. Click here to reset your password
                    http://localhost/covid/reset_password.php?token=$token";
                    $sender_email = "From: parthchovatiya.website@gmail.com";
                    if(mail($email_id, $subject, $body, $sender_email)){
                        $_SESSION['msg'] = "check your mail to reset your password $email_id";
                        header('location:forgot_password.php');
                    }
                    else{
                        ?>
                        <script>
                        alert("Email Sending Failed...")
                        </script>
                        <?php
                }
            }
            else{
                ?>
                <script>
                alert("Invalid Credentials..")
                </script>
                <?php
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

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <p><?php 
                        if(isset($_SESSION['msg']))
                            echo $_SESSION['msg'];
                    ?></p>
                    <form method="POST" spellcheck="false" id="signup-form" class="signup-form" action="/covid/forgot_password.php">
                        <h2 class="form-title">Recover Your Account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="username" placeholder="Enter Your Username"/>
                        </div>
                        
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfUxZAaAAAAAMXT2fBzz2eCPh_Uv0NG75bIk8Hp"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Send Mail"/>
                        </div>
                    </form>
                    <p class="loginhere" style="margin-top: 15px;">
                        Don't have an account ? <a href="/covid/register.php" class="loginhere-link">Register here</a>
                    </p>
                    <p style="text-align: center; color:#555; font-weight: 500;">
                        Go to <a href="/covid/home1.php" class="loginhere-link">Home</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>