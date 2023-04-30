<?php
/**
 * Default Single Post Template
 *
 */

get_header(); ?>

<div class="post-header-holder" <?php if (has_post_thumbnail()) { ?>
    style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);" <?php } ?>>
  <div class="container">
    <header class="entry-header">
      <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>
  </div>
</div>
<div class="post-header-metadata">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <i class="fa fa-calendar"></i> Post Date:
        <time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('F j, Y'); ?></time>
      </div>
      <div class="col-lg-6">
        <i class="fa fa-bars"></i> Post Category:
        <?php echo get_the_category()[0]->cat_name; ?>
      </div>
    </div>
  </div>
</div>
<div class="container single-content py-4" role="main">

  <?php while (have_posts()):
    the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?> role="article">



      <div class="row">
        <div class="col-lg-8">
          <?php the_content(); ?>

        </div>
        <div class="offset-lg-1 col-lg-3">
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

      <footer class="entry-footer">
        <div class="d-flex nav-links justify-content-between">
          <?php
          if (get_previous_post_link()) {
            previous_post_link('%link', '<i class="fa-solid fa-circle-arrow-left"></i>&nbsp;%title');
          }
          if (get_next_post_link()) {
            next_post_link('%link', '%title&nbsp;<i class="fa-solid fa-circle-arrow-right"></i>');
          }
          ?>
        </div><!-- .nav-links -->
      </footer>
    </article>

  <?php endwhile; ?>

</div><!-- end content -->

<?php // get_sidebar(); ?>

<?php get_footer(); ?>