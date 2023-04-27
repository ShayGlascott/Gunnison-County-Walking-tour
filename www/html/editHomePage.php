<?php
session_start();

if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
  //if usr isnt logged in redirect to login page
  echo "<script>location.href='login.php';</script>";
  exit;
}

require('model.php');
$conn = connectDb();
$data = getHomeData($conn);
require("editHome.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_FILES['file'])) {

    //change to save to pictures
    $uploadDir = 'pictures/';
    $fileName_1 = $_FILES['file']['name'];
    $filePath_1 = $uploadDir . $fileName_1;
    echo $filePath_1;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath_1)) {
      $query = "UPDATE home SET map_fname = '$filePath_1'";
      if ($s = $conn->prepare($query)) {
        echo "<script>alert('The map was updated Successfully!');</script>;";
        $s->execute();
      } else {
        echo "<script>alert('Error uploading map!');</script>;";

      }

    }
  }
  if (
    isset($_POST['intro_heading_text']) ||
    isset($_POST['intro_text']) ||
    isset($_POST['how_to_text']) ||
    isset($_POST['address']) ||
    isset($_POST['city_state_zip']) ||
    isset($_POST['phone_number']) ||
    isset($_POST['email'])
  ) {
    $intro_heading_text = $_POST['intro_heading_text'];
    $intro_text = $_POST['intro_text'];
    $how_to_text = $_POST['how_to_text'];
    $address = $_POST['address'];
    $city_state_zip = $_POST['city_state_zip'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    editHomePage($conn,$intro_heading_text,$intro_text,$how_to_text,$address,$city_state_zip,$phone_number,$email);
}
}
?>