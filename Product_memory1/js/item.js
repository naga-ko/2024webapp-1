//item
const selection = document.querySelector(".main__item-selection");
const selectionList = document.querySelector(".main__item-selection-list");
const selectionImg = document.querySelector(".main__item-selection-img");
let v = 0;

selection.addEventListener("click", function () {
    v++;

    if (v % 2 == 1) {
        // 奇数の場合
        selectionImg.setAttribute("src", "../image/yajirusi-up.png"); // 上向き矢印の画像に変更
        selectionList.style.display = "block";
    } else {
        // 偶数の場合
        selectionImg.setAttribute("src", "../image/yajirusi.png"); // 下向き矢印の画像に変更
        selectionList.style.display = "none";
    }
});
