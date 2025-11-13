<?php
    require_once __DIR__ . '/login_check.php';

    // ヘッダー読み込み
    require_once __DIR__ . '/inc/header.php';

    // DB接続とデータ取得
    require_once __DIR__ . '/inc/functions.php';

    // DB select
    try{
        $dbh = db_open();
        $sql = "SELECT id,title,isbn,price,publish,author FROM books";
        $statement = $dbh->query($sql);

    ?>
    <table>
        <tr>
            <th>更新</th>
            <th>書籍名</th>
            <th>ISBN</th>
            <th>価格</th>
            <th>出版日</th>
            <th>著者</th>
        </tr>
        <?php while ($row = $statement->fetch()):?>
        <tr>
            <td><a href="edit.php?id=<?= str2html($row['id']) ?>">更新</a></td>
            <td><?= str2html($row['title']) ?></td>
            <td><?= str2html($row['isbn']) ?></td>
            <td><?= str2html($row['price']) ?></td>
            <td><?= str2html($row['publish']) ?></td>
            <td><?= str2html($row['author']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php
    }catch (PDOException $e){
        echo 'Connection failed: ' . $e->getMessage() . "\n";
        exit;
    }

    // フッター読み込み
    require_once __DIR__ . '/inc/footer.php';