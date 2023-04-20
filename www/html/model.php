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

function getHomeData($conn){
    $t1q = "SELECT * FROM home";
    $stmt1 = $conn->prepare($t1q);
    $stmt1->execute();
    $data = $stmt1->fetchAll();
    return $data;
}

function getTourStop($conn){
    $getId = $_GET['id'];
    $t1q = "SELECT * FROM `historic_sites` WHERE id = " . $getId;
    $statement = $conn->prepare($t1q);
    $statement->execute();
    $data = $statement->fetchAll();
    return $data;
}

?>