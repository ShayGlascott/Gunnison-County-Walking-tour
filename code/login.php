<?php 
session_start();

$servername = 'localhost';
$username = 'student';
$password = 'CS350';
$dbname = 'tour_db';
$_SESSION['isVerified'] = -1;


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $passwd = $_POST['password'];
  
  $sql = "SELECT * FROM users WHERE uName = '$username'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
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

</head>
<body>
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
