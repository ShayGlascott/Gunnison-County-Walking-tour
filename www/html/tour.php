<?php

$host = 'mysql';
$db_name = 'tourdb';
$username = 'user';
$password = 'password';

try {
  $conn = new PDO('mysql:host=mysql;port=3306;dbname=tourdb', 'root', 'secret');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}
$getId = $_GET['id'];
$t1q = "SELECT * FROM `historic_sites` WHERE id = " . $getId;
$statement = $conn->prepare($t1q);
$statement->execute();
$data= $statement->fetchAll();

$last_site_id = $conn->query("SELECT id FROM `historic_sites` ORDER BY id DESC LIMIT 1")->fetchColumn();
?>

<html>
  <head>
    <link rel = "stylesheet" href = "tourStyling.css">

  </head>
  <body>
  <header id="navbar">
      <nav class="navbar-container container">
        <a class="home-link">
          <div class="navbar-logo">
            <img src = "pictures/cityOfGunniLogo.png" alt = 'navLogo'
              weight = "70px"
              height = "70px" />
          </div>
          Gunnison Walking Tour
        </a>
        <button
          type="button"
          id="navbar-toggle"
          aria-controls="navbar-menu"
          aria-label="Toggle menu"
          aria-expanded="false"
          >
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
    <br><br>
    <br><br>
    <script src="tour.js"></script>

  <?php foreach($data as $data): ?>

    <h1><?php echo $data["title"] ?></h1>

    <div class="row">
      <div class = "column">
        <img class = "pictures" src="pictures/<?php echo $data['img1_fname']; ?>">
      </div>
      <div class = "column">
        <img class = "pictures" src="pictures/<?php echo $data['img2_fname']; ?>">
      </div>  
    </div>
    <h2>Information</h2>
  
    <!-- Information about the location -->
    <?php echo $data['text1']; ?>

    <!-- Further information and pictures for those interested in reading more -->
    <?php $id = $data['id']?>
    <!--Getting the id for the item that is being displayed-->
    <?php echo '<a href="ReadMore.php?id='.$id.'">Read More</a>';?>
    <?php endforeach; ?>
    <?php 
      $next_site_id = $getId + 1;
      if ($next_site_id < $last_site_id) {
    ?>
    <br>
    <button onclick="window.location.href ='tour.php?id=<?php echo $next_site_id; ?>;'">Next Stop</button>
    <?php
      }
    ?>
    <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              
              <img src="pictures/cityOfGunniLogo.png" alt="Logo"><br><br>
              <a href="about.php">About Us</a><br><br>
              <ul>
                <li>123 Main Street</li>
                <li>City, State ZIP</li>
                <li>Phone: 123-456-7890</li>
                <li>Email: info@example.com</li>
              </ul>
            </div>
          </div>
        </div>
      </footer>  
  </body>
</html>
