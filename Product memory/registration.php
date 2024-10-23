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

// 商品データを取得するSQL文
$sql = "SELECT image, product_name, size, price, memo FROM item";
$result = $conn->query($sql);
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
            <div class="main__registration">
                <h2 class="main__registration-title">GLOBAL WORK</h2>
                <a href="./registrationpage.html"><img class="main__registration-img" src="./image/purasu.png"
                        alt=""></a>
            </div>
            <?php
            // ... (データベース接続部分は省略)

            // 商品データを取得するSQL文
            $sql = "SELECT id, image, product_name, size, price, memo FROM item"; // idも取得
            $result = $conn->query($sql);
            ?>

            <!-- 商品表示部分 -->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="./itemdetails.php?id=' . urlencode($row['id']) . '">'; // IDをクエリパラメータに追加
                    echo '<div class="item">';
                    echo '<img class="item__image" src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['product_name']) . '">';
                    echo '<div class="item__details">';
                    echo '<div class="item__flex">';
                    echo '<p class="item__name">' . htmlspecialchars($row['product_name']) . '</p>';
                    echo '<p class="item__size">' . htmlspecialchars($row['size']) . '</p>';
                    echo '</div>';
                    echo '<p class="item__price">¥' . htmlspecialchars(round($row['price'])) . '</p>';
                    echo '<p class="item__memo">' . htmlspecialchars($row['memo']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo '<p>まだ登録されていません</p>';
            }
            ?>
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
$conn->close();
?>