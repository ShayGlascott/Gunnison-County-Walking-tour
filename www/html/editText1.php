<?php
session_start();

if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
  //if usr isnt logged in redirect to login page
  echo "<script>location.href='login.php';</script>";
  exit;
}
$site_id = $_GET['id'];
require('model.php');
$conn = connectDb();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $data = getTourStopById($conn, $site_id);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $site_id = $_POST['site_id'];
  $text2 = $_POST['ut1'];
  $query = "UPDATE historic_sites SET text1 = :text2 WHERE id = :site_id";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':text2', $text2);
  $stmt->bindParam(':site_id', $site_id);
  if ($stmt->execute()) {
    echo "success";
    echo "<script>location.href='editor.php?function=edit_site_page&site_id=" . $site_id . "';</script>";

  } else {
    echo "<script>alert('Database error, please try again in a moment.');</script>";
  }

}

foreach ($data as $data):
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
?>