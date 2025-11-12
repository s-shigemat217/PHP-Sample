<?php
    require_once 'functions.php';

    // varidation
    if(empty($_POST['title'])){
        echo 'タイトルが未入力です。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    if(!preg_match('/\A[[:^cntrl:]]{1,200}\z/u', $_POST['title'])){
        echo 'タイトルは200文字までです。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    if(!preg_match('/\A\d{0,13}\z/u', $_POST['isbn'])){
        echo 'ISBNは数字13桁までです。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    if(!preg_match('/\A\d{0,6}\z/u', $_POST['price'])){
        echo '価格は数字6桁までです。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    if(empty($_POST['publish'])){
        echo '日付が未入力です。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    if(!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u', $_POST['publish'])){
        echo '日付のフォーマットが違います。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    $date = explode('-', $_POST['publish']);
    if(!checkdate($date[1], $date[2], $date[0])){
        echo '正しい日付を入力してください。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    if(!preg_match('/\A[[:^cntrl:]]{1,80}\z/u', $_POST['author'])){
        echo 'タイトルは200文字までです。<br>';
        echo '<a href="add.html">戻る</a>';
        exit;
    }
    

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
        echo '<a href="list.php">書籍一覧へ戻る</a>';
    }catch (PDOException $e){
        echo 'Connection failed: ' . $e->getMessage() . "\n";
        exit;
    }


    
?>