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
        <div class="search-input-holder">
          <div class="title">Quote</div>
          <input class="form-control" type="text" placeholder="Type your subrub here">
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