<?php
require('model.php');
$conn = connectDb();
$data = getAllTourData($conn);
$data1 = getHomeData($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="indexStyling.css">
  <link rel="stylesheet" href="navbarStyling.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
  <div class=main-info>
    <?php foreach ($data1 as $data1): ?>

      <h1>How to go on the tour...</h1>
      <div style="position:relative">
        <img src="<?php echo $data1['map_fname']; ?>" class="map" alt="Map of Gunnison, Colorado">
        <br>
      </div>
      <ul>
        <?php foreach ($data as $site): ?>
          <li><a href="tour.php?id=<?php echo $site['id']; ?>"><?php echo $site['title']; ?></a></li>
        <?php endforeach; ?>
      </ul>

      <!-- This is extra information that will probably be desired.  How to go on the tour, scan QR code,
            find more locations, etc. -->

      <h2>How to go on the tour...</h2>
      <p>
        <?php echo $data1['how_to_text']; ?>
      </p>

      <br>


      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-4">

              <img src="pictures/cityOfGunniLogo.png" alt="Logo"><br><br>
              <a href="about.php">About Us</a><br><br>
              <ul>
                <li>
                  <?php echo $data1['address']; ?>
                </li>
                <li>
                  <?php echo $data1['city_state_zip']; ?>
                </li>
                <li>Phone:
                  <?php echo $data1['phone_number']; ?>
                </li>
                <li>Email:
                  <?php echo $data1['email']; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </footer>
</body>

</html>