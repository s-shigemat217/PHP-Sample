<?php
session_start();
require_once __DIR__ . '/inc/functions.php';
include __DIR__ . '/inc/header.php';
?>
<form method="post" action="login.php">
    <p>
        <label for="username">ユーザー名:</label>
        <input type="text" name="username">
    </p>
    <p>
        <label for="password">パスワード:</label>
        <input type="password" name="password">
    </p>
    <p class="button">
        <input type="submit" value="ログイン">
    </p>
    </form>

<?php
    if(!empty($_SESSION['login'])){
        echo '<p>ログイン済みです。</p>';
        echo '<a href="index.php">リストに戻る</a>';
        exit;
    }

    if(empty($_POST['username']) || empty($_POST['password'])){
        echo '<p>ユーザー名とパスワードを入力してください。</p>';
        exit;
    }

    try{
        $db = db_open();
        $sql = "SELECT password FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            echo '<p>ユーザー名またはパスワードが違います。</p>';
            exit;
        }
        if(password_verify($_POST['password'], $result['password'])){
            session_regenerate_id(true);
            $_SESSION['login'] = true;
            header('Location: index.php');
        } else {
            echo '<p>ログインに失敗しました。(2)</p>';
            exit;
        }
    } catch (PDOException $e){
        echo '<p>エラーが発生しました。'.str2html($e->getMessage()).'</p>';
        exit;
    }

?>

    
<?php
include __DIR__ . '/inc/footer.php';
?>