<?php

/**
 * Template Name: eCommerce Page
 * @package    srlab
 * @author     Jaein Lee
 */
if (is_checkout()) {
	get_header('min');
} else {
	get_header();
}
?>
<main class="page ecommerce">
	<div class="compact pd">
		<?php
		if (function_exists('is_woocommerce')) : do_action("before_page_content");
		endif;
		if (have_posts()) : while (have_posts()) :  the_post(); ?>
				<h1 class="visually-hidden"><?php the_title(); ?></h1>
				<?php the_content(); ?>
		<?php endwhile;
		endif; ?>
	</div>
</main>
<?php
if (is_checkout()) {
	get_footer('checkout');
} else {
	get_footer();
}
?>