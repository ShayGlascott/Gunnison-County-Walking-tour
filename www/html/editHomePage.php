<?php
session_start();

if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
  //if usr isnt logged in redirect to login page
  echo "<script>location.href='login.php';</script>";
  exit;
}

require('model.php');
$conn = connectDb();
$data = getHomeData($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_FILES['file'])) {

    //change to save to pictures
    $uploadDir = 'mapMaterials/';
    $fileName_1 = $_FILES['file']['name'];
    $filePath_1 = $uploadDir . $fileName_1;
    echo $filePath_1;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath_1)) {
      $query = "UPDATE home SET map_fname = '$filePath_1'";
      if ($s = $conn->prepare($query)) {
        echo "<script>alert('The map was updated Successfully!');</script>;";
        $s->execute();
      } else {
        echo "<script>alert('Error uploading map!');</script>;";

      }

    }
  }
  if (
    isset($_POST['intro_heading_text']) ||
    isset($_POST['intro_text']) ||
    isset($_POST['how_to_text']) ||
    isset($_POST['address']) ||
    isset($_POST['city_state_zip']) ||
    isset($_POST['phone_number']) ||
    isset($_POST['email'])
  ) {
    $intro_heading_text = $_POST['intro_heading_text'];
    $intro_text = $_POST['intro_text'];
    $how_to_text = $_POST['how_to_text'];
    $address = $_POST['address'];
    $city_state_zip = $_POST['city_state_zip'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    echo "3";


    $query = "UPDATE home SET `intro_heading_text` = :intro_heading_text, 
        `intro_text` = :intro_text, 
        `how_to_text` = :how_to_text,
        `address` = :address, 
        `city_state_zip` = :city_state_zip, 
        `phone_number` = :phone_number, 
        `email` = :email";

    echo "3.5";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":intro_heading_text", $intro_heading_text);
    $stmt->bindParam(":intro_text", $intro_text);
    $stmt->bindParam(":how_to_text", $how_to_text);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":city_state_zip", $city_state_zip);
    $stmt->bindParam(":phone_number", $phone_number);
    $stmt->bindParam(":email", $email);
    echo "4";
    if ($stmt->execute()) {
      echo "<script>alert('Updated Successfully!');</script>;";
    } else {
      echo "<script>alert('Error Updating, try again.');</script>;";

    }
  }
  echo "<script>location.href='editHomePage.php';</script>";


}
?>

<html>

<head>
  <link rel="stylesheet" href="editorStyling.css">
  <title>Gunnion Historic Walking Tour</title>
</head>

<body>
  <header id="navbar">
    <nav class="navbar-container container">
      <a class="home-link">
        <div class="navbar-logo">
          <img src="pictures/cityOfGunniLogo.png" alt='navLogo' weight="70px" height="70px" />
        </div>
        Gunnison Walking Tour
      </a>
      <button type="button" id="navbar-toggle" aria-controls="navbar-menu" aria-label="Toggle menu"
        aria-expanded="false">
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
  <script src="index.js"></script>
  <div class="box">
    <?php foreach ($data as $data): ?>

      <h2>Edit Map Photo:</h2><br>
      <form method="POST" enctype="multipart/form-data">

        <div class="image-preview">
          <label for="file">Map:</label>
          <input type="file" name="file" accept="image/*" onchange="previewImage(event, 'file')"><br>
          <img id="preview_file" class="preview_img" src="<?php echo $data['map_fname']; ?>" /><br>
        </div>


        <script>
          function previewImage(event, inputId) {
            var reader = new FileReader();
            reader.onload = function () {
              var outputId = "preview_" + inputId;
              var output = document.getElementById(outputId);
              output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
          }
        </script>
        <input type="submit" name="submit" value="Add Images">
      </form>
      <h2>Edit the home page:</h2>
      <form method='post'>
        <label for='intro_heading_text'>Edit Intro Heading:</label>
        <input type='text' name='intro_heading_text' value='<?php echo $data['intro_heading_text']; ?>' required><br>
        <label for='intro_text'>Edit Intro Text</label><br>
        <textarea name='intro_text' style='height: 100px; width: 600px'
          required><?php echo $data['intro_text']; ?></textarea><br>
        <label for='how_to_text'>Edit How to Text</label><br>
        <textarea name='how_to_text' style='height: 100px; width: 600px'
          required><?php echo $data['how_to_text']; ?></textarea><br>
        <label for='address'>Address:</label>
        <input type='text' name='address' value='<?php echo $data['address']; ?>' required><br>
        <label for='city_state_zip'>City State,Zip:</label>
        <input type='text' name='city_state_zip' value='<?php echo $data['city_state_zip']; ?>' required><br>
        <label for='phone_number'>Phone Number:</label>
        <input type='text' name='phone_number' value='<?php echo $data['phone_number']; ?>' required><br>
        <label for='email'>Email:</label>
        <input type='text' name='email' value='<?php echo $data['email']; ?>' required><br>
        <input type='submit' value='Update!'>
      </form>
    <?php endforeach; ?>
  </div>
</body>

</html>