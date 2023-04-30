<?php
/**
 * Default Footer Template
 *
 */
?>


<footer class="bd-footer text-muted">
  <div class="container-fluid p-3 p-md-5">
    <ul class="bd-footer-links">
      <?php h5bs_footer_nav(); ?>
    </ul>
    <p class="text-center mb-0">&copy;
      <?= date('Y'); ?>
      <?= get_bloginfo('name'); ?>
    </p>
  </div>
</footer>
<?php wp_footer(); ?>

</body>

</html>