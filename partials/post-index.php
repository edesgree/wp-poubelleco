<article class="card card-blog text-white bg-dark h-100" <?php post_class('group'); ?> role="article">

  <?php if (has_post_thumbnail()) {
    $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
    echo '<img class="card-img-top" alt="' . esc_html($alt) . '" src="' . get_the_post_thumbnail_url() . '" />';

  } ?>

  <div class="card-body">
    <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    <p class="card-text">
      <?php the_excerpt(); ?>
    </p>
  </div>

  <div class="card-footer">
    <small class="text-muted"> <time datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time('F j, Y'); ?></time>
    </small>
    <a href="" class="btn btn-dark btn-sm">Read Post</a>
  </div>
</article>