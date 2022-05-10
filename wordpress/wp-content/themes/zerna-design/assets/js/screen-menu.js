let menuBtnOpen = document.getElementById('menu-btn-open');
let menuBtnClose = document.getElementById('menu-btn-close');
let screenMenuBox = document.getElementById('screen-menu__box');
document.addEventListener('DOMContentLoaded', function () {
    menuBtnOpen.onclick = function(){
        screenMenuBox.classList.add('active');

        // alert('click');
    }
    menuBtnClose.onclick = function(){
        screenMenuBox.classList.remove('active');
    }
 });