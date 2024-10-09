<?php
session_start();

$host = 'localhost';
$dbname = 'user_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nickname'] = $user['nickname'];
            echo "ログイン成功！ようこそ、" . $_SESSION['nickname'];
        } else {
            echo "メールアドレスまたはパスワードが間違っています。";
        }
    }
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>
