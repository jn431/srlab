<?php

/**
 * My Account page - All account pages
 * @package    srlab
 * @version 	3.5.0
 */

defined('ABSPATH') || exit;
?>

<div class="l-300">
	<div class="col">
	<?php do_action('woocommerce_account_navigation'); ?>
	</div>
	<div class="col account-content">
		<?php do_action('woocommerce_account_content'); ?>
	</div>
</div>