<?php
// データベース接続情報
$host = 'localhost'; // またはデータベースサーバーのホスト名
$dbname = 'your_database_name'; // データベース名
$username = 'root'; // データベースのユーザー名
$password = ''; // データベースのパスワード（設定していない場合は空白）

try {
    // データベース接続を確立
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

    // データベースにデータを挿入
    try {
        $sql = "INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // 成功メッセージを表示し、リダイレクト
        header("Location: success.html"); // 登録完了ページにリダイレクト
        exit;
    } catch (PDOException $e) {
        echo "登録失敗: " . $e->getMessage();
    }
}
?>
