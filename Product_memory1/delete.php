<?php
// データベース接続情報
// $servername = "localhost";
// $username = "root";
// $password = "hfiuoajnjkl";
// $dbname = "user_db";

$servername = 'localhost';  // または MySQL サーバーの IP アドレス（例：192.168.x.x）
$dbname = 'ProductMemory';
$username = 'My_memory_userdb';
$password = 'rftyjukijlkhgfgchgj';

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続エラーチェック
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// POSTデータからIDを取得
$item_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$login_id = isset($_GET['login_id']) ? $_GET['login_id'] : '';

// 商品IDが有効かチェック
if ($item_id > 0) {
    // 商品に関連するbrand_idを取得するSQL
    $sql_brand = "SELECT brand_id FROM item WHERE id = ?";
    $stmt_brand = $conn->prepare($sql_brand);
    $stmt_brand->bind_param("i", $item_id);
    $stmt_brand->execute();
    $stmt_brand->bind_result($brand_id);
    $stmt_brand->fetch();
    $stmt_brand->close();

    if ($brand_id) {
        // 商品を削除するSQL文
        $sql = "DELETE FROM item WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $item_id);

        if ($stmt->execute()) {
            // 削除成功時、成功メッセージを表示し、登録ページにリダイレクト
            echo "商品が削除されました。";
            echo '<a href="registration.php?brand_id=' . urlencode($brand_id) . '&login_id=' . urlencode($login_id) . '">戻る</a>';
        } else {
            echo "削除に失敗しました。";
        }

        // ステートメントを閉じる
        $stmt->close();
    } else {
        echo "指定された商品が見つかりませんでした。";
    }
} else {
    echo "無効な商品IDです。";
}

// 接続を閉じる
$conn->close();
?>
