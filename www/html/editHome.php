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
          <li class="navbar-item"><a class="navbar-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <script src="index.js"></script>
  <br><br><br><br>
  <div class="box">
    <?php //foreach ($data as $data): ?>

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
    <?php //endforeach; ?>
  </div>
</body>
