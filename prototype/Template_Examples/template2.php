<?php

$dsn = 'mysql:host=localhost;dbname=tour_db';
$username = 'student';
$password = 'CS350';
$db = new PDO($dsn, $username, $password);

$t1q = "SELECT * FROM `historic_sites` WHERE id = 1";
$id = 1;
$statement = $db->prepare($t1q);
$statement->execute();
$data= $statement->fetchAll();

?>

<html>
<?php foreach($data as $data): ?>
  <head>
    <style>
    img{
        max-width: 100%;
        max-height: 100%;
        display: block; /* remove extra space below image */
    }
    
    .location-container {
      position: relative;
      background-image: url("pictures/<?php echo $data['img2_fname']; ?>");
      height: 500px;
      width: auto;
      background-size: cover;
      background-position: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 20px;
    }
    .location-container::before { /* use a pseudo-element to create a layer over the background image */
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
      background-color: rgba(0, 0, 0, 0.4); /* set the background color to a semi-transparent black */
    }
    .location-container h1 {
      color:#FFFFFFFF;
     /*make font larger*/
      order: 1;
      margin: 0;
      z-index: 2;
      text-align: center;
    }

    .location-container p {
      color:#FFFFFFFF;
      order: 2;
      margin: 0;
      z-index: 2;

    }
    .location-container a {
      color:#FFFFFFFF;
      order: 2;
      margin: 0;
      z-index: 2;
    }
  
    </style>
    <title></title>
  </head>
  <body>
  


    <div class="location-container">
      <h1><?php echo $data["title"] ?></h1>
      <!-- Information about the location -->
      
      <?php echo $data['text1']; ?>
      <?php echo '<a href="ReadMore.php?id='.$id.'">Read More</a>';?>
    </div>
    <!-- Further information and pictures for those interested in reading more -->

    <?php endforeach; ?>
  </body>
</html>