<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}

include 'partials/_dbconnect.php';

$uname = $_SESSION['username'];
$sql2 = "SELECT * FROM `hospitals` WHERE username='$uname'";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_array($result2);
$hospital_id = $row['hospital_id'];

$sql_temp = "SELECT * FROM `hospital_info` WHERE hospital_id='$hospital_id'";
$result_temp = mysqli_query($conn, $sql_temp);
$row = mysqli_fetch_array($result_temp);


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['submit'])){
        
        $secretKey = "6LfUxZAaAAAAAJLj7wdrq-mxvet73NSLlLIQLQtz";
        $responseKey = $_POST['g-recaptcha-response'];
        $UserIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

        $response = file_get_contents($url);
        $response = json_decode($response);
        
        if($response->success){

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
            
            
            $sql3 = "UPDATE `hospital_info` SET `hospital_name` = '$hospital_name', `address` = '$address', `city` = '$city', `state` = '$state', `pincode` = '$pincode', `mobile_no1` = '$mobile_no1', `mobile_no2` = '$mobile_no2', `email_id` = '$email_id', `website` = '$website', `total_bad` = '$total_bad' WHERE `hospital_info`.`hospital_id` = '$hospital_id'";
            $result3 = mysqli_query($conn, $sql3);
                
            if($result3){
                ?>
                <script>
                alert("Successfully Updated..")
                </script>
                <?php
                header('location:welcome.php');
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
            <div class="container">
                <div class="signup-content">
                    <form method="POST" spellcheck="false" id="signup-form" class="signup-form" action="/covid/update.php">
                        <h2 class="form-title">Update Date</h2>
                    
                        <div class="form-group">
                            <input type="text" class="form-input" name="hospital_name" id="hospital_name" placeholder="Hospital Name" value="<?php echo $row['hospital_name']; ?>"/>
                        </div>
                        <div class="form-group">
                            <textarea type="text" rows="4" class="form-input" id="address" cols="66" type="text" name="address"><?php echo $row['address']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="city" id="city" placeholder="City" value="<?php echo $row['city']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="state" id="state" placeholder="State" value="<?php echo $row['state']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="pincode" id="pincode" placeholder="Pin Code" value="<?php echo $row['pincode']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="mobile_no1" id="mobile_no1" placeholder="Mobile No1" value="<?php echo $row['mobile_no1']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="mobile_no2" id="mobile_no2" placeholder="Mobile No2" value="<?php echo $row['mobile_no2']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email" value="<?php echo $row['email_id']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="website" id="website" placeholder="Website" value="<?php echo $row['website']; ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="total_bad" id="total_bad" placeholder="Total Bad" value="<?php echo $row['total_bad']; ?>"/>
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfUxZAaAAAAAMXT2fBzz2eCPh_Uv0NG75bIk8Hp"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Update"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Go <a href="/covid/welcome.php" class="loginhere-link">Back</a>
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