<?php
/**
 * My Account - Edit account form
 * @package    srlab
 * @version 	3.5.0
 */
defined('ABSPATH') || exit;
do_action('woocommerce_before_edit_account_form'); ?>
<form class="responsive edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>
   <div class="form--12">
      <?php do_action('woocommerce_edit_account_form_start'); ?>
      <div class="woocommerce-form-wrap--first form-wrap form-wrap-first">
         <label for="account_first_name" class="required"><?php esc_html_e('First name', 'woocommerce'); ?></label>
         <input type="text" class="woocommerce-Input woocommerce-Input--text input" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" />
      </div>
      <div class=" woocommerce-form-wrap--last form-wrap form-wrap-last">
         <label for="account_last_name" class="required"><?php esc_html_e('Last name', 'woocommerce'); ?></label>
         <input type="text" class="woocommerce-Input woocommerce-Input--text input" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />
      </div>
      <div class="woocommerce-form-wrap--wide form-wrap form-wrap-wide">
         <label for="account_display_name" class="required"><?php esc_html_e('Display name', 'woocommerce'); ?></label>
         <input type="text" class="woocommerce-Input woocommerce-Input--text input" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" />
      </div>
      <div class="woocommerce-form-wrap--wide form-wrap form-wrap-wide">
         <label for="account_email" class="required"><?php esc_html_e('Email address', 'woocommerce'); ?></label>
         <input type="email" class="woocommerce-Input woocommerce-Input--email input" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
      </div>
   </div>
   <h3><?php esc_html_e('Password change', 'woocommerce'); ?></h3>
   <div class="form--12">
      <div class="woocommerce-form-wrap--wide form-wrap form-wrap-wide">
         <label for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
         <input type="password" class="woocommerce-Input woocommerce-Input--password input" name="password_current" id="password_current" autocomplete="off" />
      </div>
      <div class=" woocommerce-form-wrap--wide form-wrap form-wrap-wide">
         <label for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
         <input type="password" class="woocommerce-Input woocommerce-Input--password input" name="password_1" id="password_1" autocomplete="off" />
      </div>
      <div class=" woocommerce-form-wrap--wide form-wrap form-wrap-wide">
         <label for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
         <input type="password" class="woocommerce-Input woocommerce-Input--password input" name="password_2" id="password_2" autocomplete="off" />
      </div>
   </div>
   <?php do_action('woocommerce_edit_account_form'); ?>
   <div class="form-wrap">
      <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
      <button type="submit" class="woo--btn button" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
      <input type="hidden" name="action" value="save_account_details" />
   </div>
   <?php do_action('woocommerce_edit_account_form_end'); ?>
</form>
<?php do_action('woocommerce_after_edit_account_form'); ?>