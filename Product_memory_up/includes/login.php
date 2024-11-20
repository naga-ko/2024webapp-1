<?php
// includes フォルダに　login.php　という名前で作る
// p277 リスト 12-4
session_start();
if (!isset($_SESSION['id'])) {
    // ログインしていない場合、login.phpへ移動させる
    header('Location: login.php');
    exit();
}
?>