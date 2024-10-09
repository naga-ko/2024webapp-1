<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
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
        <h1 class="header__title">Cartlog</h1>
    </header>
    <main class="main">
        <div class="main__inner">
            <div class="main__title">
                <img class="main__title-img" src="./image/register.png" alt="">
                <h2 class="main__title-text">新規会員登録</h2>
            </div>
            <form class="main__form" action="register_process.php" method="POST">
                <div class="main__form-list main__form-name">
                    <img class="main__form-img" src="./image/name.png" alt="">
                    <input class="main__form-input" type="text" name="nickname" value="" placeholder="ニックネーム"  required>
                     <p class="main__form-number"><span class="main__form-change">0</span>/20</p>
                </div>
                <div class="main__form-list main__form-mail">
                    <img class="main__form-img" src="./image/mail.png" alt="">
                    <input class="main__form-input" type="email" name="email" value="" placeholder="メールアドレス"  required>
                </div>
                <div class="main__form-list main__form-pass">
                    <img class="main__form-img" src="./image/pass.png" alt="">
                    <input class="main__form-input" type="password" name="password" value="" placeholder="パスワード"  required>
                </div>
                <button class="main__form-btn" type="submit">登録完了</button>
                <p id="errorMsg" style="color: red; display: none;">正しいメールアドレスとパスワードを入力してください。</p>
            </form>
        </div>
    </main>
    <footer class="footer">

    </footer>
    <script src="./js/link.js"></script>
</body>
</html>