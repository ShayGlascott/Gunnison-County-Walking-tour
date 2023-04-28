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
<?php createNavbar(); ?>

  <br><br><br><br>
  <div class=main-info>
    <?php foreach ($data1 as $data1): ?>

      <h2>How to go on the tour...</h2>
      <p>
        <?php echo $data1['how_to_text']; ?>
      </p>
      <div style="position:relative">
        <img src="<?php echo $data1['map_fname']; ?>" class="map" alt="Map of Gunnison, Colorado">
        <br>
      </div>
      <div>
        <ul>
          <?php
          $i = 1; foreach ($data as $site): ?>
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

              <img src="pictures/logo.png" alt="Logo" style = "height:200px;"><br><br>
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