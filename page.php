<?php
/**
 * Default Page Template
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
<div class="container page-content py-4" role="main">

  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>

      <article <?php post_class('group'); ?> role="article">

        <div class="row">
          <div class="col-lg-8">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </div>
          <div class="offset-lg-1 col-lg-3">
            <div class="promo-section promo-section-right-sidebar mt-5 mb-5">
              <div class="promo-wrapper ">

                <div class="promo-badge mb-3">
                  <span class="pretitle">Save</span>
                  <span class="title">20%</span>
                </div>

                <h4>15 Day Storm Special on 9m3 Skip Bins</h4>
                <p>BIN SERVICES - Perth, Fremantle, Kwiwinna, Rockingham, Mandurah, Harvey, Australind,
                  Bunburry, Busselton, Margaret River </p>
                <a href="" class="btn btn-dark">Find out more information</a>

              </div>
            </div>

          </div>
          <?php get_sidebar(); ?>
        </div>
    </div>

    </article>

  <?php endwhile; endif; ?>

</div><!-- end content -->



<?php get_footer(); ?>