<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

the_title('<h1 class="product_title entry-title">', '</h1>');
?>
<div class="product-single-dimensions">
	Dimensions: <strong>
		<?php the_field('dimensions'); ?>
	</strong>
</div>
<div class="col-lg-4  col-sm-12 product-badges product-single-badges">
	<div class="product-specs-badge">
		<p>Approx
			<?php the_field('approx_trailer'); ?> trailers
		</p>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-trailer.svg"
			class="img-fluid " alt="trailer ">
	</div>
	<div class="product-specs-badge">
		<p>Approx
			<?php the_field('approx_bin'); ?> wheelie bins
		</p>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/src/assets/images/icons/icon-bin.svg" class="img-fluid "
			alt="bin ">
	</div>
</div>
<div class="product-single-features">
	<?php the_field('features'); ?>
</div>