<?php
    require_once __DIR__ . '/inc/functions.php';
    require_once __DIR__ . '/inc/error_check.php';
    require_once __DIR__ . '/inc/header.php';

    // varidation
    if(empty($_POST['id'])){
        echo 'IDを指定してください。<br>';
        echo '<a href="index.php">書籍一覧へ戻る</a>';
        exit;
    }
    if(!preg_match('/\A\d{1,11}+\z/u', $_POST['id'])){
        echo 'IDが正しくありません。<br>';
        echo '<a href="index.php">書籍一覧へ戻る</a>';
        exit;
    }
    

    try{
        $dbh = db_open();
        $sql = "UPDATE books SET title = :title, isbn = :isbn, price = :price, publish = :publish, author = :author WHERE id = :id";
        $stmt = $dbh->prepare($sql);

        $price = (int)$_POST['price'];
        $id = (int)$_POST['id'];
        $stmt->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
        $stmt->bindValue(':isbn', $_POST['isbn'], PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_INT);
        $stmt->bindValue(':publish', $_POST['publish'], PDO::PARAM_STR);
        $stmt->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        echo 'データを更新しました。<br>';
        echo '<a href="index.php">書籍一覧へ戻る</a>';

   
   
    }catch (PDOException $e){
        echo 'Connection failed: ' . $e->getMessage() . "\n";
        exit;
    }
    require_once __DIR__ . '/inc/footer.php';
?>