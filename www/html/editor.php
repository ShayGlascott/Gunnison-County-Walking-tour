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
      .image-preview {
        display: flex;
        flex-wrap: wrap;
      }

      .preview_img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        margin: 10px;
      }
      #textboxid
      {
          height:100px;
          width: 300px;
          font-size:10pt;
      }


    </style>
    <link rel="stylesheet" href="style.css">
    <title>Gunnion Historic Walking Tour</title>
  </head>
  
  
  <body>
<?php

$site_id = $_POST['site_id'];
$_SESSION['sID'] = $site_id;
$operation = $_POST['function'];
$_SESSION['op'] = $operation;
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




if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST["site_id"])){
    $sites = array();
    $t1q = "SELECT * FROM `historic_sites` WHERE id = " . $site_id;
    $stmt = $conn->prepare($t1q);
    $stmt->execute();
    $data= $stmt->fetchAll();
  }

  if(isset($_POST['addNew'])){
    $new = $_POST['addNew'];
  }
  else{
    $new = "";
  }
  if($new == 'addIt'){
    if (isset($_FILES['new_1file']) && isset($_FILES['new_2file'])) {
      $uploadDir = 'pictures/';
      $fileName_1 = $_FILES['new_1file']['name'];
      $filePath_1 = $uploadDir . $fileName_1;
      $fileName_2 = $_FILES['new_2file']['name'];
      $filePath_2 = $uploadDir . $fileName_2;
  
        if (move_uploaded_file($_FILES['new_1file']['tmp_name'], $filePath_1)) {
          $img1_fname = $fileName_1;

          } else {
            echo "<script>alert('The First image had an error while being updated. Please try again');</script>;";
  
        }
        if (move_uploaded_file($_FILES['new_2file']['tmp_name'], $filePath_2)) {
          $img2_fname = $fileName_2;

  
        } else {
          echo "<script>alert('The Second image had an error while being updated. Please try again');</script>;";
  
      }
        $img1_altText = $_POST['new_img1_alt'];
        $img1_caption = $_POST['new_img1_cap'];

        $img2_altText = $_POST['new_img2_alt'];
        $img2_caption = $_POST['new_img2_cap'];

        $title = $_POST['new_title'];
        $text1 = $_POST['new_text1'];
        $text2 = $_POST['new_text2'];

            $sql = "INSERT INTO `historic_sites`(`img1_fname`, `img1_altText`, `img1_caption`, `img2_fname`, `img2_altText`, `img2_caption`, `title`, `text1`, `text2`) 
            VALUES (:img1_fname, :img1_altText, :img1_caption, :img2_fname, :img2_altText, :img2_caption, :title, :text1, :text2)";
    
            // Prepare the query
            $stmt = $conn->prepare($sql);
            
            // Bind the parameters
            $stmt->bindParam(':img1_fname', $img1_fname);
            $stmt->bindParam(':img1_altText', $img1_altText);
            $stmt->bindParam(':img1_caption', $img1_caption);
            $stmt->bindParam(':img2_fname', $img2_fname);
            $stmt->bindParam(':img2_altText', $img2_altText);
            $stmt->bindParam(':img2_caption', $img2_caption);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text1', $text1);
            $stmt->bindParam(':text2', $text2);
    
    // Execute the query and insert the data into the database
    if ($stmt->execute()) {
        // Query executed successfully
        echo "<script>alert('New Site has been created!');</script>;";

    } else {
        // Error executing query
        echo "<script>alert('ERROR ADDING NEW SITE.Please try again.');</script>;";

    }
    

           


        echo "<script>location.href='admin.php';</script>";


     
        

  
    }else{


  if (isset($_FILES['1file']) && isset($_FILES['2file'])) {
    $uploadDir = 'pictures/';
    $fileName_1 = $_FILES['1file']['name'];
    $filePath_1 = $uploadDir . $fileName_1;
    $fileName_2 = $_FILES['2file']['name'];
    $filePath_2 = $uploadDir . $fileName_2;

      if (move_uploaded_file($_FILES['1file']['tmp_name'], $filePath_1)) {
        $query = "UPDATE historic_sites SET img1_fname = '$fileName_1' WHERE id = $site_id";
        if ($conn->query($query)) {
          echo "<script>alert('The First image for ".$sites['title'] . "was updated Successfully!');</script>;";

      } else {
        echo "<script>alert('Database error, please try again.');</script>;";
      } 
        
        } else {
          echo "<script>alert('The First image for ".$sites['title'] . "had an error while being updated. Please try again');</script>;";

      }
      if (move_uploaded_file($_FILES['2file']['tmp_name'], $filePath_2)) {
        $query2 = "UPDATE historic_sites SET img2_fname = '$fileName_2' WHERE id = $site_id";
        if ($conn->query($query2)) {
          echo "<script>alert('The Second image for ".$sites['title'] . "was updated Successfully!');</script>;";

      } else {
        echo "<script>alert('Database error, please try again.');</script>;";
      } 

      } else {
        echo "<script>alert('The Second image for ".$sites['title'] . "had an error while being updated. Please try again');</script>;";

    }
      
    } 
  }
}
}
  

