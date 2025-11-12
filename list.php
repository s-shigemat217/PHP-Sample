<?php
    require_once 'functions.php';
    try{
        $user = "phpuser";
        $password = "y*1wk)YPJ-(UdAnx";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        ];
        $dbh = new PDO('mysql:host=localhost;dbname=sample_db', $user, $password, $opt);
        // var_dump($dbh);
        $sql = "SELECT title,author FROM books";
        $statement = $dbh->query($sql);

        while ($row = $statement->fetch()){
            echo "書籍名：" . str2html($row[0]) . "<br>";
            echo "著者" . str2html($row[1]) . "<br><br>";
        }
    }catch (PDOException $e){
        echo 'Connection failed: ' . $e->getMessage() . "\n";
        exit;
    }

    
?>