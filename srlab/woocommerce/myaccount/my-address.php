<?php

/**
 * My Account - Addresses - Billing + Shipping Page
 * @package    srlab
 * @version 	3.5.0
 */

defined('ABSPATH') || exit;

$customer_id = get_current_user_id();

if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __('Billing Address', 'woocommerce'),
			'shipping' => __('Shipping Address', 'woocommerce'),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __('Billing Address', 'woocommerce'),
		),
		$customer_id
	);
}
?>

<p>
	<?php echo apply_filters('woocommerce_my_account_my_address_description', esc_html__('The following addresses will be used on the checkout page by default.', 'woocommerce')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
</p>

<?php if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>
	<div class="l-2 addresses">
	<?php endif; ?>

	<?php foreach ($get_addresses as $name => $address_title) : ?>
		<?php $address = wc_get_account_formatted_address($name); ?>

		<div class="col woocommerce-Address">
			<div class="wrap">
				<h3 class="title"><?php echo esc_html($address_title); ?></h3>
				<a href="<?php echo esc_url(wc_get_endpoint_url('edit-address', $name)); ?>" class="button edit b--sm sec--btn"><?php echo $address ? esc_html__('Edit', 'woocommerce') : esc_html__('Add', 'woocommerce'); ?></a>
				<address>
					<?php
					echo $address ? wp_kses_post($address) : esc_html_e('No address set.', 'woocommerce');
					?>
				</address>
			</div>
		</div>

	<?php endforeach; ?>

	<?php if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>
	</div>
<?php
	endif;
