<?php
    session_start();
    $token = bin2hex(random_bytes(20));
    $_SESSION['token'] = $token;

    require_once __DIR__ . '/inc/functions.php';
    require_once __DIR__ . '/inc/header.php';
    
    $html_form = <<<EOD
    <form action="add.php" method="post">
        <p>
            <label for="title">書籍名（必須・200文字まで）</label>
            <input type="text" name="title">
        </p>
        <p>
            <label for="isbn">ISBNコード（必須・13桁）</label>
            <input type="text" name="isbn">
        </p>
        <p>
            <label for="price">価格（必須・半角数字6桁）</label>
            <input type="text" name="price">
        </p>
        <p>
            <label for="publish">出版日（必須・YYYY-MM-DD形式）</label>
            <input type="date" name="publish">
        </p>
        <p>
            <label for="author">著者名（必須・80文字まで）</label>
            <input type="text" name="author">
        </p>
        <p class="button">
            <input type="hidden" name="token" value="$token">
            <input type="submit" value="送信する">
        </p>
    </form>
    EOD;
    
    echo $html_form;
    require_once __DIR__ . '/inc/footer.php';