<?php
require('model.php');
$conn = connectDb();
$getId = $_GET['id'];
$data = getTourStopById($conn, $getId);
$last_site_id = $conn->query("SELECT id FROM `historic_sites` ORDER BY id DESC LIMIT 1")->fetchColumn();
$data1 = getHomeData($conn);

?>


<html>

<head>
  <link rel="stylesheet" href="tourStyling.css">
  <link rel="stylesheet" href="navbarStyling.css">
</head>

<body>
  <?php createNavbar(); ?>
  <br><br><br><br>
  <script src="index.js"></script>
  <?php foreach ($data as $data): ?>

    <h1>
      <?php echo $data["title"] ?>
    </h1>

    <div class="row">
      <div class="column">
        <img class="pictures" src="pictures/<?php echo $data['img1_fname']; ?>">
      </div>
      <div class="column">
        <img class="pictures" src="pictures/<?php echo $data['img2_fname']; ?>">
      </div>
    </div>

    <script>
      const container = document.querySelector('.row');
      const images = container.querySelectorAll('.pictures');
      let aspectRatio = images[0].naturalWidth / images[0].naturalHeight;

      function resizeImages() {
        aspectRatio = images[0].naturalWidth / images[0].naturalHeight;
        for (let i = 0; i < images.length; i++) {
          images[i].style.width = container.offsetWidth / 2 + 'px';
          images[i].style.height = container.offsetWidth / (2 * aspectRatio) + 'px';
        }
      }

      // Call resizeImages initially and on resize
      resizeImages();
      window.addEventListener('resize', resizeImages);

    </script>

    <h2>Information</h2>

    <!-- Information about the location -->
    <?php echo $data['text1']; ?>

    <!-- Further information and pictures for those interested in reading more -->
    <?php $id = $data['id'] ?>
    <!--Getting the id for the item that is being displayed-->
    <div class='readMoreLink'>
      <?php echo '<a href="ReadMore.php?id=' . $id . '" style="text-decoration: none; ">Read More</a>'; ?>
    </div>

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
  <?php foreach ($data1 as $data1): ?>
  <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-4">

              <img src="pictures/logo.png" alt="Logo" style = "height:200px; weight:200px;"><br><br>
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