<!DOCTYPE html>
<!-- <html lang="en"> -->
<html <?php language_attributes(); ?>>

<head>
    <!-- <meta charset="UTF-8"> -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZERNA.design</title>


    <?php wp_head() ?>

    <!-- <link rel="stylesheet" href="/css/style.css"> -->

</head>

<body>

    <div class="header">
        <div class="header__wrapper">

            <div class="logo">
                <a href="./index.html">
                    <img src="<?php bloginfo('template_url') ?>/assets/media/image/logo/logo.svg" alt="ZERNA.design" class="img-logo">
                </a>
            </div>

            <div class="header__end">
                <ul class="header-ul">
                    <li class="header-li">
                        <a href="./showreel.html" class="header-links">
                            <?php echo $logo_img;?>
                            <p class="header-links__upper-text">01</p>
                            Showreel
                        </a>
                    </li>
                    <li class="header-li">
                        <a href="http://diplom-zrn/wordpress/portfolio/" class="header-links">
                            <p class="header-links__upper-text">02</p>
                            Works
                        </a>
                    </li>
                    <li class="header-li">
                        <a href="" class="header-links">
                            <p class="header-links__upper-text">03</p>
                            Studio
                        </a>
                    </li>
                    <li class="header-li">
                        <a href="./contacts.html" class="header-links">
                            <p class="header-links__upper-text">04</p>
                            Contacts
                        </a>
                    </li>
                </ul>

                <div class="menu-btn" id="menu-btn-open">
                    <img src="<?php bloginfo('template_url') ?>/assets/media/image/buttons/menu-btn.svg" alt="menu" class="menu-btn__img">
                </div>
            </div>
        </div>


        <div class="screen-menu__box" id="screen-menu__box">
            <div class="screen-menu">
                <div class="screen-menu__menu-btn" id="menu-btn-close">
                    <img src="<?php bloginfo('template_url') ?>/assets/media/image/buttons/menu-btn-close.svg" alt="menu" class="screen-menu__menu-close-btn__img">
                </div>

                <ul class="screen-menuа__ul">
                    <li class="screen-menu__li">
                        <a href="./showreel.html" class="screen-menu__links">
                            <p class="screen-menu__links__upper-text">01</p>
                            Showreel
                        </a>
                    </li>
                    <li class="screen-menu__li">
                        <a href="http://diplom-zrn/wordpress/portfolio/" class="screen-menu__links">
                            <p class="screen-menu__links__upper-text">02</p>
                            Works
                        </a>
                    </li>
                    <li class="screen-menu__li">
                        <a href="" class="screen-menu__links">
                            <p class="screen-menu__links__upper-text">03</p>
                            Studio
                        </a>
                    </li>
                    <li class="screen-menu__li">
                        <a href="./contacts.html" class="screen-menu__links">
                            <p class="screen-menu__links__upper-text">04</p>
                            Contacts
                        </a>
                    </li>
                </ul>

                <div class="screen-menu__address">
                    <div class="screen-menu__address__header">
                        Get In Touch
                    </div>
                    <div class="screen-menu__address__text">
                        Your address work Your address work Your address work<br>
                        Tel: +7 (9xx) xxx - xx - xx
                    </div>
                </div>
            </div>
        </div>
    </div>