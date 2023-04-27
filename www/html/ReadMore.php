<?php
require('model.php');
$conn = connectDb();
$data = getTourStopById($conn, $_GET['id']);
$getId = $_GET['id'];
$last_site_id = $conn->query("SELECT id FROM `historic_sites` ORDER BY id DESC LIMIT 1")->fetchColumn();
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
    <?php foreach ($data as $row): ?>
      <?php echo "<p> " . $row['text2'] . "<p> "; ?>
    <?php endforeach; ?>
    <div style="    
    display: flex;
    justify-content: space-between;
    text-align: center; 
    padding-right: 20%;
    ">
      <?php
      $prev_site_id = $getId - 1;
      if ($prev_site_id >= 1) {
        ?>
        <br>
        <button class = "tourButtons" onclick="window.location.href ='tour.php?id=<?php echo $prev_site_id; ?>;'">Previous Stop</button>
        <?php
      }
      ?>
      <?php
      $next_site_id = $getId + 1;
      if ($next_site_id < $last_site_id) {
        ?>
        <br>
        <button class = "tourButtons" onclick="window.location.href ='tour.php?id=<?php echo $next_site_id; ?>;'">Next Stop</button>
        <?php
      }
      ?>

    </div>
  </div>
</body>
<?php
createFooter($data);
?>

</html>