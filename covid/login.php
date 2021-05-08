
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

            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql1 = "SELECT `status` FROM `hospitals` WHERE `username`='$username'";
            $result1 = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_assoc($result1);
            if($row['status']=='inactive'){
                ?>
                <script>
                  alert("Account is inactive..")
                </script>
                <?php
            }
            else{
                $sql = "SELECT * FROM `hospitals` WHERE `username`='$username' and `status`='active'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);

                if($num == 1){
                    while($row = mysqli_fetch_assoc($result)){
                        if(password_verify($password, $row['password'])){
                            $login=true;
                            $_SESSION['loggedin'] = true;
                            $_SESSION['username'] = $username;
                            header("location: welcome.php");
                        }
                        else{
                            ?>
                            <script>
                              alert("Invalid Credentials.")
                            </script>
                            <?php
                        }
                    }
                }
                else{
                    ?>
                    <script>
                      alert("Invalid Credentials.")
                    </script>
                    <?php
                }
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
    <title>Login</title>

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
                    <form method="POST" spellcheck="false" id="signup-form" class="signup-form" action="/covid/login.php">
                        <h2 class="form-title">Login</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="username" placeholder="Username"/>
                        </div>
                        
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye-off field-icon toggle-password"></span>
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfUxZAaAAAAAMXT2fBzz2eCPh_Uv0NG75bIk8Hp"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Login"/>
                        </div>
                    </form>
                    <p class="loginhere" style="margin-top: 75px;">
                        Forgot Password ? <a href="/covid/forgot_password.php" class="loginhere-link">Click here</a>
                    </p>
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