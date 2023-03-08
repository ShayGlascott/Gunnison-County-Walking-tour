<?php

$dsn = 'mysql:host=localhost;dbname=tour_db';
$username = 'student';
$password = 'CS350';
$db = new PDO($dsn, $username, $password);

$t1q = "SELECT * FROM `historic_sites` WHERE id = 1";
$statement = $db->prepare($t1q);
$statement->execute();
$data= $statement->fetchAll();

?>

<html>
  <head>
    <style>
    .image-container img {
      width: 40%;
      
    }

    </style>
    <title></title>
  </head>
  <body>
  <?php foreach($data as $data): ?>

    <h1><?php echo $data["title"] ?></h1>

    <div class="image-container">
      <img src="pictures/<?php echo $data['img1_fname']; ?>">
      <img src="pictures/<?php echo $data['img2_fname']; ?>">
    </div>
  
    <!-- Information about the location -->
    <?php echo $data['text1']; ?>

    <!-- Further information and pictures for those interested in reading more -->
    <?php $id = $data['id']?>
    <!--Getting the id for the item that is being displayed-->
    <?php echo '<a href="ReadMore.php?id='.$id.'">Read More</a>';?>
    <?php endforeach; ?>
  </body>
</html>

