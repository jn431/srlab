<?php

/**
 * Cart Page
 * @package 	srlab
 * @version 	3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<?php locate_template('woocommerce/progress-bar.php', true); ?>
<div class="fl-300">
	<form class="woocommerce-cart-form col" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
		<?php do_action('woocommerce_before_cart_table'); ?>

		<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">

			<?php do_action('woocommerce_before_cart_contents'); ?>

			<?php
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

				if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
			?>

					<div class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

						<div class="product-details l-2" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">

							<div class="col">
								<div class="product-name">
									<?php
									if (!$product_permalink) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key));
									} else {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="item_name">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
									}
									do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);
									?>
								</div>
								<?php
								echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

								// Backorder notification.
								if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
									echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
								}
								// : Remove X : //
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove b--sm sec--btn" aria-label="%s" data-product_id="%s" data-product_sku="%s">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 115 130" height="24" class="svg-trash"><path d="M95 125H20c-3 0-6-3-6-6v-92c0-3 3-6 6-6h75c4 0 6 3 6 6v92C102 122 99 125 95 125z"/><path d="M0 20h115M82 5h-48v15h48V5z"/><path d="M43 48v53M72 48v53"/></svg>
									</a>',
										esc_url(wc_get_cart_remove_url($cart_item_key)),
										esc_html__('Remove this item', 'woocommerce'),
										esc_attr($product_id),
										esc_attr($_product->get_sku())
									),
									$cart_item_key
								);

								?>

							</div>
							<div class="col product-subtotal">
								<div data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
									<?php
									echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
									?>
								</div>

								<div class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
									<?php
									if ($_product->is_sold_individually()) {
										$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}
									echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
									?>
								</div>

							</div>
						</div>
					</div>
			<?php
				}
			}
			?>

			<?php do_action('woocommerce_cart_contents'); ?>

			<div>
				<div class="actions">

					<?php if (wc_coupons_enabled()) { ?>
						<div class="coupon">
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Promo Code', 'woocommerce'); ?>" /> <button type="submit" class="btn b--more" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
								<?php esc_attr_e('Apply', 'woocommerce'); ?></button>
							<?php do_action('woocommerce_cart_coupon'); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

					<?php do_action('woocommerce_cart_actions'); ?>

					<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
				</div>
			</div>
			<?php do_action('woocommerce_after_cart_contents'); ?>
		</div>
		<?php do_action('woocommerce_after_cart_table'); ?>
	</form>

	<?php do_action('woocommerce_before_cart_collaterals'); ?>

	<div class="col cart-collaterals">
		<?php do_action('woocommerce_cart_collaterals'); ?>
	</div>
</div>
<?php do_action('woocommerce_after_cart'); ?>