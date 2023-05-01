<?php
/**
 * 
 * Template Name: Contact Template
 *
 */

get_header(); ?>

<div class="page-header-holder">
    <div class="container">
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>
    </div>
</div>
<div class="container page-content page-contact py-4" role="main">

    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>

            <article <?php post_class('group'); ?> role="article">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="entry-content">
                            <?php the_content(); ?>
                            <p>
                                <?php
                                if (get_option('support_phone')) { ?>
                                    <!-- Phone number found, show the phone number as a link. -->
                                    <i class="fa-solid fa-phone text-light"></i> Need support? Get us on <a
                                        href="tel:<?php echo get_option('support_phone'); ?>"><?php echo get_option('support_phone'); ?></a><br />
                                <?php } ?>
                                <?php
                                if (get_option('support_email')) { ?>
                                    <i class="fa-solid fa-envelope text-light"></i> Email us on <a
                                        href="mailto:<?php echo get_option('support_email'); ?>"><?php echo get_option('support_email'); ?></a><br />
                                <?php } ?>
                                <?php
                                if (get_option('support_address')) { ?>
                                    <i class="fa-solid fa-building text-light"></i>
                                    <?php echo get_option('support_address'); ?><br />
                                <?php } ?>
                            </p>

                            <?php
                            echo do_shortcode('[contact-form-7 id="39" title="Contact Us Form"]')
                                ?>

                        </div>
                    </div>
                    <div class="offset-lg-1 col-lg-3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d213642.9329631312!2d115.57043093295825!3d-33.20961748741579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a31fd43315e1939%3A0x75fec2e9bef1ec3c!2sWest%20Coast%20Waste!5e0!3m2!1sen!2sfr!4v1682867609102!5m2!1sen!2sfr"
                            width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
        </div>

        </article>

    <?php endwhile; endif; ?>

</div><!-- end content -->



<?php get_footer(); ?>