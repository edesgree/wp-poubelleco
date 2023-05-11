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
?>
<div class="row">
    <?php
    while ($loop->have_posts()):
        $loop->the_post();
        global $product;
        $index++;
        ?>
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="item-product ">
                <?php
                // Get the custom field value
                $acf_approx_bin = get_field('approx_bin', $product->get_id());
                $acf_approx_trailer = get_field('approx_trailer', $product->get_id());
                $acf_full_title = get_field('full_title', $product->get_id());
                //$acf_features = get_field('features', $product->get_id());
            
                ?>
                <div class="row">

                    <div class="col-sm-12 text-center">
                        <h5 class="title">
                            <?php if ($acf_full_title) {
                                echo $acf_full_title;
                            } else {
                                the_title();
                            } ?>
                        </h5>
                        <?php if ($product->get_image_id()) { ?>
                            <img class="d-block mx-auto img-fluid"
                                src="<?php echo wp_get_attachment_image_src($product->get_image_id(), 'medium')[0]; ?>"
                                class="img-fluid" alt="<?php the_title(); ?>">
                        <?php } ?>

                        <div class="price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        <small>Up to 7 Day Hire inc. GST</small>
                        <div class=" product-badges">
                            <?php if ($acf_approx_trailer) { ?>
                                <div class="product-specs-badge">

                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-trailer.svg"
                                        class="img-fluid " alt="trailer ">
                                    <p>x
                                        <?php echo $acf_approx_trailer; ?>
                                    </p>
                                </div>
                            <?php } ?>
                            <?php if ($acf_approx_bin) { ?>
                                <div class="product-specs-badge">

                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-bin.svg"
                                        class="img-fluid " alt="bin ">
                                    <p>x
                                        <?php echo $acf_approx_bin; ?>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-get-a-quote btn btn-secondary text-capitalize">Get a
                            quote for this skip
                            bin !</a>
                    </div>

                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php wp_reset_query(); ?>