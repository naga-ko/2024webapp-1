<?php
session_start();

// セッションからlogin_idを取得
$login_id = isset($_GET['login_id']) ? $_GET['login_id'] : null;

// セッションもしくはURLのlogin_idがない場合
if ($login_id === null) {
    // ログインしていない場合や、login_idがURLにない場合はリダイレクト
    header("Location: login.php");
    exit();
}

// brand_idをセッションに保存
$brand_id = isset($_GET['brand_id']) ? (int)$_GET['brand_id'] : 0;
$_SESSION['brand_id'] = $brand_id;  // セッションに保存

$host = "localhost";
$username = "root";
$password = "hfiuoajnjkl";
 $dbname = "user_db";

// MySQLへの接続
$conn = new mysqli($host, $username, $password, $dbname);

// 接続エラーの確認
if ($conn->connect_error) {
    die("接続失敗: (" . $conn->connect_errno . ") " . $conn->connect_error);
}

// ブランド名の取得
$brand_sql = "SELECT brand_name FROM brands WHERE id = $brand_id";
$brand_result = $conn->query($brand_sql);
$brand_name = "";

if ($brand_result->num_rows > 0) {
    $brand_row = $brand_result->fetch_assoc();
    $brand_name = htmlspecialchars($brand_row['brand_name']);
}

// 商品を取得する処理
if ($login_id !== null) {
    $sql = "SELECT id, image, product_name, size, price, memo
            FROM item
            WHERE brand_id = ? AND login_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $brand_id, $login_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "ログインしてください。";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Details</title>
    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
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
                <h2 class="main__registration-title"><?php echo $brand_name; ?></h2>
                <?php
                // login_id がセッションに存在する場合、URL に追加してリンクを生成
                if ($login_id !== null) {
                    $url_with_login_id = "http://localhost:8888/registration.php?brand_id=" . urlencode($brand_id) . "&login_id=" . urlencode($login_id);
                    echo '<a href="http://localhost:8888/item.html?brand_id='. urlencode($brand_id) .'&login_id=' . urlencode($login_id) . '"><img class="main__registration-img" src="./image/purasu.png" alt=""></a>';
                } else {
                    echo '<p>ログインしてください。</p>';
                }
                ?>
            </div>
            <?php
            // 商品が存在する場合
            if ($result->num_rows > 0) {
                // 商品データを表示
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="./itemdetails.php?id=' . urlencode($row['id']) . '&login_id=' . urlencode($login_id) . '">';
                    echo '<div class="item">';
                    echo '<img class="item__image" src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['product_name']) . '">';
                    echo '<div class="item__details">';
                    echo '<p class="item__name">' . htmlspecialchars($row['product_name']) . '</p>';
                    echo '<p class="item__size">' . htmlspecialchars($row['size']) . '</p>';
                    echo '<p class="item__price">¥' . htmlspecialchars(round($row['price'])) . '</p>';
                    echo '<p class="item__memo">' . htmlspecialchars($row['memo']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo '<p class="item__none">まだ登録されていません</p>';
            }
            ?>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__inner">
            <a class="mypage-link" href="./main.html">
                <div class="footer__list footer__itiran">
                    <img class="footer__list-img" src="./image/itiran.png" alt="">
                    <p class="footer__list-name">一覧</p>
                </div>
            </a>
            <a class="mypage-link" href="./registrationpage.php?login_id=<?php echo urlencode($login_id); ?>">
                <div class="footer__list footer__registration">
                    <img class="footer__list-img" src="./image/toruroku.png" alt="">
                    <p class="footer__list-name">登録</p>
                </div>
            </a>
            <a class="mypage-link" href="./mypage.html">
                <div class="footer__list footer__mypage">
                    <img class="footer__list-img" src="./image/mypage.png" alt="">
                    <p class="footer__list-name">マイページ</p>
                </div>
            </a>
        </div>
    </footer>
    <script src="./js/login_id.js"></script>
</body>
</html>

<?php
// 接続を閉じる
$stmt->close();
$conn->close();
?>
