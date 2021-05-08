<?php

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
            $cpassword = $_POST["cpassword"];
            $hospital_name = $_POST["hospital_name"];
            $address = $_POST["address"];
            $city = $_POST["city"];
            $state = $_POST["state"];
            $pincode = $_POST["pincode"];
            $mobile_no1 = $_POST["mobile_no1"];
            $mobile_no2 = $_POST["mobile_no2"];
            $email_id = $_POST["email"];
            $website = $_POST["website"];
            $total_bad = $_POST["total_bad"];
        
            $existSql = "SELECT * FROM `hospitals` WHERE username='$username'";
            $result = mysqli_query($conn, $existSql);
            $numExistsRow = mysqli_num_rows($result);
            if($numExistsRow > 0){
                ?>
                <script>
                alert("Username Exist..")
                </script>
                <?php
            }
            else{
                if($password == $cpassword){
                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    $token = bin2hex(random_bytes(15));

                    $sql1 = "INSERT INTO `hospitals` (`username`, `password`, `register_time`, `token`, `status`) VALUES ('$username', '$hash', current_timestamp(), '$token', 'inactive')";
                    $result1 = mysqli_query($conn, $sql1);
        
                    $sql2 = "SELECT hospital_id FROM `hospitals` WHERE username='$username'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row = mysqli_fetch_array($result2);
                    $hospital_id = $row['hospital_id'];
        
                    $sql3 = "INSERT INTO `hospital_info` (`hospital_id`, `hospital_name`, `address`, `city`, `state`, `pincode`, `mobile_no1`, `mobile_no2`, `email_id`, `website`, `total_bad`, `available_bad`, `last_updated`) VALUES ('$hospital_id', '$hospital_name', '$address', '$city', '$state', '$pincode', '$mobile_no1', '$mobile_no2', '$email_id', '$website', '$total_bad', '0', current_timestamp())";
                    $result3 = mysqli_query($conn, $sql3);
                
                    if($result1 && $result3){
                        $subject = "Email Activation";
                        $body = "Hi, $username. Click here to activate your account
                        http://localhost/covid/activate.php?token=$token";
                        $sender_email = "From: parthchovatiya.website@gmail.com";
                        if(mail($email_id, $subject, $body, $sender_email)){
                            session_start();
                            $_SESSION['msg'] = "check your mail to activate your account $email_id";
                            header('location:login.php');
                        }
                        else{
                            ?>
                            <script>
                            alert("Email Sending Failed..")
                            </script>
                            <?php
                        }
                    }
                }
                else{
                    ?>
                    <script>
                    alert("Password does not match..")
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
    <title>Register</title>

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
                    <form method="POST" spellcheck="false" id="signup-form" class="signup-form" action="/covid/register.php">
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="username" placeholder="Username"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="hospital_name" id="hospital_name" placeholder="Hospital Name"/>
                        </div>
                        <div class="form-group">
                            <!-- <input type="text" class="form-input" name="address" id="address" placeholder="Address"/> -->
                            <textarea rows="4" class="form-input" cols="66" type="text" placeholder="Address" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="city" id="city" placeholder="City"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="state" id="state" placeholder="State"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="pincode" id="pincode" placeholder="Pin Code"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="mobile_no1" id="mobile_no1" placeholder="Mobile No1"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="mobile_no2" id="mobile_no2" placeholder="Mobile No2"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="website" id="website" placeholder="Website"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="total_bad" id="total_bad" placeholder="Total Bad"/>
                        </div>


                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye-off field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="cpassword" id="cpassword" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfUxZAaAAAAAMXT2fBzz2eCPh_Uv0NG75bIk8Hp"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="/covid/login.php" class="loginhere-link">Login here</a>
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