<?php

/**
 * Pay for order form
 * @package srlab
 * @version 5.2.0
 */
defined('ABSPATH') || exit;
$totals = $order->get_order_item_totals(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
?>
<form id="order_review" method="post">
	<div class="shop_table">
		<div>
			<div class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></div>
			<div class="product-quantity"><?php esc_html_e('Qty', 'woocommerce'); ?></div>
			<div class="product-total"><?php esc_html_e('Totals', 'woocommerce'); ?></div>
		</div>
		<div>
			<?php if (count($order->get_items()) > 0) : ?>
				<?php foreach ($order->get_items() as $item_id => $item) : ?>
					<?php
					if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
						continue;
					}
					?>
					<div class="<?= esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>">
						<h4 class="product-name">
							<?= wp_kses_post(apply_filters('woocommerce_order_item_name', $item->get_name(), $item, false)); ?>
							<?php do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false); ?>
						</h4>
						<?php
						wc_display_item_meta($item);
						do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
						?>
						<div class="product-quantity">
							<?= apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', esc_html($item->get_quantity())) . '</strong>', $item); ?>
						</div>
						<div class="product-subtotal">
							<?= $order->get_formatted_line_subtotal($item); ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div>
			<?php if ($totals) : ?>
				<?php foreach ($totals as $total) : ?>
					<div>
						<div scope="row" colspan="2"><?= $total['label']; ?></div>
						<div class="product-total"><?= $total['value']; ?></div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<div id="payment">
		<?php if ($order->needs_payment()) : ?>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
				if (!empty($available_gateways)) {
					foreach ($available_gateways as $gateway) {
						wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
					}
				} else {
					echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', esc_html__('Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce')) . '</li>';
				}
				?>
			</ul>
		<?php endif; ?>
		<div class="form-wrap">
			<input type="hidden" name="woocommerce_pay" value="1" />
			<?php wc_get_template('checkout/terms.php'); ?>
			<?php do_action('woocommerce_pay_order_before_submit'); ?>
			<?= apply_filters('woocommerce_pay_order_button_html', '<button type="submit" class="button alt" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); ?>
			<?php do_action('woocommerce_pay_order_after_submit'); ?>
			<?php wp_nonce_field('woocommerce-pay', 'woocommerce-pay-nonce'); ?>
		</div>
	</div>
</form>