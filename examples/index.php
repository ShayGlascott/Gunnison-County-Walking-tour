<!DOCTYPE html>  
    <head>  
     <title>Hello World!</title>
    </head>   

    <body>  
        <h1>Hello World!</h1>  
        <p><?php echo 'We are running PHP, version: ' . phpversion(); ?></p>  
        <?  // Database values:
            $database ="tourdb";  
            $user = "user";  
            $password = "password";  
            $host = "mysql"; // Do not change 

            // Use the PDO database extension for php (https://www.php.net/manual/en/book.pdo.php)
            $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);  
            $query = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_TYPE='BASE TABLE'");  
            $tables = $query->fetchAll(PDO::FETCH_COLUMN);  

            // The rest of the code shouldn't need to be changed
            if (empty($tables)) {
                echo "<p>There are no tables in database \"{$database}\".</p>";
            } else {
                echo "<p>Database \"{$database}\" has the following tables:</p>";
                echo "<ul>";
                    foreach ($tables as $table) {
                        echo "<li>{$table}</li>";
                    }
                echo "</ul>";
            }
        ?>
    </body>
</html>