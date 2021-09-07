<?php

/**
 * Login Form
 * @package 	srlab
 * @version 	4.1.0
 */
defined('ABSPATH') || exit; ?>
<div class="compact"><?php do_action('woocommerce_before_customer_login_form'); ?></div>
<div id="customer_login" class="tile slim">
	<h3 class="title center"><?php esc_html_e('Login', 'woocommerce'); ?></h3>
	<form id="login-form" class="acc-form form--1 login" method="post">
		<?php do_action('woocommerce_login_form_start'); ?>
		<div class="form-wrap">
			<label for="username" class="required"><?php esc_html_e('Username or Email', 'woocommerce'); ?></label>
			<input type="text" class="input" name="username" id="username" autocomplete="username" value="<?= (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
		</div>
		<div class="form-wrap">
			<label for="password" class="required"><?php esc_html_e('Password', 'woocommerce'); ?></label>
			<a href="<?= esc_url(wp_lostpassword_url()); ?>" class="forgotpassword"><?php esc_html_e('Forgot Password', 'woocommerce'); ?></a>
			<input class="input" class="input" type="password" name="password" id="password" autocomplete="current-password" />
		</div>
		<?php do_action('woocommerce_login_form'); ?>
		<div class="form-wrap">
			<label class="cb-wrap">
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
				<span><?php esc_html_e('Remember Me', 'woocommerce'); ?></span>
			</label>
		</div>
		<div class="form-wrap center">
			<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
			<button type="submit" class="b--hero center pri--btn" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>">
				<?php esc_html_e('Log In', 'woocommerce'); ?>
			</button>
		</div>
		<div class="hr form-row">OR</div>
		<?php do_action('woocommerce_login_form_end'); ?>
		<div class="form-row">
			<?= do_shortcode('[nextend_social_login provider="facebook" align="center"]'); ?>
		</div>
	</form>

	<div id="account-signup" class="tile slim">
		<p class="center">Don’t have an account? <a href="<?= home_url('signup'); ?>">Sign up</a></p>
	</div>

</div>
<?php do_action('woocommerce_after_customer_login_form'); ?>