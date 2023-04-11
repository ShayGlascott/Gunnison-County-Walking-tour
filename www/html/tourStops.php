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
    $t1q = "SELECT * FROM `historic_sites`";
    $stmt = $conn->prepare($t1q);
    $stmt->execute();
    $data= $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel = "stylesheet" href = "indexStyling.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <br><br><br><br>
    <script src="index.js"></script>
    <div class = main-info>
            <h1>Points of Interest</h1>
            <!-- <style>
              h1{
                font-size: 100px;
              }
            </style> -->
            <div style="position:relative">
              <img src="mapMaterials/map.jpg" class="map" alt="Map of Gunnison, Colorado">
              <br>
              <a href="#region1" style="position:absolute; left:10%; top:20%;">Region 1</a>
              <a href="#region2" style="position:absolute; left:20%; top:40%;">Region 2</a>
              <a href="#region3" style="position:absolute; left:30%; top:30%;">Region 3</a>
            </div>
            <ul>
            <?php foreach ($data as $site): ?>
                <li><a href="tour.php?id=<?php echo $site['id']; ?>"><?php echo $site['title']; ?></a></li>
            <?php endforeach; ?>
            </ul>

            <!-- This is extra information that will probably be desired.  How to go on the tour, scan QR code,
            find more locations, etc. -->

            <h2>How to go on the tour...</h2>
            
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat imperdiet sed euismod nisi porta. Eget magna fermentum iaculis eu non diam phasellus vestibulum lorem. </p>
            <br>
    
    
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