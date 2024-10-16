<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// データベース接続情報
$host = 'localhost'; // またはデータベースサーバーのホスト名
$dbname = 'user_db'; // データベース名
$username = 'root'; // データベースのユーザー名
$password = 'hfiuoajnjkl'; // データベースのパスワード（設定していない場合は空白）

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nickname = $_POST['nickname'];

    // デバッグ: 受信したデータを表示
    echo "POSTリクエストを受信しました。<br>";
    echo "Nickname: " . htmlspecialchars($nickname) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Password: " . htmlspecialchars($password) . "<br>";

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // パスワードを比較
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nickname'] = $user['nickname'];
            header("Location: main.html");
            exit();
        } else {
            echo "メールアドレスまたはパスワードが間違っています。";
        }
    } else {
        echo "メールアドレスが見つかりません。";
    }
}
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>