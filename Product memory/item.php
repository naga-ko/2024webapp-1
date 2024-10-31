<?php
// データベース接続情報
$servername = "localhost"; // サーバー名
$username = "root"; // ユーザー名
$password = "hfiuoajnjkl"; // パスワード
$dbname = "user_db"; // データベース名

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続エラーチェック
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

// 画像アップロード処理
$image = ""; // デフォルトの値
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_dir = "uploads/"; // アップロード先ディレクトリ
    $target_file = $target_dir . basename($_FILES['image']['name']);

    // 画像ファイルを移動
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image = $target_file; // アップロードしたファイルのパス
    } else {
        echo "画像のアップロードに失敗しました。";
        exit;
    }
}

// データを挿入するSQL文
$stmt = $conn->prepare("INSERT INTO item (product_name, size, price, category, memo, image, brand_id) VALUES (?, ?, ?, ?, ?, ?, ?)"); // brand_idを追加
$stmt->bind_param("sssssss", $product_name, $size, $price, $category, $memo, $image, $brand_id); // brand_idをバインド

// 実行
if ($stmt->execute()) {
    echo "新しい商品が追加されました";
    echo '<a href="registration.php?brand_id=' . htmlspecialchars($brand_id) . '" class="btn-back">戻る</a>'; // brand_idを追加
} else {
    echo "エラー: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>

?>
