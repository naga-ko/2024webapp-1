<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);
// ini_set('error_log', __DIR__ . '/php-error.log'); // ログファイルをプロジェクトフォルダ内に作成

// データベース接続情報
$host = 'localhost';
$dbname = 'user_db';
$username = 'root';
$password = 'hfiuoajnjkl';

try {
    // データベース接続を確立
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; // ここではハッシュ化しない
    $nickname = $_POST['nickname'];

    // デバッグ: 受信したデータを表示
    echo "POSTリクエストを受信しました。<br>";
    echo "nickname: " . htmlspecialchars($nickname) . "<br>";
    echo "email: " . htmlspecialchars($email) . "<br>";

    // メールアドレスが正しい形式かチェック
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "無効なメールアドレスです。";
        error_log("無効なメールアドレス: " . $email);
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // パスワードを比較 (データベースのハッシュ化されたパスワードとユーザーの入力を照合)
            if (password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['nickname'] = $user['nickname'];
                header("Location: main.php");
                exit();
            } else {
                echo "パスワードが一致しません。"; // エラーメッセージを明確に出力
                error_log("パスワードが一致しません。");
            }
        } else {
            echo "メールアドレスが見つかりません。"; // メールアドレスが見つからない場合
            error_log("メールアドレスが見つかりません: " . $email);
        }
    } catch (PDOException $e) {
        error_log("PDOエラー: " . $e->getMessage());
        echo "エラー: " . $e->getMessage();
    }
}
?>
