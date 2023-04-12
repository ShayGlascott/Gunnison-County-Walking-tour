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

$sites = array();

$stmt = $conn->prepare("SELECT * FROM historic_sites");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
  $stmt1 = $conn->query("SELECT * FROM users WHERE id > 0");
  $stmt1->execute();
    //empty array for users 
    $users = array();
    
    //loop through users and add them to users array
    if($stmt1->num_rows > 0){
        while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user = array(
                'id' => $rows['id'],
                'username' => $rows['uName'],
                'password' => $rows['passwd'],
            );
            array_push($users,$user);
        }
    }

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
    //sql connection to get users that are not admin
    
  }

?>

  <body>
    <h1>Gunnison Walking Tour Administration Page</h1>
    <?php
if ($_SESSION['id'] == 0) {
?>
<div class="box">
  <div class="title">Edit Users</div>
  <table>
    <tr>
      <th>User</th>
      <th>Delete</th>
    </tr>

    <?php
    foreach ($users as $user):
      $user_id = $user['id'];
      $username = $user['username'];
    ?>

    <tr>
      <td><?php echo $username; ?></td>
      <!-- Button to delete user -->
      <td>
        <form action="admin.php" method="POST">
          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
          <input type="submit" value="Delete">
        </form>
      </td>
    </tr>

    <?php
    endforeach;
    ?>

  </table>
</div>
<?php
} 
?>

    <!-- Button to edit main page -->
    <form action="editor.php" method="POST">
      <input type="hidden" name="function" value="edit_main_page">
      
      <input type="submit" value="Edit Main Page">
    </form>
  
    <!-- List of tour stops -->
    <div class="box">
      <div class="title">Tour Stops</div>
      <table>
        <tr>
          <th>Site Name</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>

        <?php
        foreach ($sites as $site):
          $site_id = $site['id'];
          $name = $site['title'];
        ?>

        <tr>
          <td><?php echo $name; ?></td>
          <!-- Button to edit stop -->
          <td>
            <form action="editor.php" method="POST">
              <input type="hidden" name="function" value="edit_site_page">
              <input type="hidden" name="site_id" value="<?php echo $site_id; ?>">
              <input type="submit" value="Edit">
            </form>
          </td>
          <!-- Button to delete stop -->
          <td>
            <form action="admin.php" method="POST">
              <input type="hidden" name="update" value="delete">
              <input type="hidden" name="site_id" value="<?php echo $site_id; ?>">
              <input type="submit" value="Delete">
            </form>
          </td>
        </tr>

        <?php
        endforeach;
        ?>

      </table>
    
      <!-- Button to create a new stop -->
      <form action="editor.php" method="post">
        <input type="hidden" name="function" value="new_tour_stop">
        <input type="submit" value="New Tour Stop">
      </form>
  
    </div>
  </body>
</html>


<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $update = $_POST['update'];

  switch($update){
    case "site":
      $update_id = $_POST['update_site_id'];
      $img1_altText = $_POST['img1_alt'];
      $img1_caption = $_POST['img1_cap'];

      $img2_altText = $_POST['img2_alt'];
      $img2_caption = $_POST['img2_cap'];

      $title = $_POST['title'];
      $text1 = $_POST['text1'];
      $text2 = $_POST['text2'];

      $stmt = $conn->prepare("UPDATE historic_sites
        SET 
            img1_altText = ?,
            img1_caption = ?,
            
            img2_altText = ?,
            img2_caption = ?,
            title = ?,
            text1 = ?,
            text2 = ?
        WHERE id = ?
      ");

      $stmt->execute([$img1_altText, $img1_caption, $img2_altText, $img2_caption, $title, $text1, $text2, $update_id]);


     
        echo "<script>alert('Updated Successfully!');</script>;";

        echo "<script>location.href='admin.php';</script>";

      break;
  }
  
  $site_id = $_POST['site_id'];
  


  // Confirmation before delete:  Type the full name of the site exactly as it appears in the database.
  
  // Delete row with id matching $site_id
  //$sql = "DELETE * FROM historic_sites WHERE id=$site_id";
  //$result = $conn->query("DELETE * FROM historic_sites WHERE id=$site_id");
  
  
}
?>