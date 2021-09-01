<?php
/**
 * Proceed to checkout button
 * @package		srlab
 * @version 	2.4.0
 */
defined('ABSPATH') || exit;
?>
<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button btn pri--btn b--hero submit wc-forward">
	<?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
</a>
