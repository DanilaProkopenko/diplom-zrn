<?php
/*
Plugin Name: LJUsers
Plugin URI: http://jenyay.net
Description: Insert Livejournal users from editor
Version: 1.0.0
Author: Jenyay
Author URI: http://jenyay.net
*/

/*  Copyright 2008  Jenyay  (email : jenyay.ilin@gmail.com)

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

class ljusers
{
    function ljusers()
    {
        if (function_exists ('add_shortcode') )
        {
            add_shortcode('ljuser', array (&$this, 'user_shortcode') );
            add_shortcode('ljcomm', array (&$this, 'community_shortcode') );
        }
    }

    function user_shortcode ($atts, $content = null)
    {
        return "<b><span style='white-space: nowrap; display: inline !important;'><a href='http://$content.livejournal.com/profile'><img src='http://p-stat.livejournal.com/img/userinfo.gif' alt='[info]' width='17' height='17' style='vertical-align: bottom; border: 0; padding-right: 1px;vertical-align:middle; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0;' /></a><a href='http://$content.livejournal.com/'><b>$content</b></a></span></b>";
    }

    function community_shortcode ($atts, $content = null)
    {
        return "<b><span style='white-space: nowrap;'><a href='http://community.livejournal.com/$content/profile'><img src='http://www.livejournal.com/img/community.gif' alt='[info]' width='17' height='17' style='vertical-align: middle; border: 0; padding-right: 1px; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0;' /></a><a href='http://community.livejournal.com/$content'><b>$content</b></a></span></b>";
    }
    
}

$ljusers = new ljusers();
// add_shortcode('ljuser', 'ljusers_user_shortcode');
// add_shortcode('ljcomm', 'ljusers_community_shortcode');
// add_option('telegram_chat_id', '');
// add_option('telegram_token', 'XXXXXXXXXXXXXXXXXXXXXXX');





/* https://api.telegram.org/bot5317565362:AAEyFa8Lriv8sYINtIvCXzlRhv8lX03QxoE/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

// $name = $_POST['user_name'];
// $phone = $_POST['user_phone'];
// $name = "danila";
// $phone = "22";
// $email = $_POST['email'];
// $token = "5317565362:AAEyFa8Lriv8sYINtIvCXzlRhv8lX03QxoE";
// $chat_id = "-798736102";
// $arr = array(
//     'Имя пользователя: ' => $name,
//     'Телефон: ' => $phone,
//     'Email' => $email
// );

// foreach ($arr as $key => $value) {
//     // $txt .= "<b>" . $key . "</b> " . $value . "%0A";
//     $txt .= "<b>" . urlencode($key) . " </b>" . urlencode($value) . "%0A";
// };

// $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

// if ($sendToTelegram) {
//     header('Location: home.php');
// } else {
//     echo "Error";
// }

?>
