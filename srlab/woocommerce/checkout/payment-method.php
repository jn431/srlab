<?php

/**
 * Output a single payment method
 * @package     srlab
 * @version     3.5.0
 */
if (!defined('ABSPATH')) {
	exit;
}
?>
<li class="payment_method_<?php echo esc_attr($gateway->id); ?>">
	<input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />
	<label for="payment_method_<?php echo esc_attr($gateway->id); ?>">
		<span class="payment-name">
			<?= strtoupper($gateway->get_title()); ?>
			<?= $gateway->get_icon(); ?>
		</span>
		<?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
			<div class="payment_box payment_method_<?= esc_attr($gateway->id); ?>" <?php if (!$gateway->chosen) : ?>style="display:none;" <?php endif; ?>>
				<?php $gateway->payment_fields(); ?>
			</div>
		<?php endif; ?>
	</label>
</li>