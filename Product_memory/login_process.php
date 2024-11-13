<?php
session_start();
// データベース接続情報
$host = 'localhost';  // または MySQL サーバーの IP アドレス（例：192.168.x.x）
$dbname = 'ProductMemory';
$username = 'My_memory_userdb';
$password = 'rftyjukijlkhgfgchgj';


try {
    // データベース接続を確立
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // フォームデータの取得
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 入力値チェック
    if (empty($email) || empty($password)) {
        echo "すべてのフィールドを入力してください。";
        exit();
    }

    // メールアドレスが正しい形式かチェック
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "無効なメールアドレスです。";
        exit();
    }

    try {
        // メールアドレスを基にユーザー情報を取得
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // パスワードを比較
            if (password_verify($password, $user['password'])) {
                // ログイン成功
                $_SESSION['id'] = $user['id']; // ユーザーIDをセッションに保存
                $_SESSION['nickname'] = $user['nickname']; // ニックネームをセッションに保存
                $_SESSION['login_id'] = $user['login_id']; // login_idをセッションに保存

                // リダイレクト（既存のlogin_idを使う）
                header("Location: main.html?login_id=" . $_SESSION['login_id']);
                exit();
            } else {
                echo "パスワードが一致しません。";
            }
        } else {
            echo "メールアドレスが見つかりません。";
        }
    } catch (PDOException $e) {
        error_log("PDOエラー: " . $e->getMessage());
        echo "エラーが発生しました。";
    }
}
?>
