<?php 
    session_start();

    if(!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1){
        //if usr isnt logged in redirect to login page
        echo "<script>location.href='login.php';</script>";
        exit;
    }
    $site_id = $_GET['id'];
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

    $t1q = "SELECT * FROM `historic_sites` WHERE id = " . $site_id;
    $stmt = $conn->prepare($t1q);
    $stmt->execute();
    $data= $stmt->fetchAll();

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
            <textarea id="myTextarea" name="ut1">'.$data['text1']. '</textarea>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>';
?>


