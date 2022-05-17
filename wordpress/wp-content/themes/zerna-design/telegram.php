
<?php

/* https://api.telegram.org/bot5317565362:AAEyFa8Lriv8sYINtIvCXzlRhv8lX03QxoE/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

// $name = $_POST['user_name'];
// $phone = $_POST['user_phone'];
$name = "danila";
$phone = "22";
$email = $_POST['email'];
$token = "5317565362:AAEyFa8Lriv8sYINtIvCXzlRhv8lX03QxoE";
$chat_id = "-798736102";
$arr = array(
    'Имя пользователя: ' => $name,
    'Телефон: ' => $phone,
    'Email' => $email
);

foreach ($arr as $key => $value) {
    // $txt .= "<b>" . $key . "</b> " . $value . "%0A";
    $txt .= "<b>" . urlencode($key) . " </b>" . urlencode($value) . "%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

if ($sendToTelegram) {
    header('Location: home.php');
} else {
    echo "Error";
}
?>
