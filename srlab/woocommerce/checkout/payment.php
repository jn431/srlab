<?php

/**
 * Checkout Payment Section
 * @package 	srlab
 * @version 	3.5.3
 */
defined('ABSPATH') || exit;
if (!is_ajax()) {
	do_action('woocommerce_review_order_before_payment');
}
?>
<div class="stack tile woocommerce-checkout-payment">
	<?php if (WC()->cart->needs_payment()) : ?>
		<ul class="wc_payment_methods payment_methods methods">
			<?php
			if (!empty($available_gateways)) {
				foreach ($available_gateways as $gateway) {
					wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
				}
			} else {
				echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>';
			}
			?>
		</ul>
	<?php endif; ?>
	<noscript>
		<?php
		printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>'); ?>
		<br />
		<button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
	</noscript>
	<?php
	wc_get_template('checkout/terms.php');
	do_action('woocommerce_review_order_before_submit');
	?>
	<div class="step-ctrl c-2">
		<div class="blk--50"><button type="button" class="step-btn pri--bt b--more" data-direct="prev" data-prev="shipping">Back</button></div>
		<div class="blk--50 right">
			<?php
			echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="button b--hero alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); ?>
		</div>
	</div>
	<?php
	do_action('woocommerce_review_order_after_submit');
	wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
</div>
<?php
if (!is_ajax()) {
	do_action('woocommerce_review_order_after_payment');
}
