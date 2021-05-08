<?php

?>

<!-- ************* new navbar ************ -->
<div style="height: 62.4px; font-family: Times New Romen; background: rgb(177, 198, 250);" class="mnavbar">

    <ul style="height: 62.4px; padding: 0px;" class="mul">
        <li style="height: 62.4px; margin: 0px 15px;" class="mli"><a href="home1.php">Home</a></li>
        <?php if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)): ?>
            <a  href="welcome.php"><li style="height: 62.4px; margin: 0px 15px;" class="right mli">Dashboard</li></a>
        <?php endif; ?>
        <li style="height: 62.4px; margin: 0px 15px;" class="mli"><a href="corona_india.php">Covid Cases</a></li>
        <li style="height: 62.4px; margin: 0px 15px;" class="mli"><a href="hospital_details1.php">Hospital Detail</a></li>
        <li style="height: 62.4px; margin: 0px 15px;" class="mli"><a href="contact_us.php">Contact us</a></li>
        <li style="height: 62.4px; margin: 0px 15px;" class="mli"><a href="about_us.php">About us</a></li>
        <li style="height: 62.4px; margin: 0px 15px;" class="mli"><a href="#"><img src="./images/moon.png" id="moon" width="20px" alt="df">
        
        <?php if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)): ?>
            <a  href="logout.php"><li style="height: 62.4px; margin: 0px 15px; float: right;" class="right mli">Logout</li></a>
            <a  href="update.php"><li style="height: 62.4px; margin: 0px 15px; float: right;" class="right mli">Update</li></a>
        <?php else: ?>
            <a  href="register.php"><li style="height: 62.4px; margin: 0px 15px; float: right;" class="right mli">Register</li></a>
            <a  href="login.php"><li style="height: 62.4px; margin: 0px 15px; float: right;" class="right mli">Login</li></a>
        <?php endif; ?>
    </ul>

</div>


