<?php
    require_once __DIR__ . '/login_check.php';

    require_once __DIR__ . '/inc/functions.php';
    // validation
    if(empty($_GET['id'])){
        echo 'IDを指定してください。<br>';
        echo '<a href="index.php">書籍一覧へ戻る</a>';
        exit;
    }
    if(!preg_match('/\A\d{1,11}+\z/u', $_GET['id'])){
        echo 'IDが正しくありません。<br>';
        echo '<a href="list.html">戻る</a>';
        exit;
    }

    // DB select
    $id = (int)$_GET['id'];
    $dbh = db_open();
    $sql = "SELECT id,title,isbn,price,publish,author FROM books WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$result){
        echo '該当するデータがありません。<br>';
        echo '<a href="index.php">書籍一覧へ戻る</a>';
        exit;
    }
    // var_dump($result);

    // 取得したデータをフォームに配置
    $title = str2html($result['title']);
    $isbn = str2html($result['isbn']);
    $price = str2html($result['price']);
    $publish = str2html($result['publish']);
    $author = str2html($result['author']);
    $id = str2html($result['id']);

    $html_form = <<<EOD
    <form action="update.php" method="post">
        <p>
            <label for="title">書籍名:</label><br>
            <input type="text" id="title" name="title" value="$title"><br>
        </p>
        <p>
            <label for="isbn">ISBN:</label><br>
            <input type="text" id="isbn" name="isbn" value="$isbn"><br>
        </p>
        <p>
            <label for="price">価格:</label><br>
            <input type="text" id="price" name="price" value="$price"><br>
        </p>
        <p>
            <label for="publish">出版日:</label><br>
            <input type="text" id="publish" name="publish" value="$publish"><br>
        </p>
        <p>
            <label for="author">著者:</label><br>
            <input type="text" id="author" name="author" value="$author"><br><br>
        </p>
        <p class="button">
            <input type="hidden" name="id" value="$id">
            <input type="submit" value="更新">        
        </p>
    </form>
    EOD;
    require_once __DIR__ . '/inc/header.php';
    echo $html_form;
    require_once __DIR__ . '/inc/footer.php';