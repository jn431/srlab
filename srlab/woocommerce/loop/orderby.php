<?php

/**
 * Filtering and Show options for ordering
 * @package		srlab
 * @version    3.6.0
 */
defined('ABSPATH') || exit; ?>
<?php do_action('srlab_filters'); ?>
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
		<?php foreach ($catalog_orderby_options as $id => $name) : ?>
			<option value="<?= esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?= esc_html($name); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
</form>