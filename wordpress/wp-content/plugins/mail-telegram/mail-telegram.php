<?php
/*
Plugin Name: Send form to mail and telegram
Description: Sends messages to Telegram-chat and Mail
Author:      Danila
Version:     1.0 
*/

/*  Copyright 2020  Danila  (email : danilaprok20@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// страница настроек
add_action('admin_menu', 'myplagin_admin_page'); //Добавить новое меню в админку Wordpress
// add_action('admin_menu', 'admin'); //Добавить новое меню в админку Wordpress
add_option('token', 'token');
add_option('chatId', 'chatId');
add_option('mail', 'mail');
add_option('tgToggle', 'tgToggle');

// function admin()
// {
//     if (function_exists('add_options_page')) {
//         add_options_page(
//             'Mail to Telegram Options',
//             'Mail to Telegram',
//             8,
//             basename(__FILE__),
//             array(&$this, 'admin_form')
//         );
//     }
// }
// function admin_form()
// {
//     $token = get_option('token');
// }
function myplagin_admin_page()
{
    add_options_page('Mail to Telegram Options', 'Mail to Telegram', 8,  basename(__FILE__), 'myplagin_options_page');
}


function myplagin_options_page()
{
    //Функция создания и обработки страницы настроек плагина
    $token = get_option('token');
    $mail = get_option('mail');
    $chatId = get_option('chatId');

    // checkbox
    $tgToggle = get_option('tgToggle');
    $tgToggle = $tgToggle ? $tgToggle['checkbox'] : null;

    if (isset($_POST['submit'])) {
        if (
            function_exists('current_user_can') &&
            !current_user_can('manage_options')
        )
            die(_e('Hacker?', 'matel'));

        if (function_exists('check_admin_referer')) {
            check_admin_referer('matel_form');
        }

        $token = $_POST['token'];
        $mail = $_POST['mail'];
        $tgToggle = $_POST['tgToggle'];

        update_option('token', $token);
        update_option('mail', $mail);
        update_option('chatId', $chatId);
        update_option('tgToggle', $tgToggle);
    }
?>
    <div class='wrap'>
        <h2><?php _e('Mail to Telegram Settings', 'matel'); ?></h2>

        <form name="matel" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=mail-telegram.php&amp;updated=true">

            <!-- Имя ljusers_form используется в check_admin_referer -->
            <?php
            if (function_exists('wp_nonce_field')) {
                wp_nonce_field('matel_form');
            }
            ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Telegram bot token:', 'token'); ?></th>

                    <td>
                        <input type="text" name="token" size="80" value="<?php echo $token; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Mail:', 'mail'); ?></th>

                    <td>
                        <input type="email" name="mail" size="80" value="<?php echo $mail; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Chat Id:', 'chatId'); ?></th>

                    <td>
                        <input type="text" name="chatId" size="80" value="<?php echo $chatId; ?>" />
                        <label><input type="checkbox" name="tgToggle[checkbox]" value="1" <?php checked(1, $tgToggle) ?> /> Отправка в телеграм
                    </td>
                </tr>

            </table>

            <input type="hidden" name="action" value="update" />

            <input type="hidden" name="page_options" value="token" />

            <p class="submit">
                <input type="submit" name="submit" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
    </div>
<?
};

function art_feedback_2()
{
    $token = get_option('token');
    $mail = get_option('mail');
    $chatId = get_option('chatId');
    $tgToggle = get_option('tgToggle');

    return '<form id="add_feedback_2">
    <input type="text" name="art_name_2" id="art_name_2" class="required art_name" placeholder="Ваше имя" value="" />

    <input type="email" name="art_email_2" id="art_email_2" class="required art_email" placeholder="Ваш E-Mail" value="" />

    <input type="checkbox" name="art_anticheck_2" id="art_anticheck_2" class="art_anticheck" style="display: none !important;" value="true" checked="checked" />
    <input type="text" name="art_submitted_2" id="art_submitted_2" value="" style="display: none !important;" />

    <input type="submit" id="submit-feedback_2" class="button" value="Отправить сообщение" />
    <p>' . $mail . '<p>
    <p>' . var_dump($tgToggle) . '<p>
</form>';
}

add_shortcode('art_feedback_2', 'art_feedback_2');
add_action('wp_enqueue_scripts', 'art_feedback_2_scripts');


function art_feedback_2_scripts()
{

    // Регистрируем скрипт
    wp_register_script(
        'feedback_2',
        plugins_url('/js/feedback_2.js', __FILE__),
        array('jquery'),
        2.0,
        true
    );


    // Обрабтка полей формы
    wp_enqueue_script('jquery-form');

    // Подключаем файл скрипта
    wp_enqueue_script('feedback_2');
 
    wp_localize_script(
        'feedback_2',
        'feedback_2_object',
        array(
            'url'   => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('feedback_2-nonce'),
        )
    );
}


add_action('wp_ajax_feedback_action_2', 'ajax_action_callback_2');
add_action('wp_ajax_nopriv_feedback_action_2', 'ajax_action_callback_2');
/**
 * Обработка скрипта
 */
