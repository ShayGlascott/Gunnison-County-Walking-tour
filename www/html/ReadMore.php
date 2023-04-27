<?php
require('model.php');
$conn = connectDb();
$data = getTourStopById($conn, $_GET['id']);
?>

<html>

<head>
  <title> Historic Walking Tour </title>
  <!-- code to move to element after link click -->
  <link rel="stylesheet" href="indexStyling.css">
  <link rel="stylesheet" href="navbarStyling.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <?php createNavbar(); ?>
  <br><br><br><br>
  <h1>More Info </h1>
  <script src="index.js"></script>
  <div>
    <?php foreach ($data as $row) : ?>
      <?php echo $row['text2']; ?>
    <?php endforeach; ?>
    <?php $next_site_id = $getId + 1 ?>
    <br>
    <button onclick="window.location.href ='tour.php?id=<?php echo $next_site_id; ?>;'">Next Stop</button>
  </div>
</body>
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

</html>