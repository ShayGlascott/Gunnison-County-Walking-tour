<?php
//verify that the session is active and login was successful
session_start();

if(!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1){
    //if usr isnt logged in redirect to login page
    echo "<script>location.href='login.php';</script>";
    exit;
}

?>
<html>
  <head>
    <style>
      .box {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
      }
  
      .title {
        background-color: #ccc;
        padding: 10px;
        font-weight: bold;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        text-align: center;
      }
    </style>
    <title>Gunnion Historic Walking Tour</title>
  </head>

<?php

$servername = 'localhost';
$username = 'student';
$password = 'CS350';
$dbname = 'tour_db';

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
  // Retrieve all rows from historic_sites table
  //$sql = "SELECT * FROM historic_sites";
  $result = $conn->query("SELECT * FROM historic_sites");
  
  // Create array to hold sites data
  $sites = array();
  
  // Loop through each row and add it to the sites array
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $site = array(
        'id' => $row['id'],
        'img1_fname' => $row['img1_fname'],
        'img1_altText' => $row['img1_altText'],
        'img1_caption' => $row['img1_caption'],
        'img2_fname' => $row['img2_fname'],
        'img2_altText' => $row['img2_altText'],
        'img2_caption' => $row['img2_caption'],
        'title' => $row['title']
      );
      array_push($sites, $site);
    }
  }
  
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $POST['user_id']
  $operation = $_POST['function'];
  echo $user_id
  $stmt = $conn->query("SELECT * FROM users");  
  //empty array for users 
  $users = array();

  //loop through users and add them to users array
  if($stmt->num_rows > 0){
      while($rows = $stmt->fetch_assoc()){
          $user = array(
              'id' => $rows['id'],
              'username' => $rows['uName'],
              'password' => $rows['passwd'],
          );
          array_push($users,$user);
      }
  }
  echo $operation;
} 
?>
  <body>
    <div class="box">
      
    <?php 
    switch ($operation) {
      case "edit_main_page":
        ?>

        <?php
          break;
      case "edit_site_page":
        ?>

        <?php
          break;
      case "edit_user_page":
        ?>
        <html>
        
        <?php foreach($users as $user): ?>
        <h1>Edit user <?php echo $user['username']; ?></h1>

        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username_<?php echo $user['id']; ?>" value="<?php echo $user['username']; ?>" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password_<?php echo $user['id']; ?>" value="<?php echo $user['password']; ?>" required><br>
            <input type="submit" name="submit" value="Login">
        </form>
        <?php endforeach; ?>

        </html>

        <?php
          break;
      
    }
    ?>

    </div>
  </body>
</html>


<?php 
// Close database connection
$conn->close();

?>
