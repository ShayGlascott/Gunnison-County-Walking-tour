<?php
//verify that the session is active and login was successful
session_start();

if(!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1){
    //if usr isnt logged in redirect to login page
    echo "<script>location.href='login.php';</script>";
    exit;
}
?>

<html>
    <h1>Admin page test</h1>
</html>
