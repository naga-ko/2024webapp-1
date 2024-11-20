<?php
// データベース接続情報
$host = '127.0.0.1';  // localhostの代わりに127.0.0.1を使用
$dbname = 'ProductMemory';
$username = 'My_memory_userdb';
$password = 'rftyjukijlkhgfgchgj';

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // PDOでデータベース接続を確立
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}

// フォームからデータが送信された場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力データを取得
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // パスワードをハッシュ化

    try {
        // 最大のlogin_idを取得して、新しいlogin_idを生成
        $login_id_stmt = $pdo->query("SELECT MAX(login_id) AS max_login_id FROM users");
        $login_id_result = $login_id_stmt->fetch(PDO::FETCH_ASSOC);
        $new_login_id = ($login_id_result['max_login_id'] !== null) ? $login_id_result['max_login_id'] + 1 : 1;

        // データベースに新規ユーザーのデータを挿入
        $sql = "INSERT INTO users (nickname, email, password, login_id) VALUES (:nickname, :email, :password, :login_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':login_id', $new_login_id); // login_idを挿入
        $stmt->execute();

        // 成功メッセージを表示し、リダイレクト
        header("Location: success.html"); // 登録完了ページにリダイレクト
        exit;
    } catch (PDOException $e) {
        echo "登録失敗: " . $e->getMessage();
    }
}
?>