?>

  
    <div class="box">
      
    <?php 
    switch ($_SESSION['op']) {
      case "edit_main_page":
        ?>

        <?php
          break;
      case "edit_site_page":
        ?>
<?php foreach($data as $site): ?>
  <h1>Edit site information for <?php echo $site['title']; ?></h1>
  <table>
    <tr>
      <td>
        <div class="image-preview">
          <label for="1file">First Image:</label>
          <input type="file" name="1file" value="pictures/<?php echo $site['img1_fname'] ?>" accept="image/*" onchange="previewImage(event, '1file')" required><br>
          <img id="preview_1file" class="preview_img" src="pictures/<?php echo $site['img1_fname'] ?>" /><br>
        </div>
      </td>
      <td>
        <div class="image-preview">
          <label for="2file">Second Image:</label>
          <input type="file" name="2file" value="pictures/<?php echo $site['img2_fname'] ?>" accept="image/*" onchange="previewImage(event, '2file')"><br>
          <img id="preview_2file" class="preview_img" src="pictures/<?php echo $site['img2_fname'] ?>" /><br>
        </div>
      </td>
    </tr>
    <tr>
    <script>
          function previewImage(event, inputId) {
            var reader = new FileReader();
            reader.onload = function() {
              var outputId = "preview_" + inputId;
              var output = document.getElementById(outputId);
              output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
          }
          </script>
      <td colspan="2">
        <!--form to upload/update files -->
        <form action='editor.php' method="POST" enctype="multipart/form-data" >
          <input type='hidden' name='site_id' value="<?php echo $site_id; ?>">
          <input type="hidden" name="function" value="edit_site_page">
          <input type="submit" name="submit" value="Add Images">
        </form>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <button onclick="window.location.href ='editText1.php?id=<?php echo $site_id; ?>'">Edit Introduction Text</button>
        <button onclick="window.location.href ='editText2.php?id=<?php echo $site_id; ?>'">Edit Read More Text</button>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <!--form to post updated to the admin page -->
        <form action="admin.php" method="POST" enctype="multipart/form-data">
          <input type='hidden' name='update' value='site'>
          <input type='hidden' name='update_site_id' value='<?php echo $site_id;?>'>

          <label for="title">Title:</label>
          <input type="text" name="title" value="<?php echo $site['title']; ?>" required><br>

          <label for="img1_alt">First Image alt Text:</label>
          <input id='textboxid' type="text" name="img1_alt" value="<?php echo $site['img1_altText']; ?>" required><br>
          <label for="img1_cap">First Image Caption:</label>
          <input id='textboxid' type="text" name="img1_cap" value="<?php echo $site['img1_caption']; ?>" required><br>

          <label for="img2_alt">Second Image alt Text:</label>
          <input id='textboxid' type="text" name="img2_alt" value="<?php echo $site['img2_altText']; ?>" required><br>
          <label for="img2_cap">Second Image Caption:</label>
          <input id='textboxid' type="text" name="img2_cap" value="<?php echo $site['img2_caption']; ?>" required><br>

          <input type="submit" name="submit" value="UPDATE">
        </form>
      </td>
    </tr>
   
  </table>
<?php endforeach; 
      break;?>

        <?php
        case "new_tour_stop":
        ?>
  <h1>Add a new Stop:</h1>
  <table>
    <tr>
    <script>
          function previewImage(event, inputId) {
            var reader = new FileReader();
            reader.onload = function() {
              var outputId = "preview_" + inputId;
              var output = document.getElementById(outputId);
              output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
          }
          </script>
        <!--form to upload/update files -->
          
    
    </tr>
   
    <tr>
      <td colspan="2">
        <!--form to post updated to the admin page -->
        <form action="editor.php" method="POST" enctype="multipart/form-data">
          <input type='hidden' name='addNew' value='addIt'>
      
        <div class="image-preview">
          <label for="new_1file">First Image:</label>
          <input type="file" name="new_1file"  accept="image/*" onchange="previewImage(event, 'new_1file')" required><br>
          <img id="preview_new_1file" class="preview_img"  /><br>
        </div>
      
        <div class="image-preview">
          <label for="new_2file">Second Image:</label>
          <input type="file" name="new_2file"  accept="image/*" onchange="previewImage(event, 'new_2file')" required><br>
          <img id="preview_new_2file" class="preview_img"/><br>
        </div>
      
          <label for="title">Title:</label>
          <input type="text" name="new_title"  required><br>

          <label for="new_img1_alt">First Image alt Text:</label>
          <input id='textboxid' type="text" name="new_img1_alt" required><br>
          <label for="new_img1_cap">First Image Caption:</label>
          <input id='textboxid' type="text" name="new_img1_cap" required><br>

          <label for="new_img2_alt">Second Image alt Text:</label>
          <input id='textboxid' type="text" name="new_img2_alt"  required><br>
          <label for="new_img2_cap">Second Image Caption:</label>
          <input id='textboxid' type="text" name="new_img2_cap"  required><br>
          <label for="new_text1">Introduction Text:</label><br>
          <textarea name='new_text1'rows="4" cols="50" required>Please copy and paste Information here. Make sure to go and update this after creating a new site so it renders correctly on the website!
          </textarea><br>
          <label for="new_text2">Read More Text:</label><br>
          <textarea name='new_text2' rows="4" cols="50" required>Please copy and paste Information here. Make sure to go and update this after creating a new site so it renders correctly on the website!
          </textarea><br>
          <input type="submit" name="submit" value="Create!">
        </form>
      </td>
    </tr>
   
  </table>
  
<?php  
          break;

       
    }
  ?>

    </div>
  </body>
</html>


<?php 
// Close database connection

?>