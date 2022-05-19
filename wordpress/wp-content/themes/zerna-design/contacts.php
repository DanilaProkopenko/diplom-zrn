<?php
/*
Template Name: contacts
*/
?>
<?php get_header() ?>

<div class="wrapper">
    <div class="content">
        <div class="contact-wr">

            <div class="message-box">
                <div class="message__header">
                    Let's talk.
                </div>
                <div class="message__about">
                    No matter what your ask—big or small—we’re ready to talk. We’re all about working together to
                    solve
                    your gnarliest, most twisted, seemingly impossible challenges. Trust us—we’ve seen it all. (And
                    solved most of it.)
                </div>
            </div>


            <?php echo do_shortcode(' [big_form]'); ?>
        </div>

    </div>
</div>

<?php get_footer() ?>