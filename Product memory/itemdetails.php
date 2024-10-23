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

// クエリパラメータからIDを取得
$item_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 商品詳細を取得するSQL文
$sql = "SELECT image, product_name, size, price, memo, category FROM item WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header class="header">
        <div class="header__back">
            <h1 class="header__title">Cartlog</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__inner">
            <form class="main__item-form" action="delete.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($item_id); ?>"> <!-- IDを隠しフィールドとして送信 -->
                <?php if ($row): ?>
                    <div class="details__item">
                        <img class="details__item__image" src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                        <div class="details__item__all">
                            <div class="details__item__flex">
                                <p class="details__item__name"><?php echo htmlspecialchars($row['product_name']); ?></p>
                                <p class="details__item__size"><?php echo htmlspecialchars($row['size']); ?></p>
                                <p class="details__item__price">¥<?php echo htmlspecialchars(round($row['price'])); ?></p>
                            </div>
                            <p class="details__item__category">
                            <?php
                            // カテゴリをカタカナに変換
                            switch ($row['category']) {
                                case 'tops':
                                    echo 'トップス';
                                    break;
                                case 'pants':
                                    echo 'パンツ';
                                    break;
                                case 'skirt':
                                    echo 'スカート';
                                    break;
                                case 'dress':
                                    echo 'ワンピース';
                                    break;
                                case 'outer':
                                    echo 'アウター';
                                    break;
                                case 'shoes':
                                    echo 'シューズ';
                                    break;
                                case 'bag':
                                    echo 'バッグ・カバン';
                                    break;
                                case 'hair_accessory':
                                    echo 'ヘアアクセサリー';
                                    break;
                                case 'accessory':
                                    echo 'アクセサリー';
                                    break;
                                default:
                                    echo '未選択';
                            }
                            ?>
                            </p>
                            <p class="details__item__memo-p">メモ</p>
                            <p class="details__item__memo"><?php echo htmlspecialchars($row['memo']); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p>商品が見つかりませんでした。</p>
                <?php endif; ?>
                <!-- ボタン -->
                <div class="main__item-btn">
                    <button class="main__item-btn-cancel" type="button" onclick="location.href='./registration.php'">キャンセル</button>
                    <button class="main__item-btn-recording" type="submit">削除</button>
                </div>
            </form>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__inner">
            <a href="./main.html">
                <div class="footer__list footer__itiran">
                    <img class="footer__list-img" src="./image/itiran.png" alt="">
                    <p class="footer__list-name">一覧</p>
                </div>
            </a>
            <a href="./registration.php">
                <div class="footer__list footer__registration">
                    <img class="footer__list-img" src="./image/toruroku.png" alt="">
                    <p class="footer__list-name">登録</p>
                </div>
            </a>
            <a href="./mypage.html">
                <div class="footer__list footer__mypage">
                    <img class="footer__list-img" src="./image/mypage.png" alt="">
                    <p class="footer__list-name">マイページ</p>
                </div>
            </a>
        </div>
    </footer>
</body>
</html>

<?php
// 接続を閉じる
$stmt->close();
$conn->close();
?>
