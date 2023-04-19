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
    <a href='index.php'>HOME</a>
    <a href='admin.php'>ADMIN</a>
    <a href='logout.php'>LOGOUT</a>
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
  $t1q = "SELECT * FROM users WHERE id > 0";
  $stmt1 = $conn->prepare($t1q);
  $stmt1->execute();
  $data= $stmt1->fetchAll();

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
  <div class="title">Add User</div>
  <table>
    <tr>
    <form method="post">
      <td>
          <label for="Username">Username:</label>
      </td>
      <td>
          <input type='text' name="username" required>
      </td>
    </tr>
    <tr>
      <td> 
        <label for="password1">Password:</label>
      </td>
      <td>
        <input type='password' name='password1' required>
      </td>
    </tr>
    <tr>
      <td>
        <label for="password2">Re-enter Password:</label>
      </td>
      <td>
          <input type='password' name='password2' reqired><br>
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" value="Add User">
        <input type="hidden" value="add_user" name='update'>
      </form>
      </td>
          
    </tr>
  </table>

</div>
<div class="box">
  <div class="title">Edit Users</div>
  <table>
    <tr>
      <th>User</th>
      <th>Delete</th>
    </tr>
    <?php
    foreach ($data as $user): ?>
    <tr>
      <td><?php echo $user['uName']; ?></td>
      <!-- Button to delete user -->
      <td>
        <form action="admin.php" method="POST">
          <input type='hidden' name='update' value='delete_user'>
          <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
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
            <form action="editor.php" method="GET">
              <input type="hidden" name="function" value="edit_site_page">
              <input type="hidden" name="site_id" value="<?php echo $site_id; ?>">
              <input type="submit" value="Edit">
            </form>
          </td>
          <!-- Button to delete stop -->
          <td>
            <form action="editor.php" method="GET">
              <input type="hidden" name="function" value="delete_stop">
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
      <form action="editor.php" method="GET">
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
      

      $stmt2 = $conn->prepare("UPDATE historic_sites
        SET 
            img1_altText = ?,
            img1_caption = ?,
            img2_altText = ?,
            img2_caption = ?,
            title = ?
            WHERE id= 
        " .$update_id);

      $stmt2->execute([$img1_altText,$img1_caption,$img2_altText,$img2_caption,$title]);

     
        echo "<script>alert('Updated Successfully!');</script>;";

        echo "<script>location.href='admin.php';</script>";

      break;
      case "add_user":
        $username = $_POST['username'];
        $sql = "SELECT * FROM users WHERE uName = '$username'";

        // Execute the SELECT statement
        $result = $conn->query($sql);

        // Check if the username already exists
        if ($result->num_rows > 0) {
            echo "Username already exists";
        } else {
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            if($password1 === $password2){
              $password = password_hash($password1, PASSWORD_DEFAULT);
              $sql = "INSERT INTO users(`uName`, `passwd`) VALUES (:uName, :passwd)";
      
              // Prepare the query
              $stmt = $conn->prepare($sql);
              
              // Bind the parameters
              $stmt->bindParam(':uName', $username);
              $stmt->bindParam(':passwd', $password);
      
              // Execute the query and insert the data into the database
              if ($stmt->execute()) {
                  // Query executed successfully
                  echo "<script>alert('A new user has been added!');</script>;";

              } else {
                  // Error executing query
                  echo "<script>alert('ERROR ADDING USER.Please try again.');</script>;";

              }
            }
            else{
              echo "<script>alert('Passwords did not match, Please try again.');</script>;";

            }
      }
        echo "<script>location.href='admin.php';</script>";
        break;
        case "delete_stop":
          $name = $_POST['name'];
          $dID = $_POST['site_id'];
          $stmt = $conn->prepare("SELECT * FROM historic_sites WHERE id = :id");
          $stmt->bindParam(":id", $dID);
          $stmt->execute();
          $data = $stmt->fetch();
          if($name == $data['title']){
            $stmt = $conn->prepare("DELETE FROM historic_sites WHERE id = :id");
            $stmt->bindParam(":id", $dID);
            $stmt->execute();
            echo "<script>location.href='admin.php';</script>";


          }else{
            echo "<script>alert('ERROR: Delete from database failed, Please try again.');</script>;";

          }
          break;
          case "delete_user":
            $uid = $_POST['user_id'];
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(":id",$uid);
            if ($stmt->execute()) {
              // Query executed successfully
              echo "<script>alert('A user was deleted!');</script>;";
          } else {
              // Error executing query
              echo "<script>alert('ERROR DELETING USER.Please try again.');</script>;";
          }
          echo "<script>location.href='admin.php';</script>";
          
  }
  
   
  


  // Confirmation before delete:  Type the full name of the site exactly as it appears in the database.
  
  // Delete row with id matching $site_id
  //$sql = "DELETE * FROM historic_sites WHERE id=$site_id";
  //$result = $conn->query("DELETE * FROM historic_sites WHERE id=$site_id");
  
  
}
?>