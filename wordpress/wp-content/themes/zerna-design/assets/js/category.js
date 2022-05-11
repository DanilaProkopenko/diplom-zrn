// // Вешаем обработчик клика на UL, не LI
// document.querySelector('#category__ul').addEventListener('click', function (e) {
//     // Получили ID, т.к. в e.target содержится элемент по которому кликнули
//     var id = e.target.id;
//     document.querySelector('#test strong').innerHTML = id; // For example
// });

/*AJAX*/
jQuery(document).ready(function($) {
    //по загрузке стр вывод всех постов 
    getPosts(5);
    // по клику на выбранную категорию
    jQuery(".portfolio__filter__category__ul li").on("click", function() {
        console.log(this);
        getPosts(this.getAttribute("cat_id"));
    });

    // toggle li category
    $('#category__ul li').click(function() {
        // $(this).addClass('active');
        $(this).addClass('portfolio__filter__category__li_active').siblings().removeClass('portfolio__filter__category__li_active')
        // $(this).parent().children('li').not(this).removeClass('active');
    });
});

function getPosts(catid) {
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php') ?>";
    jQuery.post(ajaxUrl, {
            action: "more_post_ajax",
            category: catid
        })
        .done(function(posts) {
            jQuery(".pr-works").html(posts);
        });
}