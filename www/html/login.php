<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if ($_SESSION['isVerified'] == 1) {
    //if usr isnt logged in redirect to login page
    echo "<script>location.href='admin.php';</script>";
  }
}
require('model.php');
$conn = connectDb();
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $passwd = $_POST['password'];

  $sql = "SELECT * FROM users WHERE uName = :username";
  $statement = $conn->prepare($sql);
  $statement->execute(['username' => $username]);
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $hashed_password = $row['passwd'];

    if (password_verify($passwd, $hashed_password)) {
      // Username and password match
      $id = $row['id'];
      session_regenerate_id();
      $_SESSION['isVerified'] = 1;
      $_SESSION['name'] = $username;
      $_SESSION['id'] = $id;
      echo "<script>location.href='admin.php';</script>";
    } else {
      // Password does not match
      echo "Invalid password.";
    }
  } else {
    // Username not found
    echo "Invalid username.";
  }
}

?>

<html>

<head>
  <link rel="stylesheet" href="editorStyling.css">
</head>

<body>
  <header id="navbar">
    <nav class="navbar-container container">
      <a class="home-link">
        <div class="navbar-logo">
          <img src="pictures/cityOfGunniLogo.png" alt='navLogo' weight="70px" height="70px" />
        </div>
        Gunnison Walking Tour
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
          <li class="navbar-item"><a class="navbar-link" href="login.php">Login</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <br><br><br><br>
  <script src="index.js"></script>
  <h1>Login</h1>

  <form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Login">
  </form>
</body>

</html>