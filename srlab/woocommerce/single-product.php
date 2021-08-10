<?php

/**
 * The Template for displaying all single products
 * Removed sidebar
 * @package    srlab
 * @version    1.6.4
 */

defined('ABSPATH') || exit;

get_header();

do_action('woocommerce_before_main_content'); ?>

<?php while (have_posts()) : ?>
   <?php the_post(); ?>
   <?php wc_get_template_part('content', 'single-product'); ?>
<?php endwhile; ?>

<?php do_action('woocommerce_after_main_content'); ?>

<?php get_footer();