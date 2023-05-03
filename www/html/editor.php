<?php
require('model.php');
//verify that the session is active and login was successful
session_start();
if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
  //if usr isnt logged in redirect to login page
  echo "<script>location.href='login.php';</script>";
  exit;
}
$site_id = "";
?>
<html>

<head>
  <title> Gunnison Historic Walking Tour </title>
  <link rel="stylesheet" href="editorStyling.css">
  <link rel="stylesheet" href="navbarStyling.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

  <?php createEditorNavbar(); ?>
  <br><br><br><br>
  <?php


  $site_id = $_GET['site_id'];
  $operation = $_GET['function'];
  $conn = connectDb();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //get the site to edit or delete
    if ($operation == "edit_site_page" || $operation == 'delete_stop') {
      $sites = array();
      $data = getTourStopById($conn, $site_id);
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //get site id and add new site
    $site_id = $_POST['site_id'];
    if (isset($_POST['addNew'])) {
      $new = $_POST['addNew'];
    } else {
      $new = "";
    }
    if ($new == 'addIt') {
      if (isset($_FILES['new_1file']) && isset($_FILES['new_2file'])) {
        $uploadDir = 'pictures/';
        $fileName_1 = $_FILES['new_1file']['name'];
        $filePath_1 = $uploadDir . $fileName_1;
        $fileName_2 = $_FILES['new_2file']['name'];
        $filePath_2 = $uploadDir . $fileName_2;

        if (move_uploaded_file($_FILES['new_1file']['tmp_name'], $filePath_1)) {
          $img1_fname = $fileName_1;

        } else {
          echo "<script>alert('The First image had an error while being updated. Please try again');</script>;";

        }
        if (move_uploaded_file($_FILES['new_2file']['tmp_name'], $filePath_2)) {
          $img2_fname = $fileName_2;


        } else {
          echo "<script>alert('The Second image had an error while being updated. Please try again');</script>;";
        }
        $img1_altText = $_POST['new_img1_alt'];
        $img1_caption = $_POST['new_img1_cap'];

        $img2_altText = $_POST['new_img2_alt'];
        $img2_caption = $_POST['new_img2_cap'];

        $title = $_POST['new_title'];
        $text1 = $_POST['new_text1'];
        $text2 = $_POST['new_text2'];

        add_new_site($conn, $img1_altText, $img1_caption, $img2_altText, $img2_caption, $title, $text1, $text2, $fileName_1, $fileName_2);
      }
    } else {
      //update images for existing stops and move files into their respective places

      if (isset($_FILES['1file'])) {
        $uploadDir = 'pictures/';
        $fileName_1 = $_FILES['1file']['name'];
        $filePath_1 = $uploadDir . $fileName_1;
        $fileName_2 = $_FILES['2file']['name'];
        $filePath_2 = $uploadDir . $fileName_2;

        if (move_uploaded_file($_FILES['1file']['tmp_name'], $filePath_1)) {
          updateImg1($conn, $fileName_1, $site_id);
        } else {
          echo "<script>alert('The First image had an error while being updated or was missing. Please try again');</script>;";

        }
      }
      if (isset($_FILES['2file'])) {
        $uploadDir = 'pictures/';
        $fileName_2 = $_FILES['2file']['name'];
        $filePath_2 = $uploadDir . $fileName_2;
        if (move_uploaded_file($_FILES['2file']['tmp_name'], $filePath_2)) {
          updateImg2($conn, $fileName_2, $site_id);
        } else {
          echo "<script>alert('The Second image had an error while being updated or was missing.');</script>;";
        }
      }
      echo "<script>location.href='admin.php';</script>";
    }
  }


  ?>
  <div class="box">
    
    <?php
    //switch to handle logic for CRUD Operations 
    switch ($operation) {
      case "edit_site_page":
        include("edit_site.php");

        break;

      case "new_tour_stop":
        include("new_site.html");
        break;
      case 'delete_stop':
        include("delete_site.php");
        break;
    }
    ?>

  </div>
</body>

</html>