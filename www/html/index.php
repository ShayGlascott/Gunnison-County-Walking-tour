<?php
require('model.php');
$conn = connectDb();
$sites = getSites($conn);
$data = getHomeData($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- code to move to element after link click -->
  <link rel="stylesheet" href="indexStyling.css">
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

  <!-- <script src="slideshow.js"></script> -->

  <!-- Add your content here -->
  <div class=main-info>

    <?php foreach ($data as $data): ?>
      <h2>
        <?php echo $data['intro_heading_text']; ?>
      </h2>
      <p>
        <?php echo $data['intro_text']; ?>


        <!-- slideshow of old images -->
      <h2>
        
      </h2>
      <br>
      <div class="slideshow-container">
        <?php
        $slideShowPics = getSlideshowPics($conn);
        $max = count($slideShowPics); foreach ($slideShowPics as $pics):
          ?>
          <div class='mySlides'>
            <div class='captionText' ><?php echo $pics['oldImage_caption'];  ?></div>
            <img src='pictures/<?php echo $pics['oldImage_fname']; ?>' style='width:50%'>
          </div>
          <?php
        endforeach;
        ?>
        <script src="slideshow.js"></script>
        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
      <br>
      <h2>Points of Interest</h2>
      <div style="position:relative">
        <img src="<?php echo $data['map_fname']; ?>" class="map" alt="Map of Gunnison, Colorado">
        <br>
      </div>
      <div>
        <ul>
          <?php
          $i = 1; foreach ($sites as $site): ?>
            <li><a class="siteLinks" href="tour.php?id=<?php echo $site['id']; ?>"><?php echo $i . ') ' . $site['title'];
               $i += 1; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>


      <!-- This is extra information that will probably be desired.  How to go on the tour, scan QR code,
        find more locations, etc. -->

      <h2>How to go on the tour...</h2>
      <p>
        <?php echo $data['how_to_text']; ?>
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
                  <?php echo $data['address']; ?>
                </li>
                <li>
                  <?php echo $data['city_state_zip']; ?>
                </li>
                <li>Phone:
                  <?php echo $data['phone_number']; ?>
                </li>
                <li>Email:
                  <?php echo $data['email']; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </footer>
</body>

</html>