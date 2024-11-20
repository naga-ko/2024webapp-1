const fashionBtn = document.querySelector(".main_btn-fashion");
const magazineBtn = document.querySelector(".main_btn-magazine");
const fasshion = document.querySelector(".main__fasshion");
const magazine = document.querySelector(".main__magazine");

fashionBtn.addEventListener("click", function () {
    magazineBtn.style.color = "#000";
    magazineBtn.style.backgroundColor = "#fff";
    magazineBtn.style.border = "1px #D94350 solid";
    fashionBtn.style.color = "#fff";
    fashionBtn.style.backgroundColor = "#D94350";
    fashionBtn.style.border = "none";

    fasshion.style.display = "block";
    magazine.style.display = "none";
});

magazineBtn.addEventListener("click", function () {
    magazineBtn.style.color = "#fff";
    magazineBtn.style.backgroundColor = "#D94350";
    magazineBtn.style.border = "none";
    fashionBtn.style.color = "#000";
    fashionBtn.style.backgroundColor = "#fff";
    fashionBtn.style.border = "1px #D94350 solid";

    fasshion.style.display = "none";
    magazine.style.display = "block";
});
