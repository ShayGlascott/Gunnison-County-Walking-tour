<?php
require('model.php');
$conn = connectDb();
$sites = getSites($conn);
$data = getHomeData($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> Historic Walking Tour </title>
  <!-- code to move to element after link click -->
  <link rel="stylesheet" href="indexStyling.css">
  <link rel="stylesheet" href="navbarStyling.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body onload="startSlideshow()">
  <?php createNavbar(); ?>
  <br><br><br><br>


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
          <div class='mySlides fade'>
            <div class='captionText'>
              <?php echo $pics['oldImage_caption']; ?>
            </div>
            <img src='pictures/<?php echo $pics['oldImage_fname']; ?>' style='width:50%'>
          </div>
          <?php
        endforeach;
        ?>
        <script src="slideshow.js"></script>
        <!-- Next and previous buttons -->
      </div>

      <br>
      <h2>How to go on the tour...</h2>
      <p>
        <?php echo $data['how_to_text']; ?>
      </p>
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