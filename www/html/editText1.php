<?php
require('model.php');

session_start();

if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
  //if usr isnt logged in redirect to login page
  echo "<script>location.href='login.php';</script>";
  exit;
}
$site_id = $_GET['id'];

$conn = connectDb();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $data = getTourStopById($conn, $site_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $site_id = $_POST['site_id'];
  $text2 = $_POST['ut1'];
  editText1($conn,$text2,$site_id);
  
}

foreach ($data as $data) :
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
            <textarea id="myTextarea" name="ut1">' . $data['text1'] . '</textarea>
            <input type="hidden" name="site_id" value=' . $data['id'] . '>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>';
endforeach;
