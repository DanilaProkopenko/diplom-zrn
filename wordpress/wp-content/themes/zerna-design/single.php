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
                    <?php $cat_id = get_category($category);
                    echo get_cat_name($cat_id); ?>
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
                ?>
                <?php the_content() ?>
            </div>
            <div class="work__discription__img-box">


                <img src="./media/image/portfolio/malahit.png" alt="" class="work__discription__img">
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