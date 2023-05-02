<?php

// Remove the price and add to cart from the single product summary
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Add the price and add to cart before the single product summary
add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_add_to_cart', 21);

// move product desc tabs
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);

//remove sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Change add to cart text on single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single');
function woocommerce_add_to_cart_button_text_single()
{
    return __('Order this skip bin', 'woocommerce');
}