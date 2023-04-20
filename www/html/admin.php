<?php
//verify that the session is active and login was successful
session_start();

if (!isset($_SESSION['isVerified']) || $_SESSION['isVerified'] != 1) {
  //if usr isnt logged in redirect to login page
  echo "<script>location.href='login.php';</script>";
  exit;
}

?>

<html>

<head>
  <link rel="stylesheet" href="editorStyling.css">
  <title>Gunnion Historic Walking Tour</title>
</head>
<a href='index.php'>HOME</a>
<a href='admin.php'>ADMIN</a>
<a href='logout.php'>LOGOUT</a>
<?php

require('model.php');
$conn = connectDb();
$sites = getSites($conn);
$data = getAllUsers($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  //sql connection to get users that are not admin

}

?>

<body>
  <h1>Gunnison Walking Tour Administration Page</h1>
  <?php
  if ($_SESSION['id'] == 0) {
    ?>
    <div class="box">
      <div class="title">Add User</div>
      <table>
        <tr>
          <form method="post">
            <td>
              <label for="Username">Username:</label>
            </td>
            <td>
              <input type='text' name="username" required>
            </td>
        </tr>
        <tr>
          <td>
            <label for="password1">Password:</label>
          </td>
          <td>
            <input type='password' name='password1' required>
          </td>
        </tr>
        <tr>
          <td>
            <label for="password2">Re-enter Password:</label>
          </td>
          <td>
            <input type='password' name='password2' reqired><br>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="Add User">
            <input type="hidden" value="add_user" name='update'>
            </form>
          </td>

        </tr>
      </table>

    </div>
    <div class="box">
      <div class="title">Edit Users</div>
      <table>
        <tr>
          <th>User</th>
          <th>Delete</th>
        </tr>
        <?php
        foreach ($data as $user): ?>
          <tr>
            <td>
              <?php echo $user['uName']; ?>
            </td>
            <!-- Button to delete user -->
            <td>
              <form action="admin.php" method="POST">
                <input type='hidden' name='update' value='delete_user'>
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                <input type="submit" value="Delete">
              </form>
            </td>
          </tr>

          <?php
        endforeach;
        ?>

      </table>
    </div>
    <?php
  }
  ?>

  <!-- Button to edit main page -->
  <button onclick="window.location.href ='edit_home_page.php'">Edit Home Page</button>


  <!-- List of tour stops -->
  <div class="box">
    <div class="title">Tour Stops</div>
    <table>
      <tr>
        <th>Site Name</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

      <?php foreach ($sites as $site):
        $site_id = $site['id'];
        $name = $site['title'];
        ?>

        <tr>
          <td>
            <?php echo $name; ?>
          </td>
          <!-- Button to edit stop -->
          <td>
            <form action="editor.php" method="GET">
              <input type="hidden" name="function" value="edit_site_page">
              <input type="hidden" name="site_id" value="<?php echo $site_id; ?>">
              <input type="submit" value="Edit">
            </form>
          </td>
          <!-- Button to delete stop -->
          <td>
            <form action="editor.php" method="GET">
              <input type="hidden" name="function" value="delete_stop">
              <input type="hidden" name="site_id" value="<?php echo $site_id; ?>">
              <input type="submit" value="Delete">
            </form>
          </td>
        </tr>

        <?php
      endforeach;
      ?>

    </table>

    <!-- Button to create a new stop -->
    <form action="editor.php" method="GET">
      <input type="hidden" name="function" value="new_tour_stop">
      <input type="submit" value="New Tour Stop">
    </form>

  </div>
</body>

</html>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $update = $_POST['update'];

  update($conn, $update);

  // Confirmation before delete:  Type the full name of the site exactly as it appears in the database.

  // Delete row with id matching $site_id
  //$sql = "DELETE * FROM historic_sites WHERE id=$site_id";
  //$result = $conn->query("DELETE * FROM historic_sites WHERE id=$site_id");


}
?>