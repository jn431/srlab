<?php

/**
 * Loop Price
 * @package     srlab
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $product;
?>

<?php if ($price_html = $product->get_price_html()) : ?>
	<div class="price">
		<?php echo $price_html; ?>
		<div class="unit-name">
			<?php
			if ($product->get_meta("_unit_name")) {
				echo "PER " . strtoupper($product->get_meta("_unit_name")['unit_name']);
			}
			?>
		</div>
	</div>

<?php endif; ?>