<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/about_us.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/footer1.css">

    <title>About Us</title>
    <style>
    .extra1{
        margin-top: 40px;
    }
    .extra2{
        margin-top: 90px;
    }
    .about-us{
        max-width: 1200px;
        width:90%;
        padding: 20px;
        margin: auto;
        font-size: 20px;
        box-shadow: 1px 1px 1px 1px rgba(2,2,2,0.5);
        letter-spacing: 1px;
        word-spacing: 2px;
        text-align: justify;
    }
    .about-us p:before{
        content: "\21D2";
    }
    .about-us p span{
        padding-left: 12px;
    }
    </style>
</head>
<body>
    <?php 
        include 'partials/_navbar.php'; 
    ?>
    <div class="extra1">
    </div>
    <div class="about-us">
        <p><span></span>Our Goal is to help people through technology.</p><br>
<p><span></span>As you know that in this covid 19 pandemic situation it is very difficult to leave and as you know that corona cases are increases day by day and hospitals is going to be full. As a part of Indian we need to help peoples as soon as possible. So we decided to make web application which will display necessary information related to hospitals like Hospital Name, Hospital Address, Hospital Mobile numbers, Hospital Email Id, Hospital Website, Total Available Covid Bad, Current Available Bad etc.</p><br>
<p><span></span>In Our Website hospital can create account and login. while creating account hospital need to enter all correct information about hospitals. Entering all nessasory information hospitals need to login with their username and password. And they need to change available bad at daily basis so that users/patients can see they available bad and users/patients get ideas about how many bads are empty.</p>
    </div>
    <div class="extra2"></div>
    <?php include 'partials/_footer1.php';   ?>
</body>
</html>