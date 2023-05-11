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
    <div class="item-product row">
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