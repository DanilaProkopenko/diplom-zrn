<?

add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    wp_enqueue_script('jquery');
}


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('style-name', get_template_directory_uri() . '/assets/css/style.css');
    // <script src="./js/screen-menu.js"></script>

    // wp_enqueue_script('screen-menu', get_template_directory_uri() . bloginfo().'/assets/js/screen-menu.js', true);
});

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');


add_filter('upload_mimes', 'svg_upload_allow');

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow($mimes)
{
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{

    // WP 5.1 +
    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>='))
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    else
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));

    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if ($dosvg) {

        // разрешим
        if (current_user_can('manage_options')) {

            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        // запретим
        else {
            $data['ext'] = $type_and_ext['type'] = false;
        }
    }

    return $data;
}

// работает изменение стилей в классе изображений
function add_image_fluid_class($content)
{
    global $post;
    $pattern = "/<img(.*?)class=\"(.*?)\"(.*?)>/i";
    // $pattern ="<img class=`хуй`>/i";
    // $replacement = '<div class="work__discription__img-box"><img$1class="$2 work__discription__img"$3></div>';
    $replacement = '<img$1class="$2 work__discription__img"$3>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
// работает изменение стилей в классе-родителе изображений
function add__figure_fluid_class($content)
{
    global $post;
    // $pattern = "/<figure class=\"[A-Za-z-]*\">/i";
    $pattern = "/<figure(.*?)class=\"(.*?)\"(.*?)>/i";
    // $replacement = '<div class="work__discription__img-box">';
    $replacement = '<figure$1class="$2 work__discription__img-box"$3>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

// AJAX category post
function more_post_ajax()
{
    $category = $_POST["category"];
    header("Content-Type: text/html");
    $args = [
        'suppress_filters' => true,
        'post_type' => 'post',
        // 'posts_per_page' => 2,
        // 'paged' => 1,
        'cat' => $category
    ];
    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();
        $post_id = get_the_ID();
        $cat_id = get_the_category($post_id)[0]->term_id;
        $cat_name = get_cat_name($cat_id);

?>
        <div class="pr-work__box">
            <a href="<?php the_permalink(); ?>" class="pr-work__link">
                <div class="pr-work__thumb">
                    <?php the_post_thumbnail(array(1920, 1080), array('class' => 'pr-work__thumb__img')); ?>
                </div>
                <div class="pr-work__name">
                    <?php the_title(); ?>
                </div>
                <div class="pr-work__category">
                    <? echo $cat_name; ?>
                </div>
            </a>
        </div>
<?
    }
    exit;
}



// new ajax not working
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

function blog_scripts()
{
    // Register the script
    wp_register_script('custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), false, true);

    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('load_more_posts'),
    );
    wp_localize_script('custom-script', 'blog', $script_data_array);

    // Enqueued script with localized data.
    wp_enqueue_script('custom-script');
}
add_action('wp_enqueue_scripts', 'blog_scripts');

function load_more_ajax()
{
    // check_ajax_referer('load_more_posts', 'security');

    $paged = $_POST['page'];
    global $post;
    // $catID = $_POST['id'];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 5,
        'paged' => $paged,
        'posts_per_page' => -1
    );
    $blog_posts = new WP_Query($args);

    if ($blog_posts->have_posts()) {
        while ($blog_posts->have_posts()) {
            $blog_posts->the_post();
            $cat_real = get_the_category($post->id);
            $cat_real = $cat_real[1]->term_id;
        }
    }
}

add_action('wp_ajax_load_more_ajax', 'load_more_ajax');
add_action('wp_ajax_nopriv_load_more_ajax', 'load_more_ajax');
