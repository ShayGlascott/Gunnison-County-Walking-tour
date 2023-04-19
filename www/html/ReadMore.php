<?php 
$host = 'mysql';
$db_name = 'tourdb';
$username = 'user';
$password = 'password';

try {
  $conn = new PDO('mysql:host=mysql;port=3306;dbname=tourdb', 'root', 'secret');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}
$t1q = "SELECT * FROM `historic_sites` WHERE id = " . $_GET['id'];
$statement = $conn->prepare($t1q);
$statement->execute();
$data= $statement->fetchAll();

?>

<html>
    <?php foreach($data as $data): ?>
<head>
        
    <link rel="stylesheet" href="readMoreStyling.css">
</head>
<body>
<header id="navbar">
        <nav class="navbar-container container">
          <a class="home-link">
            <div class="navbar-logo">
              <img src = "pictures/cityOfGunniLogo.png" alt = 'navLogo'
                weight = "70px"
                height = "70px" />
            </div>
            Gunnison Walking Tour
          </a>
          <button
            type="button"
            id="navbar-toggle"
            aria-controls="navbar-menu"
            aria-label="Toggle menu"
            aria-expanded="false"
            >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div id="navbar-menu" aria-labelledby="navbar-toggle">
            <ul class="navbar-links">
              <li class="navbar-item"><a class="navbar-link" href="index.php">Home</a></li>
              <li class="navbar-item"><a class="navbar-link" href="tourStops.php">Tours</a></li>
              <li class="navbar-item"><a class="navbar-link" href="about.php">About</a></li>
              <li class="navbar-item"><a class="navbar-link" href="login.php">Login</a></li>
            </ul>
          </div>
        </nav>
      </header>
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