function ajax_action_callback_2()
{


    // Массив ошибок
    $err_message = array();

    // Проверяем nonce. Если проверка не прошла, то блокируем отправку
    // if (!wp_verify_nonce($_POST['nonce'], 'feedback_2-nonce')) {
    //     wp_die('Данные отправлены с левого адреса');
    // }

    // Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
    // if (false === $_POST['art_anticheck_2'] || !empty($_POST['art_submitted_2'])) {
    //     wp_die('Пошел нахрен, мальчик!(c)');
    // }

    // // Проверяем полей имени, если пустое, то пишем сообщение в массив ошибок
    // if (empty($_POST['art_name_2']) || !isset($_POST['art_name_2'])) {
    //     $err_message['name'] = 'Пожалуйста, введите ваше имя.';
    // } else {
    $art_name = sanitize_text_field($_POST['art_name_2']);
    // }

    // // Проверяем полей емайла, если пустое, то пишем сообщение в массив ошибок
    // if (empty($_POST['art_email_2']) || !isset($_POST['art_email_2'])) {
    //     $err_message['email_2'] = 'Пожалуйста, введите адрес вашей электронной почты.';
    // } elseif (!preg_match('/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $_POST['art_email'])) {
    //     $err_message['email_2'] = 'Адрес электронной почты некорректный.';
    // } else {
    $art_email = sanitize_email($_POST['art_email_2']);
    // }

    // Проверяем массив ошибок, если не пустой, то передаем сообщение. Иначе отправляем письмо
    if ($err_message) {

        wp_send_json_error($err_message);
    } else {

        // Указываем адресата
        $mail = get_option('mail');
        $tgToggle = get_option('tgToggle');
        $email_to = $mail;
        // $email_to = 'danilaprok20@gmail.com';

        // Если адресат не указан, то берем данные из настроек сайта
        // if (!$email_to) {
        //     $email_to = get_option('admin_email');
        // }
        $art_subject = "Test";
        $body    = "Имя: $art_name \nEmail: $art_email \n\nС";
        $headers = 'From: ' . $art_name . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;

        // Данные telegram
        // $token = "5317565362:AAEyFa8Lriv8sYINtIvCXzlRhv8lX03QxoE";
        // $chat_id = "-798736102";
        $token = get_option('token');
        $chatId = get_option('chatId');
        $chat_id = $chatId;
        $arr = array(
            'Имя пользователя: ' => $art_name,
            // 'Связь: ' => $phone,
            'Email' => $art_email,
            'Тема' => $art_subject
        );

        $text = " ";
        foreach ($arr as $key => $value) {
            $text .= "<b>" . $key . "</b> " . $value . "%0A";
        };

     
        // отправка в тг, если checkbox active
        if($tgToggle){
            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}", "r");
        }


        // Отправляем письмо
        wp_mail($email_to, $art_subject, $body, $headers);

        // Отправляем сообщение об успешной отправке
        $message_success = 'Собщение отправлено. В ближайшее время я свяжусь с вами.';
        wp_send_json_success($message_success);
    }

    // На всякий случай убиваем еще раз процесс ajax
    wp_die();
}
