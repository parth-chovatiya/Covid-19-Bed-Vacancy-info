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

$total_bad = $row["total_bad"];
$available_bad = $row["available_bad"];
$occupied_bad = $total_bad - $available_bad;

$hospital_name = $row["hospital_name"];
$address = $row["address"];
$city = $row["city"];
$state = $row["state"];
$pincode = $row["pincode"];
$mobile_no1 = $row["mobile_no1"];
$mobile_no2 = $row["mobile_no2"];
$email_id = $row["email_id"];
$website = $row["website"];


$last_updated = date("d/m/Y g:iA", strtotime($row["last_updated"]));

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(isset($_POST['submit'])){
      
    $a_bad = $_POST["a_bad"];
    if($a_bad > $total_bad){
      ?>
<script>
  alert("You can't enter more than Total Bad")
</script>
<?php
    }
    else{
      $sql3 = "UPDATE `hospital_info` SET `available_bad` = '$a_bad' WHERE `hospital_info`.`hospital_id` = '$hospital_id'";
      $result3 = mysqli_query($conn, $sql3);
      header("Refresh:0");
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/welcome2.css">
  <link rel="stylesheet" href="./css/footer1.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <title>Welcome
    <?php echo $_SESSION['username'] ?>
  </title>
  <style>

  </style>
</head>

<body>

  <?php 
    include 'partials/_navbar.php'; 
  ?>

  <div class="welcome">
    <marquee direction="left">
      <h1>You Update Detail At Last <?php echo $last_updated ?>. </h1>
    </marquee>
  </div>
  <div class="main-box">
    <div class="content-box">
      <div class="full-content">
        <p>Total Bad : <?php echo $total_bad; ?> </p>
        <p>Total Occupied Bad : <?php echo $occupied_bad; ?> </p>
        <p>Available Bad : <?php echo $available_bad; ?> </p>
      </div>
      <div class="update-bad">
      <form method="POST" accept="covid/welcome.php">
          <input type="text" autocomplete="off" name="a_bad" id="a_bad" placeholder="Update Available Bad"><br>
          <input class="button" type="submit" name="submit" id="submit" value="Update">
      </form>
      </div>
    </div>
    <div class="img-box">
      <div class="details"><br>
        <span>Hospital Name</span> : <?php echo $hospital_name ?>   <br><br>
        <span>Address</span> : <?php echo $address ?>   <br><br>
        <span>City</span> : <?php echo $city ?>   <br><br>
        <span>State</span> : <?php echo $state ?>   <br><br>
        <span>Pincode</span> : <?php echo $pincode ?>   <br><br>
        <span>Mobile No 1</span> : <?php echo $mobile_no1 ?>   <br><br>
        <span>Mobile No 2</span> : <?php echo $mobile_no2 ?>   <br><br>
        <span>Email Id</span> : <?php echo $email_id ?>   <br><br>
        <span>Website</span> : <?php echo $website ?>   <br><br>
      </div>
    </div>
  </div>

  <div class="extra"></div>

  <?php include 'partials/_footer1.php';   ?>
  <script src="./vendor/dark-light-mode.js"></script>
</body>

</html>