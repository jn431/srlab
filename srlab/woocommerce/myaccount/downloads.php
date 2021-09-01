<?php

/**
 * Account - Downloads
 * @package srlab
 * @version 3.2.0
 */
if (!defined('ABSPATH')) {
	exit;
}
$downloads     = WC()->customer->get_downloadable_products();
$has_downloads = (bool) $downloads;

do_action('woocommerce_before_account_downloads', $has_downloads);
if ($has_downloads) :
	do_action('woocommerce_before_available_downloads');
	do_action('woocommerce_available_downloads', $downloads);
	do_action('woocommerce_after_available_downloads');
else : ?>
	<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
		<?php esc_html_e('No downloads available.', 'woocommerce'); ?>
	</div>
<?php
endif;
do_action('woocommerce_after_account_downloads', $has_downloads); ?>