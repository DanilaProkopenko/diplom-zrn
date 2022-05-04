<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wordpress_zerna_diplom' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'mysql' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'mysql' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'vX0M?Yg;o9&O{F<{~SC>l?1.]/[mwbZgvWZ^f!1kX$7(faxskB<r@8om6H(%I*FV' );
define( 'SECURE_AUTH_KEY',  '<>a59#9a% 2^|$[C8v|RSOt;1o=V=)UG{.Dv8fnAea}X~-DOJI3#f*(ZCgmq.Xqa' );
define( 'LOGGED_IN_KEY',    '=0oF|kV^n .&?^mr/^reQH)Y39fL Zb_bm4FAjfhJ#<2IM%zl3u%zGz$|DEgG_5-' );
define( 'NONCE_KEY',        '3=Xd|0or5^[.WAxVkfVg#C71:xpR#HoD3SS{`?h-[!M]vaoeQbq%c:&U.0>1W_TI' );
define( 'AUTH_SALT',        'VfMz;%zvL@_%7hF/K!C@0=r4H3|l*(] GL&=*hQ8 @#fb.ynkxk0YP3eg:&)L?Us' );
define( 'SECURE_AUTH_SALT', 'rYZ@$zs2r4ljoV+A^7_B+#:DrY!EB>eCgIW$ZPR_KKm!k_^B@-Sq/bmZhMt8ngUk' );
define( 'LOGGED_IN_SALT',   'nChCU[)5f!=6z}ZEnFK9Flo-sdO*ovP`=btAcm9ecTlyqy0jadw(Mykv6&E#Q{-N' );
define( 'NONCE_SALT',       'y{)-xW)Eh6,bXw5weB1n:^E#8yMcvfh4XPu.{Ik#yzzzE]c}<VLO)f&0%qPD{y`+' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
