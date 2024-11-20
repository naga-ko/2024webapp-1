document.getElementById('registerForm').addEventListener('submit', function (event) {
    event.preventDefault(); // デフォルトのフォーム送信を無効化

    // フォームの入力を取得
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorMsg = document.getElementById('errorMsg');

    // 簡単なバリデーション (メールとパスワードが空ではないか)
    if (email !== '' && password !== '') {
        // バリデーション成功時、index.htmlに遷移
        window.location.href = 'index.html';
    } else {
        // バリデーション失敗時、エラーメッセージを表示
        errorMsg.style.display = 'block';
    }
});