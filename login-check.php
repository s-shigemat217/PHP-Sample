<?php
if(!isset($_SESSION)){
    session_start();
}
if(empty($_SESSION['login'])){
    echo '<p>ログインしてください。</p>';
    exit;
}
echo '<p>ログイン済みです。</p>';