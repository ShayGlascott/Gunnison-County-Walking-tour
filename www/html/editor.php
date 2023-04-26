<?php
//verify that the session is active and login was successful
session_start();
if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
  //if usr isnt logged in redirect to login page
  echo "<script>location.href='login.php';</script>";
  exit;
}
?>
<html>

<head>

  <link rel="stylesheet" href="editorStyling.css">
  <title>Gunnion Historic Walking Tour</title>
</head>

<body>
  <header id="navbar">
    <nav class="navbar-container container">
      <a class="home-link">
        <div class="navbar-logo">
          <img src="pictures/cityOfGunniLogo.png" alt='navLogo' weight="70px" height="70px" />
        </div>
        Gunnison Walking Tour
      </a>
      <button type="button" id="navbar-toggle" aria-controls="navbar-menu" aria-label="Toggle menu"
        aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div id="navbar-menu" aria-labelledby="navbar-toggle">
        <ul class="navbar-links">
          <li class="navbar-item"><a class="navbar-link" href="index.php">Home</a></li>
          <li class="navbar-item"><a class="navbar-link" href="tourStops.php">Tours</a></li>
          <li class="navbar-item"><a class="navbar-link" href="about.php">About</a></li>
          <li class="navbar-item"><a class="navbar-link" href="login.php">Login</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <br><br><br><br>
  <script src="index.js"></script>
  <?php


  require('model.php');
  $site_id = $_GET['site_id'];
  $operation = $_GET['function'];
  $conn = connectDb();

  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($operation == "edit_site_page" || $operation == 'delete_stop') {
      $sites = array();
      $data = getTourStopById($conn, $site_id);
    }
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        add_new_site($conn,$img1_altText,$img1_caption,$img2_altText,$img2_caption,$title,$text1,$text2,$filName_1,$fileName_2);
      }
    } else {


      if (isset($_FILES['1file'])) {
        $uploadDir = 'pictures/';
        $fileName_1 = $_FILES['1file']['name'];
        $filePath_1 = $uploadDir . $fileName_1;
        $fileName_2 = $_FILES['2file']['name'];
        $filePath_2 = $uploadDir . $fileName_2;

        if (move_uploaded_file($_FILES['1file']['tmp_name'], $filePath_1)) {
        updateImg1($conn,$fileName_1,$site_id);
        } else {
          echo "<script>alert('The First image had an error while being updated or was missing. Please try again');</script>;";

        }
      }
      if (isset($_FILES['2file'])) {
        $uploadDir = 'pictures/';
        $fileName_2 = $_FILES['2file']['name'];
        $filePath_2 = $uploadDir . $fileName_2;
        if (move_uploaded_file($_FILES['2file']['tmp_name'], $filePath_2)) {
          updateImg1($conn,$fileName_2,$site_id);
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
    switch ($operation) {
      case "edit_main_page":
        ?>

        <?php
        break;
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
