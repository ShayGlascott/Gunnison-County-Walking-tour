<?php

$servername = 'localhost';
$username = 'student';
$password = 'CS350';
$dbname = 'tour_db';


$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error){
  die("Connection failed: ".$conn->connect_error);
}

$t1q = $conn->query("SELECT * FROM historic_sites");
$sites = array();

if ($t1q-> > 0){
  while($row = $t1q->fetch_assoc()){
    $site = array(
      'id' => $row['id'],
      'img1_fname' => $row['img1_fname'],
      'img1_altText' => $row['img1_altText'],
      'img1_caption' => $row['img1_caption'],
      'img2_fname' => $row['img2_fname'],
      'img2_altText' => $row['img2_altText'],
      'img2_caption' => $row['img2_caption'],
      'title' => $row['title'],
      'text1' => $row['text1'],
      'text2' => $row['text2'],
    );
    array_push($sites,$site);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      .map {
        position: relative;
      }
  
      .map img {
        width: 100%;
        height: auto;
        display: block;
      }
  
      .region1, .region2, .region3 {
        position: absolute;
        display: block;
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.5);
        text-align: center;
        line-height: 50px;
        color: #000;
      }

      .region1 {
        top: 123px;
        left: 630px;
      }
      
      .region2 {
        top: 287px;
        left: 154px;
      }
      
      .region3 {
        top: 167px;
        right: 399px;
      }
    </style>
    <title></title>
  </head>
  <body>

    <h1>Gunnison Historical Walking Tour</h1>

    <!-- Introduction to the tour -->

    <h2>Information</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    <!-- Map of the town and a list of tour stops.  Should be really easy to write php to automatically
    fill all of these in -->
    
    <h2>Points of Interest</h2>
    <div class="map">
      <img src="pictures/map.jpg" alt="Map of Gunnison, Colorado">
      <a href="#region1" class="region1">Region 1</a>
      <a href="#region2" class="region2">Region 2</a>
      <a href="#region3" class="region3">Region 3</a>
    </div>
    <ul>
      <?php foreach ($sites as $site): ?>
        <li><a href="template1.php?id=<?php echo $site['id']; ?>"><?php echo $site['title']; ?></a></li>
      <?php endforeach; ?>
    </ul>

    <!-- This is extra information that will probably be desired.  How to go on the tour, scan QR code,
    find more locations, etc. -->

    <h2>How to go on the tour...</h2>
    <img src="pictures/howto.jpg" alt="How to scan a QR code">
    
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat imperdiet sed euismod nisi porta. Eget magna fermentum iaculis eu non diam phasellus vestibulum lorem. </p>
    
  </body>
</html>