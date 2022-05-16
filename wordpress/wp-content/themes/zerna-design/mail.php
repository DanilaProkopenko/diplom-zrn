<div>
    почта клиента
</div>
    <?echo $mailCLient;?>
<?

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $to = "HELLO@ZERNA.DESIGN";
    $to = "danilaprok20@gmail.com";

    //тема письма
    $subject = '=?UTF-8?B?' . base64_encode('Заказ на кровельный сайт.') . '?=';
    // $name = $_POST['name'];
    // $tel = $_POST['tel'];
    $name = "даня";
    $tel = "2";
    $mailCLient = $_POST['email'];
    $discription = "описа";

    ?>
    <?
    $message = '
    <html>
    <head>
        <title>roofs.zrna.design</title>
    </head>
    <body>
            <p>Имя заказчика: ' . $name . '</p>
        <p>Почта: ' . $mailCLient . '</p>
        <p>Телефон: ' . $tel . '</p>
        <p>Описание работы: ' . $discription . '</p>
    </body>
</html>';

    // date('d.m.Y H:i:s')
    //для отправки HTML-почты установим шапку Content-type
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    //дополнительные параметры
    // $headers .= "From: =?UTF-8?B?" . base64_encode('roofs.zerna.design') . "?= <robot@example.com>\r\n"; //адрес отправителя
    $headers .= "From: =?UTF-8?B?" . base64_encode('danilaprok20@gmail.com') . "?= <robot@example.com>\r\n"; //адрес отправителя

    //отправляем
    $wp_mail = mail($to, $subject, $message, $headers);

    //     if ($result) {
    //         echo $name . "<br/>" . $tel . "<br/>" . $mailCLient . "<br/>" . $discription;
    //     } else {
    //         echo ("bad");
    //     }
}
