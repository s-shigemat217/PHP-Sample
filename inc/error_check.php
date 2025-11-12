<?php

// varidation

if(empty($_POST['title'])){
    echo '書籍名が未入力です。<br>';
    // echo '<a href="edit.php?id=' . str2html($_POST['id']) . '">戻る</a>';
    exit;
}
if(!preg_match('/\A[[:^cntrl:]]{1,200}\z/u', $_POST['title'])){
    echo '書籍名は200文字までです。<br>';
    // echo '<a href="edit.php?id=' . str2html($_POST['id']) . '">戻る</a>';
    exit;
}
if(!preg_match('/\A\d{0,13}\z/u', $_POST['isbn'])){
    echo 'ISBNは数字13桁までです。<br>';
    // echo '<a href="edit.php?id=' . str2html($_POST['id']) . '">戻る</a>';
    exit;
}
if(!preg_match('/\A\d{0,6}\z/u', $_POST['price'])){
    echo '価格は数字6桁までです。<br>';
    // echo '<a href="edit.php?id=' . str2html($_POST['id']) . '">戻る</a>';
    exit;
}
if(empty($_POST['publish'])){
    echo '日付が未入力です。<br>';
    // echo '<a href="edit.php?id=' . str2html($_POST['id']) . '">戻る</a>';
    exit;
}
if(!preg_match('/\A\d{4}-\d{1,2}-\d{1,2}\z/u', $_POST['publish'])){
    echo '日付のフォーマットが違います。<br>';
    // echo '<a href="edit.php?id=' . str2html($_POST['id']) . '">戻る</a>';
    exit;
}