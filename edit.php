<?php

    require_once 'functions.php';

    if(empty($_GET['id'])){
        echo 'IDを指定してください。<br>';
        echo '<a href="list.php">書籍一覧へ戻る</a>';
        exit;
    }
    if(!preg_match('/\A\d{1,11}+\z/u', $_GET['id'])){
        echo 'IDが正しくありません。<br>';
        echo '<a href="list.html">戻る</a>';
        exit;
    }

    $id = (int)$_GET['id'];

    $dbh = db_open();
    $sql = "SELECT id,title,isbn,price,publish,author FROM books WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        echo '該当するデータがありません。<br>';
        echo '<a href="list.php">書籍一覧へ戻る</a>';
        exit;
    }
    var_dump($result);