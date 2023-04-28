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
  <!-- Add your content here -->
  <div class=main-info>

    <h1>About Us</h1>
    <img src = 'pictures/ericSavage.jpg' style="height:25%; width:25%;">
    <h3> Eric Savage </h3>
    <p>My Name is Eric Savage. I graduated from Western Colorado University in 2023. I got my degree in History and Anthropology. 
      I created the content for the buildings on this website. I took some of the photos as well as 
      compiled the older photos found on here as well. Gunnison has a rich history full of very interesting 
      stories going back over a century compiling this was a great experience I learned a lot more about the history of 
      Gunnison than I thought was possible.</p>
    <br>
    <img src = 'pictures/heather.jpg' style="height:25%; width:25%;">
    <h3> Dr. Heather Thiessen-Reily </h3>
    <p>
    Dr. Heather Thiessen-Reily, Chair of the Department of Behavioral 
    and Social Sciences and a respected professor of History at Western State Colorado University,
     has a passion for providing her students with practical, real-world projects. As part of this commitment, 
     she led a team of students in creating a website for the Gunnison Historical Walking Tour. Bringing the 
     project to the students and collaborating with Eric Savage on the content, Dr. Thiessen-Reily's guidance 
     and mentorship helped the team successfully complete the project. Her dedication to creating impactful learning 
     experiences has made her a highly regarded member of the academic community at Western State Colorado University.
    </p>

  </div>
  <br>  
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