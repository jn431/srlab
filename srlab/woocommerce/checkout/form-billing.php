<?php

/**
 * Checkout billing information form
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */
defined('ABSPATH') || exit;
?>
<div class="woocommerce-billing-fields">
	<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>
	<div class="woocommerce-billing-fields__field-wrapper form--12">
		<?php
		$fields = $checkout->get_checkout_fields('billing');
		foreach ($fields as $key => $field) :
			woocommerce_form_field($key, $field, $checkout->get_value($key));
		endforeach;
		?>
	</div>
	<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
</div>
<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
	<div class="woocommerce-account-fields">
		<?php if (!$checkout->is_registration_required()) : ?>
			<div class="form-wrap create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?> type="checkbox" name="createaccount" value="1" />
					<span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
				</label>
			</div>
		<?php endif; ?>
		<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>
		<?php if ($checkout->get_checkout_fields('account')) : ?>
			<div class="create-account">
				<?php
				foreach ($checkout->get_checkout_fields('account') as $key => $field) :
					woocommerce_form_field($key, $field, $checkout->get_value($key));
				endforeach;
				?>
			</div>
		<?php endif; ?>
		<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
	</div>
<?php endif; ?>