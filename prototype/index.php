<?php

$servername = 'localhost';
$username = 'student';
$password = 'CS350';
$dbname = 'tour_db';


$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error){
  die("Connection failed: ".$conn->connect_error);
}

$t1q = $conn->query("SELECT * FROM historic_sites");
$sites = array();

if ($t1q->num_rows> 0){
  while($row = $t1q->fetch_assoc()){
    $site = array(
      'id' => $row['id'],
      'img1_fname' => $row['img1_fname'],
      'img1_altText' => $row['img1_altText'],
      'img1_caption' => $row['img1_caption'],
      'img2_fname' => $row['img2_fname'],
      'img2_altText' => $row['img2_altText'],
      'img2_caption' => $row['img2_caption'],
      'title' => $row['title'],
      'text1' => $row['text1'],
      'text2' => $row['text2'],
    );
    array_push($sites,$site);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  
    <!-- code to move to element after link click -->
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
      <!-- Add your content here -->
      <div class = main-info>
        <h2>Information</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

        <h2>Points of Interest</h2>
        <div class="map">
          <img src="pictures/map.jpg" alt="Map of Gunnison, Colorado"
          >
          <br>
          <a href="#region1" class="region1">Region 1</a>
          <a href="#region2" class="region2">Region 2</a>
          <a href="#region3" class="region3">Region 3</a>
        </div>
        <ul>
          <?php foreach ($sites as $site): ?>
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
              <a href="about.php">About Us</a>
            </div>
            <div class="col-md-4">
              <img src="pictures/cityOfGunniLogo.png" alt="Logo">
            </div>
            <div class="col-md-4">
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
