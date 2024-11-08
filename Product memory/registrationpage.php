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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Laila&display=swap" rel="stylesheet">
    <link rel="icon" href="">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="description" content="">
    <meta property="og:url" content="">
    <meta property="og:type" content="">
    <meta property="og:title" content="">
    <meta property="og:image" content="">
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta property="og:locale" content="">
</head>

<body>
    <header class="header">
        <div class="header__back">
            <h1 class="header__title">Cartlog</h1>
        </div>
    </header>
    <main class="main">
        <div class="main__inner">
            <div class="main__registrationpage">
                <p class="main__registrationpage-text">タグに端末を近づけてください</p>
                <img class="main__registrationpage-img" src="./image/tag.png" alt="">
                <!-- ブランドIDを含むリンクを生成 -->
                <a href="./main.html">
                    <img class="main__registrationpage-batu" src="./image/batu.png" alt="">
                </a>
            </div>
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
            <a class="mypage-link" href="./registrationpage.php">
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