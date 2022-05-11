<?php
/*
 * Template Name: custom_portfolio by ajax
 */
?>
<?php get_header(); ?>
<style type="text/css">
    .ajax_cat_list li {
        cursor: pointer
    }

    .ajax_cat_list li:hover {
        background: lightgray
    }
</style>

<div id="ajax-posts" class="row">
    <ul class="ajax_cat_list">
        <?php
        $data = get_categories();
        foreach ($data as $one) {
            // $one->term_id
            // $one->slug
            echo "<li cat_id=\"" . $one->term_id . "\">" . $one->name . "</li>";
        }
        ?>
    </ul>
    <div class="post_list">
        <?php
        if (count($data)) {
            $args = [
                'post_type' => 'post',
                'posts_per_page' => 10,
                'cat' => $data[0]->term_id
            ];
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post(); ?>
                <h1><?php the_title(); ?></h1>
        <?php
            endwhile;
        }
        wp_reset_postdata();
        ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        jQuery(".ajax_cat_list li").on("click", function() {
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
                jQuery(".post_list").html(posts);
            });
    }
</script>

<?php get_footer(); ?>