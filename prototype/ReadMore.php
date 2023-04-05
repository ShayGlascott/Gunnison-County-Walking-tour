<?php 
    $dsn = 'mysql:host=localhost;dbname=tour_db';
    $username = 'student';
    $password = 'CS350';
    $db = new PDO($dsn, $username, $password);
    $getId = $_GET['id'];

    $t1q = "SELECT * FROM `historic_sites` WHERE id =". $getId;
    $id = 1;
    $statement = $db->prepare($t1q);
    $statement->execute();
    $data= $statement->fetchAll();
?>

<html>
    <?php foreach($data as $data): ?>
<head>

</head>
<body>
    <?php echo $data['text2'] ?> 
</body>   
<?php endforeach; ?>
</html>
