
// URLからlogin_idを取得
const urlParams = new URLSearchParams(window.location.search);
const loginId = urlParams.get('login_id'); // 例: mypage.html?login_id=2

if (loginId) {
    // .mypage-link クラスを持つ全てのリンクにlogin_idを追加
    const mypageLinks = document.querySelectorAll('.mypage-link');
    mypageLinks.forEach(link => {
        link.href = `${link.href}?login_id=${loginId}`;
    });
}
