<?php
/**
 * Default Header Template
 *
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="h-100">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    <?php wp_title('|', true, 'right'); ?>
  </title>

  <?php // Place favicon.ico and apple-touch-icon.png in the root of the domain ?>

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?= vite('main.js') ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class('d-flex flex-column h-100'); ?>>

  <header id="wrapper-navbar" class="site-header" role="banner">
    <div class="top-header">
      <div class="container">

        <div class="row align-items-center">
          <div class="col-sm-5">
            <a href="<?= home_url('/'); ?>">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/logo.png" class="img-fluid"
                alt="<?php bloginfo('name'); ?>">

            </a>
          </div>
          <div class="col-sm-7">
            <div class="top-header-contact">
              <a href="tel:1800 927 839"><i class="fas fa-phone"></i> 1800 927 839</a>
              <a href="mailto:info@westcoastwaste.com" class="top-header-contact-email"><i class="fas fa-envelope"></i>
                info@westcoastwaste.com</a>
              <?php
              get_template_part('partials/header', 'menu-btn');
              ?>
            </div>

          </div>
        </div>
      </div>

    </div>
    <nav id="main-nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <div class="search-input-holder" id="header-search-autocomplete">

          <div id="search-input-reset" class="close-btn ">
            <i class="fa fa-times"></i>
          </div>
          <form action="" class="form-autocomplete" autocomplete="off">
            <input class="form-control" id="header-autocomplete-input" type="text"
              placeholder="Quote:Type your suburb here">
            <ul class="autocomplete-list" id="header-autocomplete-list">
            </ul>
          </form>

        </div>

        <?php
        get_template_part('partials/header', 'menu-btn');
        ?>
        <div class="collapse navbar-collapse" id="navbarMain">
          <?php h5bs_primary_nav(); ?>
        </div>
      </div>
    </nav>

  </header>

  <div id="quick-select-bins">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="steps">

            <div class="step one active">
              <div class="title">
                <i class="fa fa-arrow-circle-up"></i>
                Step 1: <strong id="quick-select-suburb-selected">Suburb selected, Bundury</strong>
              </div>
              <div class="icon">
                <i class="fa fa-check-circle"></i>
              </div>
            </div>

            <div class="step two">
              <div class="title">
                <i class="fa fa-arrow-circle-down"></i>
                Step 2: <strong> Select the skip that suits your needs</strong>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-4 offset-lg-1">
          <div class="price-info">
            All prices below reflect the price you will pay to hire a skip-bin from West Coast Waste for 7 days,
            delivered to
            your door.
          </div>
        </div>
      </div>

      <div class="quick-select-products-list">
        quick-select-products-list
        <div class="quick-select-all-bins">
          <div class="row">
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
              $variation_html = "";

              if ($product->is_type('variable')) {

                $available_variations = $product->get_available_variations();
                foreach ($available_variations as $variations) {
                  $attribute_depo = $variations['attributes']['attribute_depo'];
                  $attribute_distance = $variations['attributes']['attribute_distance'];
                  $price_html = $variations['price_html'];
                  $variation_html .= "<div 
														class='depo-price'
														data-productid='$product->id'
														data-depo='$attribute_depo' 
														data-distance='$attribute_distance' 
														>";
                  $variation_html .= $price_html;
                  $variation_html .= "</div>";
                }
              }
              ?>
              <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                <div class="item-product" data-quick-select-product data-productid=<?php echo $product->id; ?>>
                  <?php
                  // Get the custom field value
                  $acf_approx_bin = get_field('approx_bin', $product->get_id());
                  $acf_approx_trailer = get_field('approx_trailer', $product->get_id());
                  $acf_full_title = get_field('full_title', $product->get_id());
                  //$acf_features = get_field('features', $product->get_id());
                
                  ?>

                  <div class="title">
                    <?php the_title(); ?>
                  </div>
                  <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium'); ?>

                  <div class="image-holder">
                    <img class="image" src="<?php echo $image[0]; ?>" alt="<?php the_field('full_title'); ?>">
                  </div>
                  <div class="price">

                    <?php if (empty($available_variations) && false !== $available_variations): ?>
                      Order
                    <?php else:
                      echo $variation_html;
                    endif; ?>

                  </div>
                  <div class="hire">
                    Up to 7 Day Hire inc. GST
                  </div>
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
                  <?php if (empty($available_variations) && false !== $available_variations): ?>
                    <a href="<?php the_permalink(); ?>" data-add-to-cart data-productid="<?php echo $product->id; ?>"
                      data-distance="" data-depo="">
                    <?php else: ?>
                      <a href="#" data-add-to-cart onclick="headerProductToCart(this)"
                        data-productid="<?php echo $product->id; ?>" data-distance="" data-depo="">
                      <?php endif; ?>
                      <div class="btn-get-a-quote btn btn-secondary text-capitalize">
                        Order this skip bin
                      </div>
                    </a>
                </div>

              </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>