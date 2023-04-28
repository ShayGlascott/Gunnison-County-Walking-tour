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
    <img src = 'pictures/wcu.png' style="height:25%; width:25%;">
    <h3>Development Team</h3>
    <p>Zachary Campbell, Ben Klingbeil, and Shay Glascott are a team of web developers 
      who created a comprehensive website to facilitate access to information about the 
      town of Gunnison, Colorado for both its residents and visitors. All members of the 
      team are students at Western, with Zachary due to graduate in May and Shay and Ben 
      set to become seniors. The team's primary objective was to bridge 
      the gap between the Computer Science (CS) and History departments at Western Colorado University by providing a 
      platform that would offer easy access to the town's history. The team worked collaboratively throughout the design and development stages, with each member 
      contributing their unique skills and expertise to the project. The website the team created is user-friendly and accessible, featuring a clean 
        and modern design with easy navigation, and a responsive layout for mobile devices.</p><br>
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
    <br>
    <h3>Gunnison Historic Preservation Commission </h3>
    <p>
    If you're interested in exploring Gunnison's rich history and learning more about the town's heritage, we invite you to 
    visit the Gunnison Historic Preservation Committee website. Click the link below to be redirected to their website, where 
    you'll find a wealth of information about local landmarks, historic buildings, and cultural events. Whether you're a resident 
    or a visitor, the GHPC website is a great resource for anyone who wants to discover the stories that make Gunnison such a special 
    place. So don't wait, click the link now and start your journey into the past!
    
  </p>
    <a href="https://www.gunnisoncounty.org/193/Historic-Preservation-Commission"> Visit GHPC </a>

  </div>
  <br>  
  <?php foreach ($data1 as $data1): ?>
  <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-4">

              <img src="pictures/logo.png" alt="Logo" style = "height:200px; width:200px;"><br><br>
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