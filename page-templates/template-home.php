<?php
/*
Template Name: Home page
*/

?>
<?php get_header(''); ?>


<section class="home-hero-banner-top ">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-7">
                <div class="skip-bin-info-holder">
                    <span class="arrow d-none d-sm-block"></span>
                    <div class="title">
                        <i class="fa fa-circle-arrow-up"></i>
                        Skip bin instant quote
                    </div>
                    <div class="desc">
                        Simply type your suburb above and you will be provided with an instant price across our range
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-xl-1">

                <div class="seven-day-skip-info">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/home-bin.png"
                        class="img-fluid d-none d-md-inline " alt="<?php bloginfo('name'); ?>">
                    <div class="title d-md-none">7-Day skip bin hire direct to your home covering
                        Perth to
                        Albany</div>
                </div>
            </div>
        </div>

        <div class="home-hero-slider mt-5 mb-5">

            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/slider-1.jpg"
                            class="img-fluid" alt="slide-1">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/slider-2.jpg"
                            class="d-block w-100" alt="slide-2">
                    </div>
                </div>
                <div class="carousel-bottom">
                    <div class="entry-content">
                        <div class="info">We deliver the right skip bin for your residential and commercial
                            projects.</div>
                    </div>
                    <div class="carousel-nav">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev"><i class="fa fa-arrow-left"></i></button>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next"><i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main-section">
    <div class="container">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. At deleniti, molestias, assumenda suscipit nemo itaque
        unde velit alias placeat expedita quae beatae vero, officiis eaque non sunt ipsum! Quibusdam, similique.
    </div>

    <div class="promo-section mt-5 mb-5">
        <div class="container">
            <div class="promo-wrapper ">
                <div class="row">
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <div class="promo-badge mb-3">
                            <span class="pretitle">Save</span>
                            <span class="title">20%</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h4>15 Day Storm Special on 9m3 Skip Bins</h4>
                        <p>BIN SERVICES - Perth, Fremantle, Kwiwinna, Rockingham, Mandurah, Harvey, Australind,
                            Bunburry, Busselton, Margaret River </p>
                        <a href="" class="btn btn-dark">Find out more information</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-products-holder mt-5 mb-5">
        <div class="container">
            <h3 class="text-dark"><i class="fa-solid fa-circle-arrow-down" aria-hidden="true"></i> Select the right skip
                bin for your project</h3>
            <div class="home-products">

                <?php
                $args = array(
                    'post_type' => 'product',
                    'orderby' => 'full_title',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => array('skipbin', 'hookbin'),
                            'operator' => 'IN'
                        )
                    ),
                    'posts_per_page' => 4
                );
                $index = 0;
                $loop = new WP_Query($args);
                while ($loop->have_posts()):
                    $loop->the_post();
                    global $product;
                    $index++;
                    ?>
                    <div class="home-product row">
                        <?php
                        // Get the custom field value
                        $acf_approx_bin = get_field('approx_bin', $product->get_id());
                        $acf_approx_trailer = get_field('approx_trailer', $product->get_id());
                        $acf_full_title = get_field('full_title', $product->get_id());
                        $acf_features = get_field('features', $product->get_id());

                        ?>
                        <a href="<?php the_permalink(); ?>" class="btn-get-a-quote btn btn-secondary text-capitalize">Get a
                            quote for this skip
                            bin</a>
                        <div class="col-lg-4 col-sm-6">
                            <img src="<?php
                            if ($product->get_image_id()) {
                                echo wp_get_attachment_image_src($product->get_image_id(), 'medium')[0];
                            } ?>" class="img-fluid " alt="bin ">
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <?php if ($acf_full_title) { ?>
                                <h5>
                                    <?php echo $acf_full_title; ?>
                                </h5>
                            <?php } else { ?>
                                <h5>
                                    <?php the_title(); ?>
                                </h5>
                            <?php } ?>

                            <?php if ($acf_features) { ?>
                                <div class="list-specs-wrap">
                                    <?php echo $acf_features; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-4  col-sm-12 product-badges">
                            <?php if ($acf_approx_trailer) { ?>
                                <div class="product-specs-badge">
                                    <p>Approx x
                                        <?php echo $acf_approx_trailer; ?> trailers
                                    </p>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-trailer.svg"
                                        class="img-fluid " alt="trailer ">
                                </div>
                            <?php } ?>
                            <?php if ($acf_approx_bin) { ?>
                                <div class="product-specs-badge">
                                    <p>Approx x
                                        <?php echo $acf_approx_bin; ?> wheelie bins
                                    </p>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-bin.svg"
                                        class="img-fluid " alt="bin ">
                                </div>
                            <?php } ?>
                        </div>
                    </div>



                <?php endwhile; ?>
                <?php wp_reset_query(); ?>

            </div>
        </div>
    </div>

    <?php if (is_active_sidebar('homepage-widget-area')): ?>
        <div class="container">
            <div id="secondary-sidebar" class="homepage-widget-area">
                <?php dynamic_sidebar('homepage-widget-area'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="waste-listing mt-5 mb-5">
        <div class="container">
            <header>
                <h4>We accept the following waste</h4>
                <a href="" class="btn btn-light">read the full list of acceptable waste</a>
            </header>
            <div class="waste-listing-items row">
                <div class="col-md-3 col-6">
                    <figure>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-waste-commercial.svg"
                            class="img-fluid" alt="Commercial Waste">
                        <figcaption>Commercial Waste</figcaption>
                    </figure>
                </div>
                <div class="col-md-3 col-6">
                    <figure>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-waste-building.svg"
                            class="img-fluid" alt="Building waste">
                        <figcaption>Building waste</figcaption>
                    </figure>
                </div>
                <div class="col-md-3 col-6">
                    <figure>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-waste-green.svg"
                            class="img-fluid" alt="Green Waste">
                        <figcaption>Green Waste</figcaption>
                    </figure>
                </div>
                <div class="col-md-3 col-6">
                    <figure>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-waste-household.svg"
                            class="img-fluid" alt="Household Waste">
                        <figcaption>Household Waste</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bottom-section">
    <div class="container">
        <div class="review-section  mx-auto mt-5 mb-5">
            <div class="review">
                <div class="review-stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </div>
                <p>"Amazing customer service and very good price will be definitely getting another one through these
                    guys when needed so much help thank you."</p>
                <span class="review-author">Damon, facebook review</span>
            </div>
        </div>
        <div class="contact-section mt-5 ">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Want to know more?</h5>
                    <p>To find out more about our services please contact us using any of the methods below, or
                        alternatively fill in the contact form and a representative will be in touch as soon as
                        possible.</p>
                    <p><i class="fa-solid fa-phone text-light"></i> Call today 1800 934 233</p>
                    <p><i class="fa-solid fa-envelope text-light"></i> Email info@westcoastwaste.com</p>
                </div>
                <div class="col-lg-6">
                    <?php
                    echo do_shortcode('[contact-form-7 id="21" title="Contact form footer"]')
                        ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>