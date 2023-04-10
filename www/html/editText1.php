<?php 
    session_start();

    if(!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1){
        //if usr isnt logged in redirect to login page
        echo "<script>location.href='login.php';</script>";
        exit;
    }
    $servername = 'localhost';
    $username = 'student';
    $password = 'CS350';
    $dbname = 'tour_db';

    $site_id = $_SESSION['sID'];

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM historic_sites WHERE id=".$_SESSION['sID']);
    
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

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text1 = $_POST['ut1'];
    $query = "UPDATE historic_sites SET text1 = '$text1' WHERE id = $site_id";
      if ($conn->query($query)) {
        echo "<script>alert('The Introduction Text for ".$sites['title'] . "was updated Successfully!');</script>;";

     } else {
      echo "<script>alert('Database error, please try again in a moment.');</script>;";
    } 
    echo "<script>location.href='editor.php';</script>";

}

echo '<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
  <script
    type="text/javascript"
    src=\'tinymce/tinymce.min.js\'
    referrerpolicy="origin">
  </script>
  <script type="text/javascript">
  tinymce.init({
    selector: \'#myTextarea\',
    plugins: [
      \'advlist\', \'autolink\', \'link\', \'image\', \'lists\', \'charmap\', \'preview\', \'anchor\', \'pagebreak\',
      \'searchreplace\', \'wordcount\', \'visualblocks\', \'visualchars\', \'code\', \'fullscreen\', \'insertdatetime\',
      \'media\', \'table\', \'emoticons\', \'template\', \'help\'
    ],
    toolbar: \'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | \' +
      \'bullist numlist outdent indent | link image | print preview media fullscreen | \' +
      \'forecolor backcolor emoticons | help\',
    menu: {
      favs: { title: \'My Favorites\', items: \'code visualaid | searchreplace | emoticons\' }
    },
    menubar: \'favs file edit view insert format tools table help\',
    content_css: \'css/content.css\'
  });
  </script>
</head>

<body>
    <h2>Edit Introduction Text</h2>

    <div class="box" style=\'position: absolute; top: 2;\'>
        <form action="editText1.php" method="post">
            <textarea id="myTextarea" name="ut1">'.$site['text1']. '</textarea>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>';


?>


