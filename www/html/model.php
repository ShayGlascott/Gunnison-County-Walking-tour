<?php
function connectDb()
{
    $host = 'mysql';
    $db_name = 'tourdb';
    $username = 'user';
    $password = 'password';

    try {
        $conn = new PDO('mysql:host=mysql;port=3306;dbname=tourdb', 'root', 'secret');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
    return $conn;
}

function getSites($conn)
{
    $sites = array();
    $stmt = $conn->prepare("SELECT * FROM historic_sites");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $site = array(
            'id' => $row['id'],
            'img1_fname' => $row['img1_fname'],
            'img1_altText' => $row['img1_altText'],
            'img1_caption' => $row['img1_caption'],
            'img2_fname' => $row['img2_fname'],
            'img2_altText' => $row['img2_altText'],
            'img2_caption' => $row['img2_caption'],
            'title' => $row['title'],
            'text1' => $row['text1'],
            'text2' => $row['text2'],
        );
        array_push($sites, $site);
    }
    return $sites;


}

function getHomeData($conn)
{
    $t1q = "SELECT * FROM home";
    $stmt1 = $conn->prepare($t1q);
    $stmt1->execute();
    $data = $stmt1->fetchAll();
    return $data;
}

function getAllTourData($conn)
{
    $t1q = "SELECT * FROM `historic_sites`";
    $stmt = $conn->prepare($t1q);
    $stmt->execute();
    $data = $stmt->fetchAll();
    return $data;
}

function getTourStopById($conn, $getId)
{

    $t1q = "SELECT * FROM `historic_sites` WHERE id = " . $getId;
    $statement = $conn->prepare($t1q);
    $statement->execute();
    $data = $statement->fetchAll();
    return $data;
}

function getAllUsers($conn)
{
    $t1q = "SELECT * FROM users WHERE id > 0";
    $stmt1 = $conn->prepare($t1q);
    $stmt1->execute();
    $data = $stmt1->fetchAll();
    return $data;
}

function getSlideshowPics($conn)
{
    $t1q = "SELECT * FROM slideShowImages";
    $stmt1 = $conn->prepare($t1q);
    $stmt1->execute();
    $slideShowPics = $stmt1->fetchAll();
    return $slideShowPics;
}

function update($conn, $update)
{
    switch ($update) {
        case "site":
            $update_id = $_POST['update_site_id'];
            $img1_altText = $_POST['img1_alt'];
            $img1_caption = $_POST['img1_cap'];

            $img2_altText = $_POST['img2_alt'];
            $img2_caption = $_POST['img2_cap'];

            $title = $_POST['title'];


            $stmt2 = $conn->prepare("UPDATE historic_sites
            SET 
                img1_altText = ?,
                img1_caption = ?,
                img2_altText = ?,
                img2_caption = ?,
                title = ?
                WHERE id= 
            " . $update_id);

            $stmt2->execute([$img1_altText, $img1_caption, $img2_altText, $img2_caption, $title]);


            echo "<script>alert('Updated Successfully!');</script>;";


            break;
        case "add_user":
            $username = $_POST['username'];
            $sql = "SELECT * FROM users WHERE uName = '$username'";

            // Execute the SELECT statement
            $result = $conn->query($sql);

            // Check if the username already exists
            if ($result->num_rows > 0) {
                echo "Username already exists";
            } else {
                $password1 = $_POST['password1'];
                $password2 = $_POST['password2'];
                if ($password1 === $password2) {
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users(`uName`, `passwd`) VALUES (:uName, :passwd)";

                    // Prepare the query
                    $stmt = $conn->prepare($sql);

                    // Bind the parameters
                    $stmt->bindParam(':uName', $username);
                    $stmt->bindParam(':passwd', $password);

                    // Execute the query and insert the data into the database
                    if ($stmt->execute()) {
                        // Query executed successfully
                        echo "<script>alert('A new user has been added!');</script>;";

                    } else {
                        // Error executing query
                        echo "<script>alert('ERROR ADDING USER.Please try again.');</script>;";

                    }
                } else {
                    echo "<script>alert('Passwords did not match, Please try again.');</script>;";

                }
            }
            echo "<script>location.href='admin.php';</script>";
            break;
        case "delete_stop":
            $name = $_POST['name'];
            $dID = $_POST['site_id'];
            $stmt = $conn->prepare("SELECT * FROM historic_sites WHERE id = :id");
            $stmt->bindParam(":id", $dID);
            $stmt->execute();
            $data = $stmt->fetch();
            if ($name == $data['title']) {
                $stmt = $conn->prepare("DELETE FROM historic_sites WHERE id = :id");
                $stmt->bindParam(":id", $dID);
                $stmt->execute();
                echo "<script>location.href='admin.php';</script>";


            } else {
                echo "<script>alert('ERROR: Delete from database failed, Please try again.');</script>;";

            }
            break;
        case "delete_user":
            $uid = $_POST['user_id'];
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(":id", $uid);
            if ($stmt->execute()) {
                // Query executed successfully
                echo "<script>alert('A user was deleted!');</script>;";
            } else {
                // Error executing query
                echo "<script>alert('ERROR DELETING USER.Please try again.');</script>;";
            }
            echo "<script>location.href='admin.php';</script>";

    }
}

?>