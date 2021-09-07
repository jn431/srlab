<?php
/**
 * Template Name: Signup page
 */
get_header();
?>
<main id="signup-page">
	<section class="pd">
		<div class="compact">
			<h1 class="visually-hidden">Sign Up</h1>
			<?php get_template_part('woocommerce/myaccount/form', 'signup'); ?>
		</div>
	</section>
</main>
<?php
get_footer();
