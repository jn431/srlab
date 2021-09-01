<?php
/**
 * Template Name: Login page
 */
if (is_user_logged_in()) {
	wp_redirect(home_url());
	exit;
}
get_header();
?>
<main id="login-page">
	<section class="sect pd">
		<h1 class="visually-hidden">Login</h1>
		<?php get_template_part('woocommerce/myaccount/form', 'login'); ?>
		<?php get_template_part('woocommerce/myaccount/form', 'signup'); ?>
	</section>
</main>
<?php
get_footer();
