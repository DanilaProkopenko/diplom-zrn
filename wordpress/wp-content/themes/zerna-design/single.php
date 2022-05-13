<?php get_header() ?>
<?php the_post() ?>

<div class="wrapper">
    <div class="content">
        <div class="work">
            <div class="work__header__img-box">
                <?php the_post_thumbnail(array(1920, 1080), array('class' => 'work__header__img')); ?>

            </div>

            <div class="work__data__box">
                <div class="work__data__category">
                    <!-- Branding/ -->
                    <?php
                    $post_id = get_the_ID();
                    $cat_id = get_the_category($post_id)[0]->term_id;
                    $cat_name = get_cat_name($cat_id);
                    ?>
                    <? echo $cat_name; ?>

                </div>
                <div class="work__data">
                    <!-- December 20, 2021 -->

                    <?php the_date('d F Y') ?>
                </div>
            </div>

            <div class="work__header__text">
                <?php the_title() ?>
            </div>
            <div class="work__discription-text">
                <?php
                add_filter('the_content', 'add_image_fluid_class');
                add_filter('the_content', 'add__figure_fluid_class');
                the_content(); ?>
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