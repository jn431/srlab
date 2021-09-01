<?php
/**
 * Lost password form
 * @package srlab
 * @version 3.5.2
 */
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_lost_password_form' );
?>
<form method="post" class="form--1 lost_reset_password">
	<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php  ?>
	<div class="form-wrap">
		<label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
		<input class="woocommerce-Input woocommerce-Input--text input" type="text" name="user_login" id="user_login" autocomplete="username" />
	</div>
	<?php do_action( 'woocommerce_lostpassword_form' ); ?>
	<div class="form-wrap">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
	</div>
	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );
