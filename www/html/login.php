<?php 
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if($_SESSION['isVerified'] == 1){
    //if usr isnt logged in redirect to login page
    echo "<script>location.href='admin.php';</script>";
  }
}
$host = 'mysql';
$db_name = 'tourdb';
$username = 'user';
$password = 'password';

try {
  $conn = new PDO('mysql:host='.$host.';port=3306;dbname='.$db_name, $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}
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

</head>
<body>
  <a href='index.php'>Home</a>
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
