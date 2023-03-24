<?php 
$servername = 'localhost';
$username = 'student';
$password = 'CS350';
$dbname = 'tour_db';


$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error){
  die("Connection failed: ".$conn->connect_error);
}


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      // Username and password match
      echo "Login successful!";
    } else {
      // Username and password do not match
      echo "Invalid username or password.";
    }
  }

?>


<html>
    <head> 

    </head>
    <body>
    <form method="POST">
        <label for="username">UserName:</label>
        <label for="n">UserName:</label>
        <input type="text" name="username" required>
        <input type="password" name="password" required>
        <input type="submit" name="submit" value="Login">
    </form>
    </body>
</html>

