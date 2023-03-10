<?php

/*
CREATE TABLE IF NOT EXISTS tour_sites (
  id INT NOT NULL AUTO_INCREMENT,
  img1_fname TEXT NOT NULL,
  img1_altText TEXT NOT NULL,
  img1_caption TEXT NOT NULL,
  img2_fname TEXT NOT NULL,
  img2_altText TEXT NOT NULL,
  img2_caption TEXT NOT NULL,
  title TEXT NOT NULL,
  text1 TEXT NOT NULL,
  text2 TEXT NOT NULL,
  PRIMARY KEY (id)
);
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $siteName = str_replace(' ', '', strtolower($name));
    
    $img1Name = $_FILES["img1"]["name"];
    $img2Name = $_FILES["img2"]["name"];
    $img1Path = "pictures/$siteName$img1Name";
    $img2Path = "pictures/$siteName$img2Name";
    $img1Alt = $_POST["img1Alt"];
    $img2Alt = $_POST["img2Alt"];
    $img1Caption = $_POST["img1Caption"];
    $img2Caption = $_POST["img2Caption"];
    $text1 = $_POST["text1"];
    $text2 = $_POST["text2"];
    
    if (move_uploaded_file($_FILES["img1"]["tmp_name"], $img1Path) && 
        move_uploaded_file($_FILES["img2"]["tmp_name"], $img2Path)) {
        
        // Connect to database
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "gwt_data";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Insert data into database
        $sql = "INSERT INTO tour_sites (img1_fname, img1_altText, img1_caption, img2_fname, img2_altText, img2_caption, title, text1, text2)
                VALUES ('$img1Path', '$img1Alt', '$img1Caption', '$img2Path', '$img2Alt', '$img2Caption', '$name', '$text1', '$text2')";
        if ($conn->query($sql) === TRUE) {
            echo "Site created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    } else {
        echo "Error uploading images";
    }
}
?>
<!-- 
    On click, the listener gets coordinates of that click on the image of the map
-->
<div class="box">
      <div class="title">Map Icons</div>
      <img src="map.jpg" class="map" id="image" />
      <form id="myForm">
        <label for="x">X:</label>
        <input type="text" id="x" name="x"><br><br>
        <label for="y">Y:</label>
        <input type="text" id="y" name="y"><br><br>
        <input type="submit" value="Submit">
      </form>
      <script>
        const image = document.getElementById("image");
        const form = document.getElementById("myForm");
        image.addEventListener("click", function(event) {
          const x = event.clientX - image.offsetLeft;
          const y = event.clientY - image.offsetTop;
          console.log(`Clicked at (${x}, ${y})`);
          form.elements["x"].value = x;
          form.elements["y"].value = y;
        });
      </script>
    </div>
 <form method="post" enctype="multipart/form-data">
    <label for="name">Title:</label>
    <input type="text" name="name" required><br>
    
    <label for="img1">Image 1:</label>
    <input type="file" name="img1" required><br>
    <label for="img1Alt">Image 1 Alt Text:</label>
    <input type="text" name="img1Alt" required><br>
    <label for="img1Caption">Image 1 Caption:</label>
    <input type="text" name="img1Caption" required><br>
    
    <label for="img2">Image 2:</label>
    <input type="file" name="img2" required><br>
    <label for="img2Alt">Image 2 Alt Text:</label>
    <input type="text" name="img2Alt" required><br>
    <label for="img2Caption">Image 2 Caption:</label>
    <input type="text" name="img2Caption" required><br>
    
    <label for="text1">Text 1:</label>
    <textarea name="text1" id="text1" required></textarea><br>
    <label for="text2">Text 2:</label>
    <textarea name="text2" id="text2" required></textarea><br>

    <input type="submit" value="Create Site">
</form>


<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
    height: 300
  });
</script>