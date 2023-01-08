// ハンバーガーメニュー
function hamburger() {
document.getElementById('line1').classList.toggle('line_1');
document.getElementById('line3').classList.toggle('line_3');
document.getElementById('nav').classList.toggle('in');
document.querySelector('.fixed_line').classList.toggle('fixed_line_disappeared');
}
document.getElementById('hamburger').addEventListener('click' , function () {
    hamburger();
} );