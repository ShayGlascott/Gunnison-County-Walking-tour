<?php

$dsn = 'mysql:host=localhost;dbname=tour_db';
$username = 'student';
$password = 'CS350';
$db = new PDO($dsn, $username, $password);

#if ($db->errorCode() !== '00000') {
 #  echo ("Connection failed: " . implode(":", $db->errorInfo()));
#} 

$t1q = "SELECT * FROM `historic_sites` WHERE id = 1";
$statement = $db->prepare($t1q);
$statement->execute();
$data= $statement->fetchAll();
/*$t2q = "SELECT text2 FROM historic_sites WHERE id = 1";
$statement = $db->prepare($t2q);
$statement->execute();
$extendedString = $statement->fetchAll();*/

?>

<html>
  <head>
    <style>
      .slideshow {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 500px;
        overflow: hidden;
      }

      .slides {
        display: flex;
        width: 100%;
        height: 100%;
        animation: slide 16s infinite;
      }

      .slide {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
      }

      @keyframes slide {
        0% {
          transform: translateX(0%);
        }
        100% {
          transform: translateX(-100%);
        }
      }
    </style>
    <title></title>
  </head>
  <body>
  <?php foreach($data as $data): ?>

    <h1><?php echo $data["title"] ?></h1>

    <!-- Slideshow of pictures of the location. This will be easy to automatically make with php -->
    
    <h2>Pictures</h2>
    <!--<div class="slideshow">
      <div class="slides">
        <div class="slide" style="background-image: url(image.jpg)"></div>
        <div class="slide" style="background-image: url(image.jpg)"></div>
        <div class="slide" style="background-image: url(image.jpg)"></div>
      </div>
    </div>
    -->

    <!-- Information about the location -->
    
    <h2>Introduction:</h2>
    

    <p><?php echo $data['text1']; ?></p>

    <!-- Further information and pictures for those interested in reading more -->

    <h2>Read More:</h2>
    <p><?php echo $data['text2']; ?></p>
    <?php endforeach; ?>
  </body>
</html>

