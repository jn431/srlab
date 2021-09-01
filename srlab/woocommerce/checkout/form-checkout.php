<?php

/**
 * Checkout Form
 * @package srlab
 * @version 3.5.0
 */
defined('ABSPATH') || exit;
do_action('woocommerce_before_checkout_form', $checkout);
$packages = WC()->shipping()->get_packages() ?? false;
if ($packages) {
	foreach ($packages as $package) {
		$show_shipping = count($package['rates']);
	}
} else {
	$show_shipping = false;
}
?>
<div class="row--2">
	<div class="col">
		<h2 class="hdr">Checkout</h2>
	</div>
	<div class="col right"><a href="<?= get_permalink(wc_get_page_id('cart')); ?>">EDIT CART</a></div>
</div>
<?php locate_template('woocommerce/progress-bar.php', true, true, $show_shipping);
// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}
?>
<form name="checkout" method="post" class="sect checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
	<section id="checkout-review" class="tile step" data-step="review" tabindex="1">
		<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
		<div class="woocommerce-checkout-review-order">
			<?php do_action('woocommerce_checkout_before_order_review'); ?>
			<?php do_action('woocommerce_checkout_order_review'); ?>
			<?php do_action('woocommerce_checkout_after_order_review'); ?>
		</div>
		<div class="step-ctrl c-2">
			<div class="blk--50"></div>
			<div class="blk--50 right"><button type="button" class="step-btn pri--bt b--more" data-next="billing" data-direct="next">Continue to Billing</button></div>
		</div>
	</section>
	<?php if ($checkout->get_checkout_fields()) : ?>
		<section id="checkout-billing" class="tile step" data-step="billing" tabindex="0">
			<?php do_action('woocommerce_checkout_before_customer_details'); ?>
			<?php do_action('woocommerce_checkout_billing'); ?>

			<?php do_action('woocommerce_checkout_after_customer_details', true); ?>
			<div class="step-ctrl c-2">
				<div class="blk--50"><button type="button" class="step-btn pri--bt b--more" data-direct="prev" data-prev="review">Back</button></div>
				<div class="blk--50 right"><button type="button" class="step-btn pri--bt b--more" data-direct="next" data-next="shipping">Continue to Shipping</button></div>
			</div>
		</section>

		<section id="checkout-shipping" class="tile step" data-step="shipping" tabindex="0">
			<?php do_action('woocommerce_checkout_shipping'); ?>
			<div class="step-ctrl c-2">
				<div class="blk--50"><button type="button" class="step-btn pri--bt b--more" data-direct="prev" data-prev="billing">Back</button></div>
				<div class="blk--50 right"><button type="button" class="step-btn pri--bt b--more" data-direct="next" data-next="payment">Continue to Payment</button></div>
			</div>
		</section>
	<?php endif; ?>
	<section id="checkout-payment" class="tile step" data-step="payment" tabindex="0">
		<?php do_action('woocommerce_checkout_before_payment'); ?>
		<?php do_action('woocommerce_checkout_payment'); ?>
		<?php do_action('woocommerce_checkout_after_payment', true); ?>
	</section>
</form>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>