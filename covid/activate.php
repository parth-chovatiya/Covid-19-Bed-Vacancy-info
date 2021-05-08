<?php 
    session_start();
    include 'partials/_dbconnect.php';

    if(isset($_GET['token'])){
        
        $token = $_GET['token'];

        $updatequery = "UPDATE `hospitals` SET `status`='active' WHERE `token`='$token'";
        $query = mysqli_query($conn, $updatequery);

        if($query){
            if(isset($_SESSION['msg'])){
                $_SESSION['msg'] = "Account Activated Successfully";
                header('location:login.php');
            }
            else{
                $_SESSION['msg'] = "You are logged out";
                header('location:login.php');
            }
        }
        else{
            $_SESSION['msg'] = "You Not Activated";
            header('location:register.php');
        }
    }


?>