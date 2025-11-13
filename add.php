<?php
    require_once __DIR__ . '/inc/token_check.php';
    require_once __DIR__ . '/inc/functions.php';
    require_once __DIR__ . '/inc/error_check.php';
    require_once __DIR__ . '/inc/header.php';

    // DB insert
    try{
        $dbh = db_open();
        $sql = "INSERT INTO books (id,title,isbn,price,publish,author) VALUES (NULL, :title, :isbn,:price,:publish, :author)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
        $stmt->bindValue(':isbn', $_POST['isbn'], PDO::PARAM_STR);
        $stmt->bindValue(':price', $_POST['price'], PDO::PARAM_INT);
        $stmt->bindValue(':publish', $_POST['publish'], PDO::PARAM_STR);
        $stmt->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
        $stmt->execute();
        echo 'データを追加しました。<br>';
        echo '<a href="index.php">書籍一覧へ戻る</a>';
    }catch (PDOException $e){
        echo 'Connection failed: ' . $e->getMessage() . "\n";
        exit;
    }


    
?>