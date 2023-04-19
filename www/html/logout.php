<?php 
session_start();

if(!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1){
    //if usr isnt logged in redirect to login page
    echo "<script>location.href='login.php';</script>";
    exit;
}
session_regenerate_id();
$_SESSION['isVerified'] = -1;
$_SESSION['name'] = '';
$_SESSION['id'] = -1;
echo "<script>location.href='index.php';</script>";
?>