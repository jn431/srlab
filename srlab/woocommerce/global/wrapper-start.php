<?php
/**
 * @package     srlab
 * @version     3.3.0
 */
defined('ABSPATH') || exit;
if (is_shop() || is_product_category() || is_product_tag()) {
	echo '<main id="store-front" class="store">';
} else if (is_product()) {
	echo '<main id="single-product" class="store">';
} else {
	echo '<main class="store">';
}
