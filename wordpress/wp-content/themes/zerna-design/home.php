<?php
/*
Template Name: home
*/
?>
<?php get_header() ?>
<div class="wrapper">
    <div class="content">
        <div class="slide-detect">
            <ul class="slide-detect__ul">
                <li class="slide-detect__li"></li>
                <li class="slide-detect__li"></li>
                <li class="slide-detect__li"></li>
                <li class="slide-detect__li"></li>
            </ul>
        </div>

        <div class="works">
            <!-- <div class="work__box">
                <a href="" class="work__link">
                    <div class="work__thumb">
                        <img src="<?php bloginfo('template_url') ?>/assets/media/image/main-screen/main-pic.png" alt="" class="work__thumb__img">
                    </div>
                    <div class="work__name">
                        <p>
                            Shell
                        </p>
                    </div>
                </a>
            </div> -->

            <?php
            global $post;

            $myposts = get_posts([
                'numberposts' => 4,
                // 'offset'      => 1,
                'category'    => 6
            ]);

            if ($myposts) {
                foreach ($myposts as $post) {
                    setup_postdata($post);
            ?>
                    <div class="work__box">
                        <a href="<?php the_permalink(); ?>" class="work__link" title="<?php the_title_attribute(); ?>">
                            <div class="work__thumb">
                                <?php the_post_thumbnail(array(1920, 1080), array('class' => 'work__thumb__img')); ?>
                            </div>
                            <div class="work__name">
                                <p>
                                    <?php the_title(); ?>
                                </p>
                            </div>
                        </a>
                    </div>
                    <!-- Вывод постов, функции цикла: the_title() и т.д. -->
            <?php
                }
            } else {
                // Постов не найдено
            }

            wp_reset_postdata(); // Сбрасываем $post
            ?>


            <!-- <div class="work__box">
                    <a href="" class="work__link">

                        <div class="work__thumb">
                            <img src="<?php bloginfo('template_url') ?>/assets/media/image/main-screen/garden.png" alt="" class="work__thumb__img">
                        </div>
                        <div class="work__name">
                            <p>
                                Culture garden
                            </p>
                        </div>
                    </a>
                </div>
                <div class="work__box">
                    <a href="" class="work__link">

                        <div class="work__thumb">
                            <img src="<?php bloginfo('template_url') ?>/assets/media/image/main-screen/shark.png" alt="" class="work__thumb__img">
                        </div>
                        <div class="work__name">
                            <p>
                                Shark
                            </p>
                        </div>
                    </a>
                </div>
                <div class="work__box">
                    <a href="" class="work__link">

                        <div class="work__thumb">
                            <img src="<?php bloginfo('template_url') ?>/assets/media/image/main-screen/malahit.png" alt="" class="work__thumb__img">
                        </div>
                        <div class="work__name">
                            <p>
                                Malahit
                            </p>
                        </div>
                    </a>
                </div> -->
        </div>


        <form action="" method="get" class="order-form">
            <div class="order-form__box">
                <input type="email" name="email" placeholder="Order design" class="order-form__email">
                <input type="submit" class="order-form__submit" value="">
                <br><label for="email" class="order-form__label">Send us your email to discuss the
                    project.</label>
            </div>
        </form>
    </div>
</div>

<?php get_footer() ?>