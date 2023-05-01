<?php
/**
 * Default Archives Template
 *
 */

get_header(); ?>

<div class="container archive-content py-4" role="main">
  <div class="page-header-holder">
    <header class="entry-header">
      <?php single_cat_title(__('Recent blog posts for ', 'h5bs')); ?>
    </header>
  </div>

  <div class="row">
    <div class="col-lg-9 mb-6">
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
            ?>
            <div class="col">
              <?php get_template_part('partials/post', 'index'); ?>
            </div>
            <?php
          endwhile;

          get_template_part('partials/post', 'nav');
        endif;
        ?>

      </div>
    </div>
    <div class="col-lg-3 ">
      <h3 class="heading-primary">Blog categories</h3>
      <ul class="list-links">
        <?php wp_list_categories(
          array(
            'orderby' => 'name',
            'title_li' => '',
          )
        ); ?>
      </ul>
    </div>
  </div>



</div><!-- end content -->

<?php // get_sidebar(); ?>

<?php get_footer(); ?>