<?php

/**
 * Shipping Calculator
 * @package srlab
 * @version 4.0.0
 */
defined('ABSPATH') || exit;
do_action('woocommerce_before_shipping_calculator'); ?>
<form class="woocommerce-shipping-calculator" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
	<?php printf('<a href="#" class="shipping-calculator-button">%s</a>', esc_html(!empty($button_text) ? $button_text : __('Calculate shipping', 'woocommerce'))); ?>
	<section class="shipping-calculator-form" style="display:none;">
		<?php if (apply_filters('woocommerce_shipping_calculator_enable_country', true)) : ?>
			<div class="form-wrap" id="calc_shipping_country_field">
				<select name="calc_shipping_country" id="calc_shipping_country" class="input country_to_state country_select" rel="calc_shipping_state">
					<option value="default"><?php esc_html_e('Select a country / region&hellip;', 'woocommerce'); ?></option>
					<?php
					foreach (WC()->countries->get_shipping_countries() as $key => $value) :
						echo '<option value="' . esc_attr($key) . '"' . selected(WC()->customer->get_shipping_country(), esc_attr($key), false) . '>' . esc_html($value) . '</option>';
					endforeach
					?>
				</select>
			</div>
		<?php endif; ?>
		<?php if (apply_filters('woocommerce_shipping_calculator_enable_state', true)) : ?>
			<div class="form-wrap" id="calc_shipping_state_field">
				<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states($current_cc);
				if (is_array($states) && empty($states)) :
				?>
					<input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e('State / County', 'woocommerce'); ?>">
				<?php elseif (is_array($states)) : ?>
					<span>
						<select name="calc_shipping_state" class="input state_select" id="calc_shipping_state" data-placeholder="<?php esc_attr_e('State / County', 'woocommerce'); ?>">
							<option value=""><?php esc_html_e('Select an option&hellip;', 'woocommerce'); ?></option>
							<?php
							foreach ($states as $ckey => $cvalue) :
								echo '<option value="' . esc_attr($ckey) . '" ' . selected($current_r, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
							endforeach;
							?>
						</select>
					</span>
				<?php else : ?>
					<input type="text" class="input" value="<?php echo esc_attr($current_r); ?>" placeholder="<?php esc_attr_e('State / County', 'woocommerce'); ?>" name="calc_shipping_state" id="calc_shipping_state" />
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if (apply_filters('woocommerce_shipping_calculator_enable_city', true)) : ?>
			<div class="form-wrap" id="calc_shipping_city_field">
				<input type="text" class="input" value="<?php echo esc_attr(WC()->customer->get_shipping_city()); ?>" placeholder="<?php esc_attr_e('City', 'woocommerce'); ?>" name="calc_shipping_city" id="calc_shipping_city" />
			</div>
		<?php endif; ?>
		<?php if (apply_filters('woocommerce_shipping_calculator_enable_postcode', true)) : ?>
			<div class="form-wrap" id="calc_shipping_postcode_field">
				<input type="text" class="input" value="<?php echo esc_attr(WC()->customer->get_shipping_postcode()); ?>" placeholder="<?php esc_attr_e('Postcode / ZIP', 'woocommerce'); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
			</div>
		<?php endif; ?>
		<button type="submit" name="calc_shipping" value="1" class="btn b--more"><?php esc_html_e('Update', 'woocommerce'); ?></button>
		<?php wp_nonce_field('woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce'); ?>
	</section>
</form>
<?php do_action('woocommerce_after_shipping_calculator'); ?>