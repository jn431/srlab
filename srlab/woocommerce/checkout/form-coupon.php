<?php
/**
 * Checkout coupon form
 * @package 	srlab
 * @version 	3.4.4
 */
defined('ABSPATH') || exit;
if (!wc_coupons_enabled()) {
	return;
}
?>
<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display: none">
	<input type="text" name="coupon_code" class="input" placeholder="<?php esc_attr_e('Promo Code', 'srlab'); ?>" id="coupon_code" value="" />
	<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply', 'srlab'); ?>"><?php esc_html_e('Apply', 'srlab'); ?></button>
</form>