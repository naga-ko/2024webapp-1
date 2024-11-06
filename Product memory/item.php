<?php
session_start();

// セッションからlogin_idを取得
$login_id = $_SESSION['login_id'] ?? null;

// URLからlogin_idを取得（もしセッションがない場合）
if ($login_id === null) {
    $login_id = isset($_GET['login_id']) ? (int)$_GET['login_id'] : null;
}

if ($login_id === null) {
    // ログインしていない場合や、login_idがURLにない場合はリダイレクト
    header("Location: login.php");
    exit();
}

// データベース接続
$servername = "localhost";
$username = "root";
$password = "hfiuoajnjkl";
$dbname = "user_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// フォームからデータを受け取る
$product_name = $_POST['product_name'];
$size = $_POST['size'];
$price = $_POST['price'];
$category = $_POST['category'];
$memo = $_POST['memo'];
$brand_id = $_POST['brand_id']; // 追加: brand_idを取得

// 価格が空ならデフォルト値0を設定（またはNULLにすることも可能）
if (empty($price)) {
    $price = 0;
}

// 画像アップロード処理
$image = "";
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image = $target_file;
    } else {
        echo "画像のアップロードに失敗しました。";
        exit;
    }
}

// itemテーブルにデータを挿入するSQL文
$stmt = $conn->prepare("INSERT INTO item (product_name, size, price, category, memo, image, brand_id, login_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssii", $product_name, $size, $price, $category, $memo, $image, $brand_id, $login_id);

if ($stmt->execute()) {
    echo "新しい商品が追加されました";
    echo '<a href="registration.php?brand_id=' . htmlspecialchars($brand_id) . '&login_id=' . htmlspecialchars($login_id) . '" class="btn-back">戻る</a>';
} else {
    echo "エラー: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
