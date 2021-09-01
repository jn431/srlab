<?php
/**
 * My Account - Single View Order
 * @package    srlab
 * @version 	3.0.0
 */
defined('ABSPATH') || exit;
$notes = $order->get_customer_order_notes();
?>
<div class="main-order-details">
	<div class="order-number"><strong>Order Number: </strong> <?= $order->get_order_number(); ?></div>
	<div class="order-date"><strong>Date of Purchase: </strong> <?= wc_format_datetime($order->get_date_created()); ?></div>
	<div class="order-status"><strong>Status: </strong><?= wc_get_order_status_name($order->get_status()); ?></div>
</div>
<?php if ($notes) : ?>
	<h2><?php esc_html_e('Order updates', 'woocommerce'); ?></h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ($notes as $note) : ?>
			<li class="woocommerce-OrderUpdate comment note">
				<div class="woocommerce-OrderUpdate-inner comment_container">
					<div class="woocommerce-OrderUpdate-text comment-text">
						<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n(esc_html__('l jS \o\f F Y, h:ia', 'woocommerce'), strtotime($note->comment_date));
																					?></p>
						<div class="woocommerce-OrderUpdate-description description">
							<?php echo wpautop(wptexturize($note->comment_content));
							?>
						</div>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>
<?php do_action('woocommerce_view_order', $order_id); ?>