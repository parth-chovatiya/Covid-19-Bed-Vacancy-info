<!-- site key = 6LcGso8aAAAAAIrCiL2EvJQPJz66l3iDznRnlfEc -->
<!-- secret key = 6LcGso8aAAAAAO5aKhgt_srpzyWDwTEiEsFJXmMT -->

<html>
<head>
<title> Contact Form </title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link rel="stylesheet" href="./css/contact_us.css">
<link rel="stylesheet" href="./css/navbar.css">
<link rel="stylesheet" href="./css/footer1.css">
<style>
    

</style>
<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
<?php 
    include 'partials/_navbar.php'; 
  ?>
<div class="row-2">
    <div class="contact-us">
        
        <div class="contact-form">
        <h2>CONTACT US</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="text" name="phone" placeholder="Phone No" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea rows="6" type="text" name="message" placeholder="Your Message" required></textarea>
          
            <div class="g-recaptcha" data-sitekey="6LcGso8aAAAAAIrCiL2EvJQPJz66l3iDznRnlfEc">
            </div>
        
            <input type="submit" name="submit" value="Send Message" class="submit-btn">
        </form>
        
        <div class="status">
            
            <?php
            if(isset($_POST['submit'])){
                $user_name = $_POST['name'];
                $user_phone = $_POST['phone'];
                $user_email = $_POST['email'];
                $user_message = $_POST['message'];
        
        
                $email_from = 'parthchovatiya.website@gmail.com';
                $email_subject = "New Form Submission";
                $email_body = "Name: $user_name.\n".
                                "Phone No: $user_phone.\n".
                                "Email Id: $user_email.\n".
                                "User Message: $user_message.\n";
                
                $to_email = "parthchovatiya3@gmail.com";
                $headers = "From: $email_from \r\n";
                $headers = "Reply-To: $user_email \r\n";
                
                $secretKey = "6LcGso8aAAAAAO5aKhgt_srpzyWDwTEiEsFJXmMT";
                $responseKey = $_POST['g-recaptcha-response'];
                $UserIP = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";
        
                $response = file_get_contents($url);
                $response = json_decode($response);
                
                if($response->success){
                    mail($to_email, $email_subject, $email_body, $headers);
                    echo "Message sent Successfully";
                }
                else{
                    echo "<span>Invalid Captcha, Please Try Again.</span>";
                }
            }
            ?>
        
        </div>
        
        </div>
    </div>
    <div class="map">

    <div class="feedback">
        <div class="img-box">
            <img src="./images/feedback.jpg" alt="">
            
        </div>
        <div class="inner-row-content">
        <h1>Feedback</h1>
            <p>For any kind of input you would like to give.</p>
            <p><a href="mailto:feedback@coronasafe.com">feedback@coronasafe.com</a></p>
        </div>
    </div>
    <div class="bug">
        <div class="img-box">
            <img src="./images/bug.jpg" alt="">
        </div>
        <div class="inner-row-content">
            <h1>Bugs</h1>
            <p>If you spot a bug of any kind, write to us at.</p>
            <p><a href="mailto:bug@coronasafe.com">bug@coronasafe.com</a></p>
        </div>
    </div>

    </div>
</div>
<?php include 'partials/_footer1.php';   ?>
<script src="./vendor/dark-light-mode.js"></script>
</body>
</html>
