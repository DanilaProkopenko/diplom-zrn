<?php
/*
Template Name: home
*/
?>
<?php get_header() ?>
<div class="wrapper">
    <div class="content">
        <!-- Точечки справа убрал -->
        <!-- <div class="slide-detect">
            <ul class="slide-detect__ul">
                <li class="slide-detect__li"></li>
                <li class="slide-detect__li"></li>
                <li class="slide-detect__li"></li>
                <li class="slide-detect__li"></li>
            </ul>
        </div> -->

        <div class="works">
            <?php
            global $post;

            $myposts = get_posts([
                'numberposts' => 4,
                // 'offset'      => 1,
                'category'    => 5
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
        </div>
        <br>
        
        <?php // echo do_shortcode(' [art_feedback_2]'); ?>
        <?php echo do_shortcode(' [small_form]'); ?>
        
    </div>
</div>

<?php get_footer() ?>