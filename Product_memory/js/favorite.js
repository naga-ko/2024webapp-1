const favorite = document.querySelector(".main__mypage-favorite");
const favoriteList = document.querySelector(".main__mypage-favorite-list");
const yajirusiimg = document.querySelector(".main__mypage-favorite-yajirusi");
let s = 0;

favorite.addEventListener("click", function () {
    s++;

    if (s % 2 == 1) {
        // 奇数の場合
        yajirusiimg.setAttribute("src", "../image/yajirusi-up.png"); // 上向き矢印の画像に変更
        favoriteList.style.display = "block";
    } else {
        // 偶数の場合
        yajirusiimg.setAttribute("src", "../image/yajirusi.png"); // 下向き矢印の画像に変更
        favoriteList.style.display = "none";
    }
});
