<?php
session_start();

if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
    //if usr isnt logged in redirect to login page
    echo "<script>location.href='login.php';</script>";
    exit;
}

require('model.php');
$conn = connectDb();
$data = getSlideshowPics($conn);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['update'] == 'delete_img') {
        $dID = $_GET['img_id'];
        deleteSlide($conn, $dID);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['file'])) {
        $oldCap = $_POST['oldCap'];
        //change to save to pictures
        $uploadDir = 'pictures/';
        $fileName_1 = $_FILES['file']['name'];
        $filePath_1 = $uploadDir . $fileName_1;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath_1)) {
            $query = "INSERT INTO`slideShowImages` (`oldImage_fname`, `oldImage_caption`) VALUES (:oldImage_fname,:oldImage_caption)";
            $s = $conn->prepare($query);
            $s->bindParam(":oldImage_fname", $fileName_1);
            $s->bindParam(":oldImage_caption", $oldCap);
            if ($s->execute()) {
                echo "<script>alert('Added photo Successfully!');</script>;";
            } else {
                echo "<script>alert('Error uploading photo!');</script>;";
            }
        }
        echo "<script>location.href='admin.php';</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Gunnison Historic Walking Tour </title>
    <!-- code to move to element after link click -->
    <link rel="stylesheet" href="editorStyling.css">
    <link rel="stylesheet" href="navbarStyling.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <header id="navbar">
        <nav class="navbar-container container">
            <a class="home-link">
                <div class="navbar-logo">
                    <img src="pictures/logo_white.png" alt="navLogo" weight="70px" height="70px" />
                </div>
                <p> Historic Walking Tour</p>
            </a>
            <button type="button" id="navbar-toggle" aria-controls="navbar-menu" aria-label="Toggle menu" aria-expanded="false">
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

    <script src="index.js"></script>
    <br><br><br><br>
    <div class="box">
        <?php //foreach ($data as $data): 
        ?>
          <button onclick="window.location.href ='admin.php'">Back</button>

        <h2>Add Slide Photo:</h2><br>
        <form method="POST" enctype="multipart/form-data">

            <div class="image-preview">
                <label for="file">Map:</label>
                <input type="file" name="file" accept="image/*" onchange="previewImage(event, 'file')" required><br>
                <img id="preview_file" class="preview_img" /><br>
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
            <label for='oldCap'>Caption:</label>
            <input type='text' name="oldCap" required><br>
            <input type="submit" name="submit" value="Add Image">
        </form>
        <table>

            <tr>
                <th>User</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($data as $row) : ?>
                <tr>
                    <td>
                        <?php echo $row['oldImage_fname']; ?>
                    </td>

                    <td>
                        <form action="addSlide.php" method="get">
                            <input type='hidden' name='update' value='delete_img'>
                            <input type="hidden" name="img_id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>