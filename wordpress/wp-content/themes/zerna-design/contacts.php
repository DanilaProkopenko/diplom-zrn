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



            <form action="" method="get" class="contact-form">
                <div class="contact-form__header">
                    Write us about your project
                </div>
                <div class="contact-form__input-box">
                    <input type="email" name="email" class="input-email" placeholder="email">
                    <input type="text" name="name" class="input-name" placeholder="name">
                    <input type="text" name="messanger" class="input-number-messanger" placeholder="t.number/messanger">
                    <input type="text" name="about" class="input-about" placeholder="about">
                    <button type="submit" class="submit-btn">Send brif
                        <img src="<?php bloginfo('template_url') ?>/assets/media/image/buttons/submit-form/contact-page-arrow.svg" alt="" class="submit-img">
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<?php get_footer() ?>