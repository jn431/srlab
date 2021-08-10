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
	<section class="pd">
		<div class="compact">
			<h1 class="center title">Login</h1>
			<?php wp_login_form(); ?>
		</div>
	</section>
</main>
<?php
get_footer();
