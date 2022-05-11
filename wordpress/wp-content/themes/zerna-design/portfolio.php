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

                <!-- РАБОТАЕТ AJAX -->
                <?php get_header(); ?>
                <style type="text/css">
                    .portfolio__filter__category__ul li {
                        cursor: pointer
                    }

                    .portfolio__filter__category__ul li:hover {
                        color: #ff003d
                    }

                    .portfolio__filter__category__ul li:active{
                        color: #ff003d
                    }
                </style>

                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        jQuery(".portfolio__filter__category__ul li").on("click", function() {
                            console.log(this);
                            getPosts(this.getAttribute("cat_id"));
                        });
                    });

                    function getPosts(catid) {
                        var ajaxUrl = "<?php echo admin_url('admin-ajax.php') ?>";
                        jQuery.post(ajaxUrl, {
                                action: "more_post_ajax",
                                category: catid
                            })
                            .done(function(posts) {
                                jQuery(".pr-works").html(posts);
                            });
                    }
                </script>

                <div class="portfolio__filter">
                    <div class="portfolio__filter__category" id="ajax-posts">
                        <ul class="portfolio__filter__category__ul" id="category__ul">
                            <p> Filter by</p>
                            <?php
                            $data = get_cat_name(5);
                            echo "<li cat_id=\"" . get_cat_id(get_cat_name(5)) . "\" class='portfolio__filter__category__li'>All</li>";
                            ?>
                            <?php
                            $data = get_categories('child_of=5');
                            foreach ($data as $one) {
                                // $one->term_id
                                // $one->slug
                                echo "<li cat_id=\"" . $one->term_id . "\" class='portfolio__filter__category__li'>" . $one->name . "</li>";
                            }
                            ?>
                        </ul>

                    </div>
                </div>
                <div class="post_list pr-works">
                    <?php
                    if (count($data)) {
                        $args = [
                            'post_type' => 'post',
                            'posts_per_page' => 10,
                            'cat' => $data[0]->term_id
                        ];
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) : $loop->the_post(); ?>
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
                                        <?get_cat_name($data[0]->term_id)?>

                                    </div>
                                </a>
                            </div>
                    <?php
                        endwhile;
                    }
                    wp_reset_postdata();
                    ?>
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