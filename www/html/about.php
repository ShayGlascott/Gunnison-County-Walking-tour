<!DOCTYPE html>
<html lang="en">

<head>
  <title> Gunnison Historic Walking Tour </title>
  <link rel="stylesheet" href="indexStyling.css">
  <link rel="stylesheet" href="navbarStyling.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <?php
  require('model.php');
  createNavbar(); 
  $conn = connectDb();
  $data1 = getHomeData($conn);
  ?>
  <br><br><br><br>
  <script src="index.js"></script>
  <!-- Add your content here -->
  <div class=main-info>

    <h1>About Us</h1>
    <img src = 'pictures/ericSavage.jpg' style="height:400px; width:275px;">
    <h3> Eric Savage </h3>
    <p>My Name is Eric Savage. I graduated from Western Colorado University in 2023. I got my degree in History and Anthropology. 
      I created the content for the buildings on this website. I took some of the photos as well as 
      compiled the old er photos found on here as well. Gunnison has a rich history full of very interesting 
      stories going back over a century compiling this was a great experience I learned a lot more about the history of 
      Gunnison than I thought was possible.</p>
    

  </div>
  <?php foreach ($data1 as $data1): ?>
  <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-4">

              <img src="pictures/logo.png" alt="Logo" style = "height:200px; weight:200px;"><br><br>
              <a href="about.php">About Us</a><br><br>
              <ul>
                <li>
                  <?php echo $data1['address']; ?>
                </li>
                <li>
                  <?php echo $data1['city_state_zip']; ?>
                </li>
                <li>Phone:
                  <?php echo $data1['phone_number']; ?>
                </li>
                <li>Email:
                  <?php echo $data1['email']; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </footer>




</html>