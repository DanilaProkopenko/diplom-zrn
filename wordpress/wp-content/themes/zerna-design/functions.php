<?

add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    wp_enqueue_script('jquery');
}


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('style-name', get_template_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script(
        'screen_menu',
        get_template_directory_uri() . '/assets/js/screen_menu.js',
        array('jquery'),
        1.0,
        true
    );
    wp_enqueue_script(
        'post_category',
        get_template_directory_uri() . '/assets/js/post_category.js',
        array('jquery'),
        1.0,
        true
    );
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
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


// Форма обратной связи
add_shortcode('art_feedback', 'art_feedback');
/**
 * Шорткод вывода формы
 *
 * @return string
 * @see https://wpruse.ru/?p=3224
 */
function art_feedback()
{

    ob_start();
    ?>
    <form id="add_feedback">
        <input type="text" name="art_name" id="art_name" class="required art_name" placeholder="Ваше имя" value="" />

        <input type="email" name="art_email" id="art_email" class="required art_email" placeholder="Ваш E-Mail" value="" />

        <input type="text" name="art_subject" id="art_subject" class="art_subject" placeholder="Тема сообщения" value="" />

        <textarea name="art_comments" id="art_comments" placeholder="Сообщение" rows="10" cols="30" class="required art_comments"></textarea>

        <input type="checkbox" name="art_anticheck" id="art_anticheck" class="art_anticheck" style="display: none !important;" value="true" checked="checked" />

        <input type="text" name="art_submitted" id="art_submitted" value="" style="display: none !important;" />

        <input type="submit" id="submit-feedback" class="button" value="Отправить сообщение" />
    </form>
<?php

    return ob_get_clean();
}

add_action('wp_enqueue_scripts', 'art_feedback_scripts');
function art_feedback_scripts()
{

    // Обрабтка полей формы
    wp_enqueue_script('jquery-form');

    // Подключаем файл скрипта
    wp_enqueue_script(
        'feedback',
        // get_stylesheet_directory_uri() . 'assets/js/feedback.js',
        get_template_directory_uri() . '/assets/js/feedback.js',
        array('jquery'),
        1.0,
        true
    );

    // Задаем данные обьекта ajax
    wp_localize_script(
        'feedback',
        'feedback_object',
        array(
            'url'   => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('feedback-nonce'),
        )
    );
}
add_action('wp_ajax_feedback_action', 'ajax_action_callback');
add_action('wp_ajax_nopriv_feedback_action', 'ajax_action_callback');
/**
 * Обработка скрипта
 *
 * @see https://wpruse.ru/?p=3224
 */
function ajax_action_callback()
{

    // Массив ошибок
    $err_message = array();

    // Проверяем nonce. Если проверкане прошла, то блокируем отправку
    if (!wp_verify_nonce($_POST['nonce'], 'feedback-nonce')) {
        wp_die('Данные отправлены с левого адреса');
    }

    // Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
    if (false === $_POST['art_anticheck'] || !empty($_POST['art_submitted'])) {
        wp_die('Пошел нахрен, мальчик!(c)');
    }

    // Проверяем полей имени, если пустое, то пишем сообщение в массив ошибок
    if (empty($_POST['art_name']) || !isset($_POST['art_name'])) {
        $err_message['name'] = 'Пожалуйста, введите ваше имя.';
    } else {
        $art_name = sanitize_text_field($_POST['art_name']);
    }

    // Проверяем полей емайла, если пустое, то пишем сообщение в массив ошибок
    if (empty($_POST['art_email']) || !isset($_POST['art_email'])) {
        $err_message['email'] = 'Пожалуйста, введите адрес вашей электронной почты.';
    } elseif (!preg_match('/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $_POST['art_email'])) {
        $err_message['email'] = 'Адрес электронной почты некорректный.';
    } else {
        $art_email = sanitize_email($_POST['art_email']);
    }
    // Проверяем полей темы письма, если пустое, то пишем сообщение по умолчанию
    if (empty($_POST['art_subject']) || !isset($_POST['art_subject'])) {
        $art_subject = 'Сообщение с сайта';
    } else {
        $art_subject = sanitize_text_field($_POST['art_subject']);
    }

    // Проверяем полей сообщения, если пустое, то пишем сообщение в массив ошибок
    if (empty($_POST['art_comments']) || !isset($_POST['art_comments'])) {
        $err_message['comments'] = 'Пожалуйста, введите ваше сообщение.';
    } else {
        $art_comments = sanitize_textarea_field($_POST['art_comments']);
    }

    // Проверяем массив ошибок, если не пустой, то передаем сообщение. Иначе отправляем письмо
    if ($err_message) {

        wp_send_json_error($err_message);
    } else {

        // Указываем адресата
        $email_to = 'danilaprok20@gmail.com';

        // Если адресат не указан, то берем данные из настроек сайта
        if (!$email_to) {
            $email_to = get_option('admin_email');
        }

        $body    = "Имя: $art_name \nEmail: $art_email \n\nСообщение: $art_comments";
        $headers = 'From: ' . $art_name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;

        // Отправляем письмо
        wp_mail($email_to, $art_subject, $body, $headers);

        // Отправляем сообщение об успешной отправке
        $message_success = 'Собщение отправлено. В ближайшее время я свяжусь с вами.';
        wp_send_json_success($message_success);
    }

    // На всякий случай убиваем еще раз процесс ajax
    wp_die();
}

// Telegram message
// function cf7_send_tg($contact_form, $abort, $submission)
// {
//     global $wpcf;
//     $wpcf->skip_mail = true;  # Отключаем отправку письма на эмейл
//     // $name2 = $submission->get_posted_data('your-name');  # Название поля Имя
//     $email2 = $submission->get_posted_data('email');  # Название поля Эмейл
//     // $subject2 = $submission->get_posted_data('your-subject');  # Название поля Темы
//     $mess2 = $submission->get_posted_data('your-message');  # Название поля Сообщение
//     $msg = '*Письмо с сайта bdseo.ru*
 
// ';
//     // $msg .= $email2 . " ( {$name2}) Тема: {$subject2}";
//     $msg .= $email2;
//     $msg .= ' пишет: 
 
// ' . $mess2;

//     // $userId = '264111146'; // id user, которому отправляем письмо
//     // $token = '1011112249:AAEOhnCB8lq3B8lq3B8lJehhB8lq3LW-IG8'; // Token бота 
//     $userId = '764707849'; // id user, которому отправляем письмо
//     $token = '5317565362:AAEyFa8Lriv8sYINtIvCXzlRhv8lX03QxoE'; // Token бота 


//     file_get_contents('https://api.telegram.org/bot' . $token . '/sendMessage?chat_id=' . $userId . '&text=' . urlencode($msg) . '&parse_mode=markdown');
// }
// // add the action 
// add_action('wpcf7_before_send_mail', 'cf7_send_tg', 10, 3); 
        


// // new ajax not working

// function blog_scripts()
// {
//     // Register the script
//     wp_register_script('custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), false, true);

//     // Localize the script with new data
//     $script_data_array = array(
//         'ajaxurl' => admin_url('admin-ajax.php'),
//         'security' => wp_create_nonce('load_more_posts'),
//     );
//     wp_localize_script('custom-script', 'blog', $script_data_array);

//     // Enqueued script with localized data.
//     wp_enqueue_script('custom-script');
// }
// add_action('wp_enqueue_scripts', 'blog_scripts');

// function load_more_ajax()
// {
//     // check_ajax_referer('load_more_posts', 'security');

//     $paged = $_POST['page'];
//     global $post;
//     // $catID = $_POST['id'];
//     $args = array(
//         'post_type' => 'post',
//         'post_status' => 'publish',
//         'cat' => 5,
//         'paged' => $paged,
//         'posts_per_page' => -1
//     );
//     $blog_posts = new WP_Query($args);

//     if ($blog_posts->have_posts()) {
//         while ($blog_posts->have_posts()) {
//             $blog_posts->the_post();
//             $cat_real = get_the_category($post->id);
//             $cat_real = $cat_real[1]->term_id;
//         }
//     }
// }

// add_action('wp_ajax_load_more_ajax', 'load_more_ajax');
// add_action('wp_ajax_nopriv_load_more_ajax', 'load_more_ajax');
