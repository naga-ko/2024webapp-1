<?php
// データベース接続情報
$servername = "localhost";
$username = "root";
$password = "hfiuoajnjkl";
$dbname = "user_db";

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続エラーチェック
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// POSTデータからIDを取得
$item_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($item_id > 0) {
    // 商品を削除するSQL文
    $sql = "DELETE FROM item WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);

    if ($stmt->execute()) {
        // 削除成功時、成功メッセージを表示し、登録ページにリダイレクト
        echo "商品が削除されました。";
        echo "<a href='./registration.php'>戻る</a>"; // 戻るリンク
    } else {
        echo "削除に失敗しました。";
    }

    // ステートメントを閉じる
    $stmt->close();
} else {
    echo "無効な商品IDです。";
}

// 接続を閉じる
$conn->close();
?>
