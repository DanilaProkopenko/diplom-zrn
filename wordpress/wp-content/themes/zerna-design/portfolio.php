<?php
/*
Template Name: portfolio
*/
// http://diplom-zrn/wordpress/portfolio/
?>
<?php get_header() ?>
<div class="wrapper">
    <div class="content">
        <div class="portfolio-wr">

            <div class="portfolio">
                <div class="portfolio__header">
                    Works
                </div>

                <div class="portfolio__filter">
                    <div class="portfolio__filter__category">
                        <ul class="portfolio__filter__category__ul" id="category__ul">
                            <p> Filter by</p>
                            <?php
                            $categories = get_categories('child_of=5');

                            foreach ($categories as $category) {

                                // $li = '<li id=' . get_cat_ID($category->name) . ' class="portfolio__filter__category__li">' . get_term_link($category) . '">';
                                $li = '<li id=' . get_cat_ID($category->name) . ' class="portfolio__filter__category__li cat_button">';
                                $li .= $category->name;
                                // $li .= '('.get_cat_ID($category->name).')';
                                $li .= ' (' . $category->count . ')';
                                $li .= '</li>';

                                echo $li;
                            }
                            ?>
                            <!-- <li cat_id="1" class="portfolio__filter__category__li">All</li>
                            <li cat_id="2" class="portfolio__filter__category__li">Illustration</li>
                            <li cat_id="3" class="portfolio__filter__category__li">Logo</li>
                            <li cat_id="4" class="portfolio__filter__category__li">Brandbook</li> -->
                            <span id='test'>Вы выбрали <strong>ничего</strong></span>
                        </ul>

                    </div>
                </div>
            </div>

            <script src="<?php bloginfo('template_url') ?>/assets/js/category.js"></script>
            <div class="pr-works" id="pr-works">
                <?php
                global $post;

                $myposts = get_posts([
                    // 'numberposts' => 4,
                    // 'offset'      => 1,
                    'category'    => 5
                ]);

                if ($myposts) {
                    foreach ($myposts as $post) {
                        setup_postdata($post);
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
                                    illustration
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

                <!-- <div class="pr-work__box">
                    <a href="" class="pr-work__link">

                        <div class="pr-work__thumb">
                            <img src="./media/image/main-screen/malahit.png" alt="" class="pr-work__thumb__img">
                        </div>
                        <div class="pr-work__name">
                            Malahit
                        </div>
                        <div class="pr-work__category">
                            illustration
                        </div>
                    </a>
                </div>
                <div class="pr-work__box">
                    <a href="" class="pr-work__link">

                        <div class="pr-work__thumb">
                            <img src="./media/image/main-screen/malahit.png" alt="" class="pr-work__thumb__img">
                        </div>
                        <div class="pr-work__name">
                            Malahit
                        </div>
                        <div class="pr-work__category">
                            illustration
                        </div>
                    </a>
                </div>
                <div class="pr-work__box">
                    <a href="" class="pr-work__link">

                        <div class="pr-work__thumb">
                            <img src="./media/image/main-screen/malahit.png" alt="" class="pr-work__thumb__img">
                        </div>
                        <div class="pr-work__name">
                            Malahit
                        </div>
                        <div class="pr-work__category">
                            illustration
                        </div>
                    </a>

                </div> -->

            </div>
        </div>


        <form action="" method="get" class="order-form">
            <div class="order-form__box">
                <input type="email" name="email" placeholder="Order design" class="order-form__email">
                <input type="submit" class="order-form__submit" value="">
                <br><label for="email" class="order-form__label">Send us your email to discuss the project.</label>
            </div>
        </form>
    </div>
</div>


<?php get_footer() ?>