<?php
require('model.php');
$conn = connectDb();
$data = getTourStopById($conn, $_GET['id']);
?>

<html>
<?php foreach ($data as $data): ?>

  <head>
    <link rel="stylesheet" href="navbarStyling.css">
    <link rel="stylesheet" href="readMoreStyling.css">
  </head>

  <body>
    <?php createNavbar(); ?>
    <br><br><br><br>
    <h1>More Info </h1>
    <script src="index.js"></script>
    <div>
    <?php echo $data['text2']?> 
    <?php endforeach; ?>

    <?php $next_site_id = $getId + 1 ?>
    <br>
    <button onclick="window.location.href ='tour.php?id=<?php echo $next_site_id; ?>;'">Next Stop</button>
  </div>

</body>
<?php 
    createFooter($data);
 ?>

</html>