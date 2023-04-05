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

    <link rel="stylesheet" href="editorStyling.css">
    <script src="tinymce/js/tinymce" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
          selector: 'textarea#basic-conf',
          a_plugin_option: true,
          a_configuration_option: 400,
          width: 600,
          height: 500,
          plugins: [
      'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
      'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
      'media', 'table', 'emoticons', 'template', 'help'
    ],
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
      'forecolor backcolor emoticons | help',
          menu: {
            file: { title: 'File', items: 'newdocument restoredraft | preview | export print | deleteallconversations' },
            edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
            view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
            insert: { title: 'Insert', items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
            tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
            table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable' },
            help: { title: 'Help', items: 'help' }
  }
  /* content_css: 'css/content.css' */

        });
    </script>

    <title>Gunnion Historic Walking Tour</title>
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
  
 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $site_id = $_POST['site_id'];
  $operation = $_POST['function'];

  $result = $conn->query("SELECT * FROM historic_sites WHERE id=".$site_id);
    
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
        'title' => $row['title'],
        'text1' => $row['text1'],
        'text2' => $row['text2']
      );
      array_push($sites, $site);
    }
  }

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
  

?>

  
    <div class="box">
      
    <?php 
    switch ($operation) {
      case "edit_main_page":
        ?>

        <?php
          break;
      case "edit_site_page":
        ?>
        <html>

        
        
        <?php foreach($sites as $site): ?>
        <h1>Edit site information for <?php echo $site['title']; ?></h1>
        <!--form to upload/update files -->
        <form action='editor.php' method="POST" enctype="multipart/form-data" >
        <div class="image-preview">

          <label for="1file">First Image:</label>
          <input type="file" name="1file" accept="image/*" onchange="previewImage(event, '1file')" required><br>
          <img id="preview_1file" class="preview_img" /><br>

        </div>
        <div class="image-preview">
          <label for="2file">Second Image:</label>
          <input type="file" name="2file" accept="image/*" onchange="previewImage(event, '2file')"><br>
          <img id="preview_2file" class="preview_img" /><br>
        </div>
          <input type='hidden' name='site_id' value="<?php echo $site_id; ?>">
          <input type="hidden" name="function" value="edit_site_page">
          <input type="submit" name="submit" value="Add Images">
        </form>
        
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
        <!--form to post updated to the admin page -->

        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <input type='hidden' name='update' value='site'>
            <input type='hidden' name='update_site_id' value='<?php echo $site['id'];?>'>

            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo $site['title']; ?>" required><br>

            <label for="img1_alt">First Image alt Text:</label>
            <input type="text" name="img1_alt" value="<?php echo $site['img1_altText']; ?>" required><br>
            <label for="img1_cap">First Image Caption:</label>
            <input type="text" name="img1_cap" value="<?php echo $site['img1_caption']; ?>" required><br>
            
            <label for="img2_alt">Second Image alt Text:</label>
            <input type="text" name="img2_alt" value="<?php echo $site['img2_altText']; ?>" required><br>
            <label for="img2_cap">Second Image Caption:</label>
            <input type="text" name="img2_cap" value="<?php echo $site['img2_caption']; ?>" required><br>
            
            <textarea id="basic-conf">hello</textarea>

            <label for="text2">Read More:</label>
            <input type="text" name="text2" value="<?php echo $site['text2']; ?>" required><br>

            <input type="submit" name="submit" value="UPDATE">
            
        </form>
        <?php endforeach; 
          break;?>
        
        <?php
        case "new_tour_stop":
        ?>
        
        
        <h1>Add a new site:</h1>


        <form action='admin.php' method="POST">
            <input type='hidden' name='update' value='new'>

            <label for="title">Title:</label>
            <input type="text" name="title"  required><br>

            <label for="img1_name">First Image:</label>
            <input type="file" name="img1" required><br>
            <label for="img1_alt">First Image alt Text:</label>
            <input type="text" name="img1_alt" required><br>
            <label for="img1_cap">First Image Caption:</label>
            <input type="text" name="img1_cap"required><br>
            
            <label for="img2_name">Second Image:</label>
            <input type="file" name="img2" required><br>
            <label for="img2_alt">Second Image alt Text:</label>
            <input type="text" name="img2_alt" required><br>
            <label for="img2_cap">Second Image Caption:</label>
            <input type="text" name="img2_cap" required><br>
            
            <label for="text1">Introduction Text:</label>
            <input type="text" name="text1" required><br>

            <label for="text2">Read More:</label>
            <input type="text" name="text2" required><br>

            <input type="submit" name="submit" value="ADD NEW">
            
        </form>

        <?php
          break;

       
    }
  }?>

    </div>
  </body>
</html>


<?php 
// Close database connection

?>
