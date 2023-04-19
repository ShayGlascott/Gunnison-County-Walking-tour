<?php
session_start();

if(!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1){
    //if usr isnt logged in redirect to login page
    echo "<script>location.href='login.php';</script>";
    exit;
}

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

$t1q = "SELECT * FROM home";
$stmt1 = $conn->prepare($t1q);
$stmt1->execute();
$data= $stmt1->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_FILES['file'])) {
        $uploadDir = 'mapMaterials/';
        $fileName_1 = $_FILES['file']['name'];
        $filePath_1 = $uploadDir . $fileName_1;
        
    
          if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath_1)) {
            $map_fname = $fileName_1;
        } else {
              echo "<script>alert('The map had an error while being updated. Please try again');</script>;";
    
          }
    }
    if (isset($_POST['intro_heading_text']) && 
    isset($_POST['intro_text']) && 
    isset($_POST['how_to_text']) && 
    isset($_POST['address']) && 
    isset($_POST['city_state_zip']) && 
    isset($_POST['phone_number']) && 
    isset($_POST['email'])) {
        $intro_heading_text = $_POST['intro_heading_text'];
        $intro_text = $_POST['intro_text'];
        $how_to_text = $_POST['how_to_text'];
        $address = $_POST['address'];
        $city_state_zip = $_POST['city_state_zip'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];

        $query = "UPDATE home SET `intro_heading_text` = :intro_heading_text, 
        `intro_text` = :intro_text, 
        `how_to_text` = :how_to_text,
        `map_fname` = :map_fname, 
        `address` = :address, 
        `city_state_zip` = :city_state_zip, 
        `phone_number` = :phone_number, 
        `email` = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":intro_heading_text",$intro_heading_text);
        $stmt->bindParam(":intro_text",$intro_text);
        $stmt->bindParam(":how_to_text",$how_to_text);
        $stmt->bindParam(":map_fname",$map_fname);
        $stmt->bindParam(":address",$address);
        $stmt->bindParam(":city_state_zip",$city_state_zip);
        $stmt->bindParam(":phone_number",$phone_number);
        $stmt->bindParam(":email",$email);
        if($stmt->execute()){
            echo "<script>alert('Updated Successfully!');</script>;";

        }else{
            echo "<script>alert('Error Updating, try again.');</script>;";

        }
    }
    echo "<script>location.href='admin.php';</script>";

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
    <div class="box">
    <?php foreach($data as $data): ?>

        <h2>Edit Map Photo:</h2><br>
        <form method="POST" enctype="multipart/form-data" >
        <div class="image-preview">
          <label for="file">Map:</label>
          <input type="file" name="file"  accept="image/*" onchange="previewImage(event, 'file')"><br>
          <img id="preview_file" class="preview_img" src="<?php echo $data['map_fname']; ?>" /><br>
        </div>
     
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
          <input type="submit" name="submit" value="Add Images">
        </form>
        <h2>Edit the home page:</h2>
        <form method='post'>
            <label for='intro_heading_text'>Edit Intro Heading:</label>
            <input type='text' name='intro_heading_text' value='<?php echo $data['intro_heading_text'];?>'required><br>
            <label for='intro_text'>Edit Intro Text</label><br>
            <textarea name='intro_text' style='height: 100px; width: 600px' required><?php echo $data['intro_text'];?></textarea><br>
            <label for='how_to_text'>Edit How to Text</label><br>
            <textarea name='how_to_text' style='height: 100px; width: 600px' required><?php echo $data['how_to_text'];?></textarea><br>
            <label for='address'>Address:</label>
            <input type='text' name='address' value='<?php echo $data['address'];?>' required><br>
            <label for='city_state_zip'>City State,Zip:</label>
            <input type='text' name='city_state_zip' value='<?php echo $data['city_state_zip'];?>' required><br>
            <label for='phone_number'>Phone Number:</label>
            <input type='text' name='phone_number' value='<?php echo $data['phone_number'];?>' required><br>
            <label for='email'>Email:</label>
            <input type='text' name='email' value='<?php echo $data['email'];?>' required><br>
            <input type='submit' value='Update!'>
        </form>
        <?php endforeach; ?>
    </div>
    </body>

</html>