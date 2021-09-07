<?php

/**
 * Thankyou page
 * @package 	srlab
 * @version 	3.7.0
 */
defined('ABSPATH') || exit;
?>
<div class="woocommerce-order">
	<?php
	if ($order) :
		do_action('woocommerce_before_thankyou', $order->get_id());
	?>
		<?php if ($order->has_status('failed')) : ?>
			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'srlab'); ?></p>
			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'srlab'); ?></a>
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'srlab'); ?></a>
				<?php endif; ?>
			</p>
		<?php else : ?>
			<h2 class="hd--1 woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
				<?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Order Completed', 'srlab'), $order);
				?>
			</h2>
			<div id="order-overview">
				<div class="order-overview number">
					<h4><?php esc_html_e('Order Number:', 'srlab'); ?></h4>
					<?php echo $order->get_order_number();
					?>
				</div>
				<div class="order-overview date">
					<h4><?php esc_html_e('Date:', 'srlab'); ?></h4>
					<?php echo wc_format_datetime($order->get_date_created());
					?>
				</div>
				<div class="order-overview payment-method">
					<h4><?php esc_html_e('Payment method:', 'srlab'); ?></h4>
					<?php echo wp_kses_post($order->get_payment_method_title()); ?>
				</div>
				<div class="order-overview total">
					<h4><?php esc_html_e('Total:', 'srlab'); ?></h4>
					<?php echo $order->get_formatted_order_total();
					?>
				</div>
			</div>
		<?php endif; ?>
		<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
		<?php do_action('woocommerce_thankyou', $order->get_id()); ?>
	<?php else : ?>
		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
			<?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'srlab'), null);  ?>
		</p>
	<?php endif; ?>
</div>